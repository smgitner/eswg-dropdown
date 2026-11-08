# ESWG All Years dropdown

This single-file WordPress MU plugin renders the **All Years** menu in the ESWG theme header. It reads year slugs such as `2027-eswg-media` from the WordPress `dam_domains` setting and links to `/<year>/` routes. It does not change users, media, or database records.

## Install

1. Copy `dam-all-years-menu.php` to the site's `wp-content/mu-plugins/` directory. WordPress loads it automatically.
2. Add `<?php do_action('dam_years_menu'); ?>` once in the theme header where the menu should appear. The `eswgtheme26` theme already has this hook in Local; production received the same one-line hook.
3. Ensure each year has a configured DAM domain and a working published route. A menu link alone does not create its page.

## Update

Edit `dam-all-years-menu.php`, run `php -l dam-all-years-menu.php` and `php tests/all-years-menu.php`, then copy the file to the production MU plugin directory. Keep the copy in [eswg-theme-plugins](https://github.com/smgitner/eswg-theme-plugins) in sync; this repository is the focused source for dropdown updates.

## Test

`php tests/all-years-menu.php` checks year ordering, link generation, and the current-year marker without loading WordPress.
