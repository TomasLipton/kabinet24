"""Rebuild the public price list and update the offer from the website's data.

Run from the repository root after installing requirements-documents.txt.
The first six pages of the existing offer are retained; only the two cancellation
clauses are redacted and replaced, and its price appendix is rebuilt.
"""
from io import BytesIO
from pathlib import Path
from math import floor
import json
import os
import re
import fitz
from reportlab.lib import colors
from reportlab.lib.enums import TA_CENTER
from reportlab.lib.pagesizes import A4
from reportlab.lib.styles import ParagraphStyle
from reportlab.pdfbase import pdfmetrics
from reportlab.pdfbase.ttfonts import TTFont
from reportlab.platypus import SimpleDocTemplate, Paragraph, Spacer, Table, TableStyle

ROOT = Path(__file__).resolve().parent.parent
CONFIG = json.loads((ROOT / 'data/site.json').read_text(encoding='utf-8'))
FONT_DIR = Path(os.environ.get('WINDIR', 'C:/Windows')) / 'Fonts'
REGULAR = FONT_DIR / 'arial.ttf'
BOLD = FONT_DIR / 'arialbd.ttf'
if not REGULAR.exists():
    REGULAR = Path('/usr/share/fonts/truetype/dejavu/DejaVuSans.ttf')
    BOLD = REGULAR.with_name('DejaVuSans-Bold.ttf')
pdfmetrics.registerFont(TTFont('Site', str(REGULAR)))
pdfmetrics.registerFont(TTFont('Site-Bold', str(BOLD)))
pdfmetrics.registerFontFamily('Site', normal='Site', bold='Site-Bold')


def price_document(appendix=False):
    stream = BytesIO()
    doc = SimpleDocTemplate(stream, pagesize=A4, leftMargin=36, rightMargin=36,
                            topMargin=34, bottomMargin=34, title='Кабинет24 - Прейскурант')
    normal = ParagraphStyle('Body', fontName='Site', fontSize=10, leading=14, spaceAfter=8)
    title = ParagraphStyle('Title', parent=normal, fontName='Site-Bold', fontSize=17, leading=22, spaceAfter=10)
    cell = ParagraphStyle('Cell', parent=normal, alignment=TA_CENTER, fontSize=10, leading=13, spaceAfter=0)
    header = ParagraphStyle('Header', parent=cell, fontName='Site-Bold', fontSize=9, leading=12)
    p = lambda text, style=normal: Paragraph(str(text), style)
    story = []
    if appendix:
        story += [p('Приложение 1 к Договору аренды'), Spacer(1, 4)]
    story += [p('Прейскурант на почасовую аренду', title),
              p('С 1 мая 2026 г. Все цены в белорусских рублях (BYN).'),
              p('г. Минск, ул. Я. Коласа, 37. Ежедневно с ' + CONFIG['opening_time'] + ' до ' + CONFIG['closing_time'] + '.'),
              Spacer(1, 8)]
    headers = ['Кабинет', 'Индиви-<br/>дуально', 'Вечер<br/>18:00-20:00', 'Группа', 'Счастливые<br/>часы<br/>11:00-16:00', 'Более 10 ч/нед<br/>индив. /<br/>группа']
    rows = [[p(v, header) for v in headers]]
    catalog = [json.loads(path.read_text(encoding='utf-8')) for path in (ROOT / 'data/cabinets').glob('*.json')]
    order = ['9', '27', '28', '37', '24.1', '24.2', '24.3', '24.4', '43']
    catalog = sorted([c for c in catalog if c.get('enabled', True)], key=lambda c: order.index(c['number']) if c['number'] in order else 99)
    for c in catalog:
        individual, group = c['pricing']['individual'], c['pricing']['group']
        find = lambda prices, label: next((v['price'] for v in prices if v['label'] == label), None)
        standard = individual[0]['price']
        evening = find(individual, '18:00-20:00') or standard
        happy = find(individual, '11:00-16:00')
        discounted = [find(individual, 'более 10 ч/нед'), find(group, 'более 10 ч/нед')]
        vip = ' VIP' if c.get('type') == 'VIP' else ''
        # Keep the whole-square-meter presentation of the supplied price list.
        area = floor(c['size'] + 0.5)
        values = [f"<b>{c['number']}{vip}</b><br/>{area} м²", f'<b>{standard}</b>',
                  f'<b>{evening}</b>', f"<b>{group[0]['price']}</b><br/>{c['capacity']}",
                  f'<b>{happy}</b>' if happy else '-',
                  ' / '.join(str(v) if v is not None else '-' for v in discounted)]
        rows.append([p(v, cell) for v in values])
    table = Table(rows, colWidths=[79, 69, 87, 88, 95, 105], repeatRows=1)
    table.setStyle(TableStyle([
        ('BACKGROUND', (0, 0), (-1, 0), colors.HexColor('#e8edf3')),
        ('ROWBACKGROUNDS', (0, 1), (-1, -1), [colors.white, colors.HexColor('#f6f8fa')]),
        ('GRID', (0, 0), (-1, -1), .5, colors.HexColor('#cbd5e1')),
        ('VALIGN', (0, 0), (-1, -1), 'MIDDLE'),
        ('TOPPADDING', (0, 0), (-1, -1), 9), ('BOTTOMPADDING', (0, 0), (-1, -1), 9),
        ('LEFTPADDING', (0, 0), (-1, -1), 5), ('RIGHTPADDING', (0, 0), (-1, -1), 5),
    ]))
    story += [table, Spacer(1, 15),
              p('Стоимость указана за арендный час (50 минут).'),
              p(CONFIG['happy_hour_note']), p(CONFIG['discount_note']),
              p('Дополнительные услуги: аренда песочницы, проектора или массажного стола - 3 BYN/час за каждую услугу.'),
              p('Сайт: kabinet24.by. Телефон: +375 (29) 191-63-11.')]
    doc.build(story)
    return stream.getvalue()


