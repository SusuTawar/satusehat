<?php

namespace PhpSatuSehat\FHIR;

class OrganizationType extends Base {
  public const PROV = [
    "code" => "prov",
    "display" => "Healthcare Provider",
    "definition" => "An organization that provides healthcare services."
  ];

  public const DEPT = [
    "code" => "dept",
    "display" => "Hospital Department",
    "definition" => "A department or ward within a hospital (Generally is not applicable to top level organizations)"
  ];

  public const TEAM = [
    "code" => "team",
    "display" => "Organizational team",
    "definition" => "An organizational team is usually a grouping of practitioners that perform a specific function within an organization (which could be a top level organization, or a department)."
  ];

  public const GOVT = [
    "code" => "govt",
    "display" => "Government",
    "definition" => "A political body, often used when including organization records for government bodies such as a Federal Government, State or Local Government."
  ];

  public const INS = [
    "code" => "ins",
    "display" => "Insurance Company",
    "definition" => "A company that provides insurance to its subscribers that may include healthcare related policies."
  ];

  public const PAY = [
    "code" => "pay",
    "display" => "Payer",
    "definition" => "A company, charity, or governmental organization, which processes claims and/or issues payments to providers on behalf of patients or groups of patients."
  ];

  public const EDU = [
    "code" => "edu",
    "display" => "Educational Institute",
    "definition" => "An educational institution that provides education or research facilities."
  ];

  public const RELI = [
    "code" => "reli",
    "display" => "Religious Institution",
    "definition" => "An organization that is identified as a part of a religious institution."
  ];

  public const CRS = [
    "code" => "crs",
    "display" => "Clinical Research Sponsor",
    "definition" => "An organization that is identified as a Pharmaceutical/Clinical Research Sponsor."
  ];

  public const CG = [
    "code" => "cg",
    "display" => "Community Group",
    "definition" => "An un-incorporated community group."
  ];

  public const BUS = [
    "code" => "bus",
    "display" => "Non-Healthcare Business or Corporation",
    "definition" => "An organization that is a registered business or corporation but not identified by other types."
  ];

  public const OTHER = [
    "code" => "other",
    "display" => "Other",
    "definition" => "Other type of organization not already specified."
  ];

  public static function values(): array {
    return [
      "prov" => self::PROV,
      "dept" => self::DEPT,
      "team" => self::TEAM,
      "govt" => self::GOVT,
      "ins" => self::INS,
      "pay" => self::PAY,
      "edu" => self::EDU,
      "reli" => self::RELI,
      "crs" => self::CRS,
      "cg" => self::CG,
      "bus" => self::BUS,
      "other" => self::OTHER
    ];
  }
}
