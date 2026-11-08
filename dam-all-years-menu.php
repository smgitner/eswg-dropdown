<?php
/**
 * Plugin Name: DAM – All Years Menu
 * Description: Renders the year portal menu in the ESWG theme header.
 */

if (!defined('ABSPATH')) {
    exit;
}

add_action('dam_years_menu', 'dam_render_all_years_menu');

function dam_render_all_years_menu() {
    $current_year = function_exists('dam_get_route_year') ? dam_get_route_year() : 0;
    if (!$current_year && preg_match('#^/(20\d{2})(?:/|$)#', (string) parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH), $matches)) {
        $current_year = (int) $matches[1];
    }

    $portal_years = [];
    foreach ((array) get_option('dam_domains', []) as $domain) {
        if (preg_match('/^(20\d{2})-eswg-media$/', $domain['slug'] ?? '', $matches)) {
            $portal_years[] = (int) $matches[1];
        }
    }
    $portal_years = array_unique($portal_years);
    rsort($portal_years);

    if (!$portal_years) {
        return;
    }
    ?>
    <details class="relative">
        <summary class="cursor-pointer list-none rounded px-2 py-1 text-xs sm:text-sm font-bold uppercase tracking-wider text-text-main hover:text-primary focus-visible:outline focus-visible:outline-2 focus-visible:outline-primary dark:text-white">
            All Years <i class="fa-solid fa-chevron-down text-[10px]" aria-hidden="true"></i>
        </summary>
        <div class="absolute right-0 top-full z-50 mt-2 w-48 border border-border-light bg-surface-light py-1 shadow-xl dark:border-border-dark dark:bg-surface-dark">
            <?php foreach ($portal_years as $year): ?>
                <a href="<?php echo esc_url(home_url('/' . $year . '/')); ?>" <?php if ($year === $current_year): ?>aria-current="page"<?php endif; ?> class="block px-4 py-2 text-sm font-bold text-text-main hover:bg-primary hover:text-white focus-visible:outline focus-visible:outline-2 focus-visible:outline-primary dark:text-white"><?php echo esc_html($year); ?><?php if ($year === $current_year): ?> (Current)<?php endif; ?></a>
            <?php endforeach; ?>
        </div>
    </details>
    <?php
}
