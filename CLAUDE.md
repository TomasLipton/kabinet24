# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

This is a single-page static website for **Kabinet24** (kabinet24.by) - a room rental service for hourly office/cabinet rental in Minsk, Belarus. The entire site consists of a single `index.php` file with embedded HTML, CSS, and JavaScript.

## Architecture

- **Single-file architecture**: All content is in `index.php` - HTML structure, Tailwind CSS styling, and vanilla JavaScript
- **No build process**: The site uses Tailwind CSS via CDN (`cdn.tailwindcss.com`), no compilation needed
- **Static assets**: Room photos stored in `assets/cabinet-{number}/` directories
- **PHP usage**: Minimal - only used for dynamic copyright year (`<?php echo date('Y'); ?>`)

## Deployment

Deployment happens via cPanel Git integration:
- Push to master triggers automatic deployment
- Files are copied to `/home/psychoan/domains/kabinet24.by/public_html/`
- Configuration in `.cpanel.yml`

## Key Features in the Code

- **Pricing toggle**: `switchPricing()` function switches between group and individual rental pricing views
- **Scroll-based navigation highlight**: `highlightActiveSection()` updates nav links based on scroll position
- **Smooth scrolling**: Anchor links scroll smoothly to sections

## Content Structure

The page sections (in order):
1. Header with navigation
2. Hero section
3. About section (features, pricing info)
4. Use cases section
5. Offices/cabinets grid with pricing tabs
6. Amenities section
7. Contact section
8. Footer

## Language

All user-facing content is in Russian. Maintain Russian language for any text additions or modifications.

##Other

Use BYN for currency 