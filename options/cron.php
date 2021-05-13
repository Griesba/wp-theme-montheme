<?php

add_action('montheme_import_content', function() {
    touch(__DIR__ . '/demo-' . time());
});


/* déprogrammer un cron task
if ($timestamp = wp_next_scheduled('montheme_import_content')) {
    wp_unschedule_event($timestamp, 'montheme_import_content');
}
 */

//afficher la lister de tous les cron
/* echo '<pre>';
var_dump(_get_cron_array());
echo '</pre>';
die(); 

if (!wp_next_scheduled('montheme_import_content')) {
    wp_schedule_event(time(), 'daily', 'montheme_import_content'); // tous les heures
}
 */

add_filter('cron_schedules', function ($schedules) {
    $schedules['ten_seconds'] = [
        'interval' => 10,
        'display' => __('Toutes les 10 secondes', 'montheme')
    ];
    return $schedules;
});

if (!wp_next_scheduled('montheme_import_content')) {
    wp_schedule_event(time(), 'ten_seconds', 'montheme_import_content'); // custom cron, tous les 10 secondes
}

