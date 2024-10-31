<?php

namespace PhpSatuSehat\FHIR;

class MaritalStatus extends Base {
  public const ANNULED = [
    'code' => 'A',
    'display' => 'Annulled',
    'definition' => 'Marriage contract has been declared null and to not have existed',
  ];

  public const DIVORCED = [
    'code' => 'D',
    'display' => 'Divorced',
    'definition' => 'Marriage contract has been declared dissolved and inactive',
  ];

  public const INTERLOCUTORY = [
    'code' => 'I',
    'display' => 'Interlocutory',
    'definition' => 'Subject to an Interlocutory Decree.',
  ];

  public const LEGALLY_SEPERATED = [
    'code' => 'L',
    'display' => 'Legally Separated',
    'definition' => '',
  ];

  public const MARRIED = [
    'code' => 'M',
    'display' => 'Married',
    'definition' => 'A current marriage contract is active',
  ];

  public const POLYGAMOUS = [
    'code' => 'P',
    'display' => 'Polygamous',
    'definition' => 'More than 1 current spouse',
  ];

  public const DOMESTIC_PARTNER = [
    'code' => 'T',
    'display' => 'Domestic Partner',
    'definition' => 'Person declares that a domestic partner relationship exists.',
  ];

  public const UNMARRIED = [
    'code' => 'U',
    'display' => 'Unmarried',
    'definition' => 'Currently not in a marriage contract.',
  ];

  public const WIDOWED = [
    'code' => 'W',
    'display' => 'Widowed',
    'definition' => 'The spouse has died',
  ];

  public static function values(): array {
    return [
      self::ANNULED['code'] => self::ANNULED,
      self::DIVORCED['code'] => self::DIVORCED,
      self::INTERLOCUTORY['code'] => self::INTERLOCUTORY,
      self::LEGALLY_SEPERATED['code'] => self::LEGALLY_SEPERATED,
      self::MARRIED['code'] => self::MARRIED,
      self::POLYGAMOUS['code'] => self::POLYGAMOUS,
      self::DOMESTIC_PARTNER['code'] => self::DOMESTIC_PARTNER,
      self::UNMARRIED['code'] => self::UNMARRIED,
      self::WIDOWED['code'] => self::WIDOWED
    ];
  }
}