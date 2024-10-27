<?php

namespace PhpSatuSehat\FHIR;

class AddressType extends Base {
  public const POSTAL = [
    "code" => "postal",
    "display" => "Postal",
    "description" => "Mailing addresses - PO Boxes and care-of addresses."
  ];

  public const PHYSICAL = [
    "code" => "physical",
    "display" => "Physical",
    "description" => "A physical address that can be visited."
  ];

  public const BOTH = [
    "code" => "both",
    "display" => "Both",
    "description" => "Both physical and postal addresses."
  ];

  public static function values(): array {
    return [
      self::POSTAL['code'] => self::POSTAL,
      self::PHYSICAL['code'] => self::PHYSICAL,
      self::BOTH['code'] => self::BOTH
    ];
  }
}