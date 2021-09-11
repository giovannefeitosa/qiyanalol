<?php

class QURL {
  public static function counterChampion($championSlug, $prefixSlash = true) {
    $slash = $prefixSlash ? '/' : '';
    return "${slash}como-counterar-de-qiyana-contra/${championSlug}";
  }

  public static function assetUrl($path) {
    $slash = substr($path, 0, 1) === '/' ? '' : '/';
    return get_stylesheet_directory_uri() . '/assets' . $slash . $path;
  }
}
