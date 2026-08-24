# Date Counter (Concrete CMS v9 Package)

A countdown package for Concrete CMS 9. Installs a **Date Counter** block that shows the time remaining until a selected date and time.

## Requirements

- Concrete CMS 9.0+

## Installation

1. Copy this package folder to `packages/date_counter/` on your site  
   (the folder that contains this README and `controller.php`).
2. Dashboard → **Extend Concrete** → find **Date Counter** → **Install**.
3. Add the **Date Counter** block to a page, set the target date/time, and optionally a custom end message.

### Migrating from the old application block

If you previously installed this as `application/blocks/date_counter/`:

1. Remove existing Date Counter blocks from pages (or note their settings).
2. Uninstall / remove the application block type.
3. Delete `application/blocks/date_counter/`.
4. Install this package as above.

## Features

- Date/time picker via Concrete’s `helper/form/date_time` widget
- Optional custom message when the countdown ends
- Client-side countdown (block output remains cacheable)
- Theme-independent layout (no Bootstrap grid dependency)
- Vanilla JS (no jQuery asset required)
- Translatable strings via `t()`

## Package structure

```
date_counter/
├── controller.php              # Package controller
├── icon.png                    # Package icon
├── README.md
└── blocks/
    └── date_counter/
        ├── controller.php      # Block controller
        ├── db.xml
        ├── form.php            # Shared add/edit form
        ├── add.php / edit.php
        ├── view.php
        ├── view.js / view.css
        └── icon.png
```

## Upgrade

After updating package files, open **Extend Concrete** and run **Update** on the package (or clear caches). The package `upgrade()` method ensures the block type remains registered.
