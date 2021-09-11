<?php

/**
 * List all champions' thumbnails with links to details page
 */
function shortcode_lol_champions_list ($attrs) {
  $champions = QLOL::getAllChampions();
  
  QTemplates::echo('shortcodes/lol_champions_list', [
    'attrs' => $attrs,
    'champions' => $champions,
  ]);
}

add_shortcode('lol_champions_list', 'shortcode_lol_champions_list');
