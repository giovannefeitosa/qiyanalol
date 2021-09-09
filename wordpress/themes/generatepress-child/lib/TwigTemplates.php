<?php

class TwigTemplates {

  private static $loader;
  private static $twig;

  public static function init ($templates_dir) {
    self::$loader = new \Twig\Loader\FilesystemLoader($templates_dir);
    self::$twig = new \Twig\Environment(self::$loader, [
      'debug' => true,
    ]);

    self::$twig->addExtension(new \Twig\Extension\DebugExtension());
  }

  public static function render ($template_name, $attrs = []) {
    return self::$twig->render("${template_name}.twig", $attrs);
  }

}
