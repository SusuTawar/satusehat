<?php

namespace PhpSatuSehat\FHIR;

class AddressUse extends Base {

  public const HOME = [
    "code" => "home",
    "display" => "Home",
    "definition" => "A communication address at a home."
  ];

  public const WORK = [
    "code" => "work",
    "display" => "Work",
    "definition" => "An office address. First choice for business related contacts during business hours.."
  ];

  public const TEMP = [
    "code" => "temp",
    "display" => "Temp",
    "definition" => "A temporary address."
  ];

  public const BILLING = [
    "code" => "billing",
    "display" => "Billing",
    "definition" => "A billing address."
  ];

  public static function values(): array {
    return [
      self::HOME['code'] => self::HOME,
      self::WORK['code'] => self::WORK,
      self::TEMP['code'] => self::TEMP,
      self::BILLING['code'] => self::BILLING
    ];
  }
}