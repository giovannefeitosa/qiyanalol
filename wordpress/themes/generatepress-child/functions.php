<?php

define('CHILDTHEME_BASE_DIR', __DIR__);

require_once CHILDTHEME_BASE_DIR . '/vendor/autoload.php';
require_once CHILDTHEME_BASE_DIR . '/lib/TwigTemplates.php';

// Load templates
TwigTemplates::init(CHILDTHEME_BASE_DIR . '/templates');

function shortcode_lol_champions_list ($attrs) {
  $champions = json_decode(file_get_contents(CHILDTHEME_BASE_DIR . '/assets/json/champions.json'), true);

  return TwigTemplates::render('lol_champions_list', [
    'attrs' => $attrs,
    'champions' => $champions,
  ]);
}

add_shortcode('lol_champions_list', 'shortcode_lol_champions_list');
