Simple Date / Time countdown block for Concrete CMS v9.

## Installation

1. Copy the block files to `application/blocks/date_counter/`.
2. In the Dashboard, go to **System & Settings > Blocks > Install Block** and install **Date Counter**.
3. Add the block to a page, then set the target date and time.

## Files

- `controller.php` — block controller (save, validate, caching)
- `view.php` — frontend markup
- `view.js` / `view.css` — countdown behavior and styling (auto-loaded by Concrete)
- `form.php` — shared add/edit form
- `add.php` / `edit.php` — add and edit views
- `db.xml` — database schema
