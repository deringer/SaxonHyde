<?php

add_shortcode('allotment', 'allotmentDisplay');

/**
 * Shortcode to generate a land allotment.
 *
 * @param  array $atts
 *
 * @return string
 */
function allotmentDisplay($atts)
{
    $atts = shortcode_atts([
        'image'     => 'http://placehold.co/210x210',
        'number'    => null,
        'area'      => null,
        'frontage'  => null,
        'depth'     => null,
        'available' => true,
    ], $atts);

    $statusClass = (bool) $atts['available'] ? "available" : "sold";
    $statusText  = (bool) $atts['available'] ? "Available Now" : "Sold or Under Contract";
    $depth       = ! is_null($atts['depth']) ? sprintf('<strong>Depth:</strong> %s<br />', $atts['depth']) : null;

    return <<<OUTPUT
        <div class="Allotment clearfix">
            <div class="Allotment__image">
                <img src="{$atts['image']}" alt="Allotment number {$atts['number']}" height="210" width="210" />
            </div>
            <div class="Allotment__details">
                <strong>Allotment {$atts['number']}</strong><br />
                <strong>Area:</strong> {$atts['area']}m<sup>2</sup><br />
                <strong>Frontage:</strong> {$atts['frontage']}<br />
                {$depth}
                <strong>Status:</strong> <span class="Allotment__availability--{$statusClass}">{$statusText}</span>
            </div>
        </div>

        <div class="Allotment__spacer">&nbsp;</div>
OUTPUT;
}

function saxonhyde_mce_editor_buttons($buttons) {
    array_unshift($buttons, 'styleselect');

    return $buttons;
}

function saxonhyde_mce_before_init($init_array) {
    $style_formats = [
        [
            'title'   => 'Allotment Sold',
            'inline'  => 'span',
            'classes' => 'Allotment__availability--sold',
        ],
    ];

    $init_array['style_formats'] = json_encode($style_formats);

    return $init_array;

}

function saxonhyde_mcekit_editor_style($url) {
    if (! empty($url)) {
        $url .= ',';
    }

    $url .= trailingslashit(plugin_dir_url(__FILE__)) . '/editor-styles.css';

    return $url;
}

add_filter('mce_buttons_2', 'saxonhyde_mce_editor_buttons');
add_filter('tiny_mce_before_init', 'saxonhyde_mce_before_init');
add_filter('mce_css', 'saxonhyde_mcekit_editor_style');

remove_filter('the_content', 'wpautop');
add_filter('the_content', 'nl2br');
