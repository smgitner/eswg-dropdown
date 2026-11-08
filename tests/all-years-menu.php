<?php
define('ABSPATH', __DIR__);

function add_action($hook, $callback) {}
function get_option($name, $default = []) {
    return [
        ['slug' => '2026-eswg-media'],
        ['slug' => 'other-site'],
        ['slug' => '2027-eswg-media'],
    ];
}
function home_url($path) { return 'https://example.com' . $path; }
function esc_url($value) { return htmlspecialchars($value, ENT_QUOTES); }
function esc_html($value) { return htmlspecialchars((string) $value, ENT_QUOTES); }

require dirname(__DIR__) . '/dam-all-years-menu.php';
$_SERVER['REQUEST_URI'] = '/2027/';
ob_start();
dam_render_all_years_menu();
$html = ob_get_clean();

if (strpos($html, 'All Years') === false
    || strpos($html, 'href="https://example.com/2027/" aria-current="page"') === false
    || strpos($html, 'href="https://example.com/2026/"') === false
    || strpos($html, 'other-site') !== false
    || strpos($html, '/2027/') > strpos($html, '/2026/')) {
    throw new RuntimeException('All Years menu output is incorrect.');
}

echo "All Years menu passed.\n";
