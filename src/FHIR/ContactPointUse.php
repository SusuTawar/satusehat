<?php

namespace PhpSatuSehat\FHIR;

class ContactPointUse extends Base {

  const HOME = [
    "code" => "home",
    "display" => "Home",
    "definition" => "A communication contact point at a home; attempted contacts for business purposes might intrude privacy and chances are one will contact family or other household members instead of the person one wishes to call. Typically used with urgent cases, or if no other contacts are available."
  ];

  const WORK = [
    "code" => "work",
    "display" => "Work",
    "definition" => "An office contact point. First choice for business related contacts during business hours."
  ];

  const MOBILE = [
    "code" => "mobile",
    "display" => "Mobile",
    "definition" => "A telecommunication device that moves and stays with its owner. May have characteristics of all other use codes, suitable for urgent matters, not the first choice for routine business."
  ];

  const TEMP = [
    "code" => "temp",
    "display" => "Temp",
    "definition" => "A temporary contact point."
  ];

  public static function values(): array {
    return [
      self::HOME['code'] => self::HOME,
      self::WORK['code'] => self::WORK,
      self::MOBILE['code'] => self::MOBILE,
      self::TEMP['code'] => self::TEMP
    ];
  }
}