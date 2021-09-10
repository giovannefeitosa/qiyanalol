<?php

// https://developer.wordpress.org/reference/functions/add_rewrite_rule/

add_action('init',  function() {
  add_rewrite_rule(
    QURL::counterChampion('([a-z0-9-]+)[/]?$', false),
    'index.php?how_to_counter_champion=$matches[1]',
    'top',
  );

  if (WP_DEBUG) {
    flush_rewrite_rules(true);
  }
});

add_filter('query_vars', function($query_vars) {
  $query_vars[] = 'how_to_counter_champion';
  return $query_vars;
});

add_action('template_include', function($template) {
  if (get_query_var('how_to_counter_champion') == false || get_query_var('how_to_counter_champion') == '') {
    return $template;
  }

  QTemplates::echoPage('pages/how_to_counter_champion', [
    'champion' => get_query_var('how_to_counter_champion'),
  ]);
});
