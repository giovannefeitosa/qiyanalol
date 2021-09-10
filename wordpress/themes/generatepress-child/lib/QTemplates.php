<?php

class QTemplates {
  private static $templates_dir = CHILDTHEME_BASE_DIR . '/templates';

  public static function echo ($template_name, $attrs = []) {
    self::includeWithVariables(self::$templates_dir . '/' . $template_name . '.php', $attrs);
  }

  public static function echoPage ($template_name, $attrs = []) {
    get_header(); ?>
    <div id="primary" <?php generate_do_element_classes( 'content' ); ?>>
      <main id="main" <?php generate_do_element_classes( 'main' ); ?>>
        <?php
          do_action( 'generate_before_main_content' );
          self::echo("${template_name}", $attrs);
          do_action( 'generate_after_main_content' );
        ?>
      </main>
    </div>
    <?php
    do_action( 'generate_after_primary_content_area' );
    generate_construct_sidebars();
    get_footer();
  }


  // https://stackoverflow.com/questions/11905140/php-pass-variable-to-include
  private static function includeWithVariables($filePath, $variables = array(), $print = true) {
    $output = NULL;
    if(file_exists($filePath)) {
      extract($variables);
      ob_start();
      include $filePath;
      $output = ob_get_clean();
    }
    if ($print) {
      print $output;
    }
    return $output;
  }
}
