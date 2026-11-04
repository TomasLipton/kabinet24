#!/usr/bin/env bash
set -euo pipefail
cd "$(dirname "$0")/.."
DEPLOYPATH="${DEPLOYPATH:-/home/psychoan/domains/kabinet24.by/public_html}"

# Stop before copying anything when code, data or required assets are invalid.
for file in *.php lib/*.php templates/*.php scripts/*.php; do
    php -l "$file" > /dev/null
done
php scripts/validate.php
php generate-sitemap.php
mkdir -p "$DEPLOYPATH" "$DEPLOYPATH/data/cabinets" "$DEPLOYPATH/templates" "$DEPLOYPATH/lib"
cp index.php cabinet.php rules.php .htaccess sitemap.xml robots.txt "$DEPLOYPATH/"
cp data/site.json "$DEPLOYPATH/data/"
cp data/cabinets/*.json "$DEPLOYPATH/data/cabinets/"
cp templates/*.php "$DEPLOYPATH/templates/"
cp lib/*.php "$DEPLOYPATH/lib/"
while IFS= read -r -d '' file; do
    mkdir -p "$DEPLOYPATH/$(dirname "$file")"
    cp "$file" "$DEPLOYPATH/$file"
done < <(find assets .well-known -type f ! -name '*_full.*' -print0)
