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
        'image'        => 'http://placehold.co/210x210',
        'number'       => null,
        'area'         => null,
        'frontage'     => null,
        'depth'        => null,
        'availability' => null,
    ], $atts);

    return <<<OUTPUT
        <div class="Allotment clearfix">
            <div class="Allotment__image">
                <img src="{$atts['image']}" alt="Allotment number {$atts['number']}" height="210" width="210" />
            </div>
            <div class="Allotment__details">
                <strong>Allotment {$atts['number']}</strong><br />
                <strong>Area:</strong> {$atts['area']}m<sup>2</sup><br />
                <strong>Frontage:</strong> {$atts['frontage']}m<br />
                <strong>Availability:</strong> {$atts['availability']}
            </div>
        </div>

        <div class="Allotment__spacer">&nbsp;</div>
OUTPUT;
}
