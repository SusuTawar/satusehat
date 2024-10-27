<?php

namespace PhpSatuSehat\FHIR;

class IdentifierUse extends Base {
  public const USUAL = [
    "code" => "usual",
    "display" => "Usual",
    "definition" => "The identifier recommended for display and use in real-world interactions which should be used when such identifier is different from the \"official\" identifier."
  ];

  public const OFFICIAL = [
    "code" => "official",
    "display" => "Official",
    "definition" => "The identifier considered to be most trusted for the identification of this item. Sometimes also known as \"primary\" and \"main\". The determination of \"official\" is subjective and implementation guides often provide additional guidelines for use."
  ];

  public const TEMP = [
    "code" => "temp",
    "display" => "Temp",
    "definition" => "A temporary identifier"
  ];

  public const SECONDARY = [
    "code" => "secondary",
    "display" => "Secondary",
    "definition" => "An identifier that was assigned in secondary use - it serves to identify the object in a relative context, but cannot be consistently assigned to the same object again in a different context."
  ];

  public static function values(): array {
    return [
      self::USUAL['code'] => self::USUAL,
      self::OFFICIAL['code'] => self::OFFICIAL,
      self::TEMP['code'] => self::TEMP,
      self::SECONDARY['code'] => self::SECONDARY
    ];
  }
}