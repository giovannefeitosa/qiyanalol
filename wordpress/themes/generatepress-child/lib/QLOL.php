<?php

class QLOL {

  private static $championsData;
  private static $championQiyana;

  public static function getAllChampions() {
    if (!self::$championsData) {
      self::$championsData = json_decode(
        file_get_contents(CHILDTHEME_BASE_DIR . '/assets/json/champions.json'),
        true
      );
    }

    return self::$championsData['champions'];
  }

  public static function getChampion($championSlug) {
    $champions = self::getAllChampions();

    foreach ($champions as $champ) {
      if ($champ['slug'] === $championSlug) {
        return $champ;
      }
    }

    return false;
  }

  public static function getQiyana() {
    if (!self::$championQiyana) {
      self::$championQiyana = self::getChampion('qiyana');
    }

    return self::$championQiyana;
  }

}