def replace_clause(page, start, end, text):
    first = page.search_for(start)
    following = page.search_for(end)
    if not first or not following:
        raise ValueError(f'Не найден пункт оферты: {start}')
    # Both original clauses occupy four 14.4pt lines. Anchor the replacement to
    # the untouched following paragraph: using the replaced text's y-position
    # shifts the clause upward on every subsequent build.
    bottom = following[0].y0 - 1
    rect = fitz.Rect(50, bottom - 57.6, 562, bottom)
    # The page is white already. Avoid stacking opaque cover rectangles whose
    # antialiased edges can gradually affect the adjacent untouched paragraph.
    page.add_redact_annot(rect, fill=False)
    page.apply_redactions(images=0, graphics=0)
    page.insert_font(fontname='OfferBody', fontfile=str(REGULAR))
    # Arial matches the source. Reject overflow rather than clipping the clause.
    available = page.insert_textbox(rect, text, fontname='OfferBody', fontsize=11.5, lineheight=1.18, align=fitz.TEXT_ALIGN_JUSTIFY)
    if available < 0:
        raise ValueError(f'Пункт {start} не помещается: {available}')


def main():
    price_path = ROOT / 'assets/price-list-2026-from-may-1.pdf'
    offer_path = ROOT / 'assets/rental-agreement.pdf'
    offer = fitz.open(offer_path)
    if len(offer) < 6:
        raise ValueError('В исходной оферте должно быть не менее шести страниц')
    fee, hours = CONFIG['late_cancellation_percent'], CONFIG['free_cancellation_hours']
    replace_clause(offer[2], '4.5.', '4.7.',
                   f'4.5. При отмене аренды менее чем за {hours} часа до её начала Арендатор оплачивает {fee}% согласованной стоимости аренды. При невозможности передачи помещения по вине Арендатора (значительное опоздание, неявка и т.п., кроме указанной отмены) стоимость аренды оплачивается в полном объёме.')
    replace_clause(offer[3], 'прибыть ко времени', 'самостоятельно знакомиться',
                   f'- прибыть ко времени начала аренды. При невозможности прибытия уведомить Арендодателя не менее чем за {hours} часа. При отмене менее чем за {hours} часа оплачивается {fee}% стоимости зарезервированного времени; при неявке без отмены - полная стоимость.')
    result = fitz.open()
    result.insert_pdf(offer, from_page=0, to_page=5)
    appendix = fitz.open(stream=price_document(appendix=True), filetype='pdf')
    result.insert_pdf(appendix)
    offer.close()
    temporary = offer_path.with_suffix('.updated.pdf')
    result.save(temporary, garbage=4, deflate=True)
    result.close()
    # Reopen before replacing the public file to validate both amended clauses.
    with fitz.open(temporary) as check:
        for page in [check[2], check[3]]:
            assert f'{fee}%' in page.get_text()
        assert len(check) == 7
    temporary.replace(offer_path)
    price_path.write_bytes(price_document())
    print('Обновлены оферта и прейскурант из данных сайта.')


if __name__ == '__main__':
    main()
