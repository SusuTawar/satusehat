<?php

namespace PhpSatuSehat\FHIR;

class LocationPhysicalType extends Base {

  public const SI = [
    "code" => "si",
    "display" => "Site",
    "definition" => "A collection of buildings or other locations such as a site or a campus.",
  ];
  public const BU = [
    "code" => "bu",
    "display" => "Building",
    "definition" => "Any Building or structure. This may contain rooms, corridors, wings, etc. It might not have walls, or a roof, but is considered a defined/allocated space.",
  ];
  public const WI = [
    "code" => "wi",
    "display" => "Wing",
    "definition" => "A Wing within a Building, this often contains levels, rooms and corridors.",
  ];
  public const WA = [
    "code" => "wa",
    "display" => "Ward",
    "definition" => "A Ward is a section of a medical facility that may contain rooms and other types of location.",
  ];
  public const LVL = [
    "code" => "lvl",
    "display" => "Level",
    "definition" => "A Level in a multi-level Building/Structure.",
  ];
  public const CO = [
    "code" => "co",
    "display" => "Corridor",
    "definition" => "Any corridor within a Building, that may connect rooms.",
  ];
  public const RO = [
    "code" => "ro",
    "display" => "Room",
    "definition" => "A space that is allocated as a room, it may have walls/roof etc., but does not require these.",
  ];
  public const BD = [
    "code" => "bd",
    "display" => "Bed",
    "definition" => "A space that is allocated for sleeping/laying on. This is not the physical bed/trolley that may be moved about, but the space it may occupy.",
  ];
  public const VE = [
    "code" => "ve",
    "display" => "Vehicle",
    "definition" => "A means of transportation.",
  ];
  public const HO = [
    "code" => "ho",
    "display" => "House",
    "definition" => "A residential dwelling. Usually used to reference a location that a person/patient may reside.",
  ];
  public const CA = [
    "code" => "ca",
    "display" => "Cabinet",
    "definition" => "A container that can store goods, equipment, medications or other items.",
  ];
  public const RD = [
    "code" => "rd",
    "display" => "Road",
    "definition" => "A defined path to travel between 2 points that has a known name.",
  ];
  public const AREA = [
    "code" => "area",
    "display" => "Area",
    "definition" => "A defined physical boundary of something, such as a flood risk zone, region, postcode",
  ];
  public const JDN = [
    "code" => "jdn",
    "display" => "Jurisdiction",
    "definition" => "A wide scope that covers a conceptual domain, such as a Nation (Country wide community or Federal Government - e.g. Ministry of Health), Province or State (community or Government), Business (throughout the enterprise), Nation with a business scope of an agency (e.g. CDC, FDA etc.) or a Business segment (UK Pharmacy), not just an physical boundary.",
  ];

  public static function values(): array
  {
    return [
      self::SI['code'] => self::SI,
      self::BU['code'] => self::BU,
      self::WI['code'] => self::WI,
      self::WA['code'] => self::WA,
      self::LVL['code'] => self::LVL,
      self::CO['code'] => self::CO,
      self::RO['code'] => self::RO,
      self::BD['code'] => self::BD,
      self::VE['code'] => self::VE,
      self::HO['code'] => self::HO,
      self::CA['code'] => self::CA,
      self::RD['code'] => self::RD,
      self::AREA['code'] => self::AREA,
      self::JDN['code'] => self::JDN
    ];
  }
}