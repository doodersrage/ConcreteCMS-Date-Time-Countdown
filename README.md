# Date Counter (Concrete CMS v9)

A countdown block for Concrete CMS 9. Install as an application block override.

## Installation

1. Copy these files to `application/blocks/date_counter/`.
2. Dashboard → **Pages & Themes → Blocks** → install **Date Counter** (or refresh if already installed).
3. Add the block to a page and set the target date/time plus optional end message.

## Features

- Date/time picker via Concrete’s `helper/form/date_time` widget
- Optional custom message when the countdown ends
- Client-side countdown (block output remains cacheable)
- Theme-independent layout (no Bootstrap grid dependency)
- Vanilla JS (no jQuery asset required)
- Translatable strings via `t()`

## Files

| File | Role |
|---|---|
| `controller.php` | Block controller |
| `db.xml` | Doctrine XML schema |
| `form.php` | Shared add/edit form (Bootstrap 5) |
| `add.php` / `edit.php` | Include `form.php` |
| `view.php` | Frontend markup |
| `view.js` / `view.css` | Auto-loaded assets |
| `icon.png` | Block picker icon |
