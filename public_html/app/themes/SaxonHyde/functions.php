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
