<?php

namespace PhpSatuSehat\FHIR;

class AdministrativeGender extends Base {
  public const MALE = [
    'code' => 'male',
    'display' => 'Male',
    'definition' => 'Male',
  ];

  public const FEMALE = [
    'code' => 'female',
    'display' => 'Female',
    'definition' => 'Female',
  ];

  public const OTHER = [
    'code' => 'other',
    'display' => 'Other',
    'definition' => 'Other',
  ];

  public const UNKNOWN = [
    'code' => 'unknown',
    'display' => 'Unknown',
    'definition' => 'Unknown',
  ];

  public static function values(): array {
    return [
      self::MALE['code'] => self::MALE,
      self::FEMALE['code'] => self::FEMALE,
      self::OTHER['code'] => self::OTHER,
      self::UNKNOWN['code'] => self::UNKNOWN
    ];
  }
}