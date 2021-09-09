<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/lib/TwigTemplates.php';

// Load templates
TwigTemplates::init(__DIR__ . '/templates');

function shortcode_lol_champions_list ($attrs) {
  return TwigTemplates::render('lol_champions_list', ['attrs' => $attrs]);
}

add_shortcode('lol_champions_list', 'shortcode_lol_champions_list');
