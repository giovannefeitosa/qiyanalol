<?php

class QURL {
  public static function counterChampion($championSlug, $prefixSlash = true) {
    $slash = $prefixSlash ? '/' : '';
    return "${slash}como-counterar-de-qiyana-contra/${championSlug}";
  }
}
