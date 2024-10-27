<?php

namespace PhpSatuSehat\FHIR;

abstract class Base {
  public static abstract function values(): array;

  public static function keys() {
    return array_keys(self::values());
  }

  public static function get(mixed $value) {
    if (isset($value['code'])) $value = $value['code'];
    return array_search($value, self::keys()) >= 0 ? self::values()[$value] : null;
  }
}