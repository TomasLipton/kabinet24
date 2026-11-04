"""PDF regression checks; install scripts/requirements-documents.txt first."""
import hashlib
import importlib.util
from pathlib import Path
import shutil
import tempfile
import unittest
import fitz

ROOT = Path(__file__).resolve().parent.parent
SPEC = importlib.util.spec_from_file_location('build_documents', ROOT / 'scripts/build-documents.py')
builder = importlib.util.module_from_spec(SPEC)
SPEC.loader.exec_module(builder)


def page_fingerprints(path):
    with fitz.open(path) as document:
        return [(page.get_text(), hashlib.sha256(page.get_pixmap().samples).hexdigest()) for page in document]


class DocumentTests(unittest.TestCase):
    def test_repeated_builds_preserve_layout_and_unrelated_offer_terms(self):
        original_root = builder.ROOT
        source_offer = ROOT / 'assets/rental-agreement.pdf'
        original = page_fingerprints(source_offer)
        temporary_root = ROOT / 'tmp'
        temporary_root.mkdir(exist_ok=True)
        try:
            with tempfile.TemporaryDirectory(prefix='documents-', dir=temporary_root) as directory:
                scratch = Path(directory)
                self.assertTrue(scratch.resolve().is_relative_to(temporary_root.resolve()))
                shutil.copytree(ROOT / 'data', scratch / 'data')
                (scratch / 'assets').mkdir()
                shutil.copyfile(source_offer, scratch / 'assets/rental-agreement.pdf')
                builder.ROOT = scratch
                snapshots = []
                price_snapshots = []
                for _ in range(3):
                    builder.main()
                    snapshots.append(page_fingerprints(scratch / 'assets/rental-agreement.pdf'))
                    price_snapshots.append(page_fingerprints(scratch / 'assets/price-list-2026-from-may-1.pdf'))
                self.assertTrue(all(pages == snapshots[0] for pages in snapshots))
                self.assertTrue(all(pages == price_snapshots[0] for pages in price_snapshots))
                self.assertEqual(len(snapshots[0]), 7)
                self.assertEqual(len(price_snapshots[0]), 1)
                for index in [0, 1, 4, 5]:
                    self.assertEqual(snapshots[0][index], original[index])
                self.assertEqual(snapshots[0][2][0].count('100%'), 2)
                self.assertIn('50%', snapshots[0][2][0])
                self.assertIn('50%', snapshots[0][3][0])
        finally:
            builder.ROOT = original_root


if __name__ == '__main__':
    unittest.main()
