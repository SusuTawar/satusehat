<?php

namespace PhpSatuSehat\FHIR;

class ContactRole extends Base {
  public const EMPLOYER = [
    'code' => 'E',
    'display' => 'Employer',
    'definition' => 'Employer',
  ];

  public const EMERGENCY_CONTACT = [
    'code' => 'C',
    'display' => 'Emergency Contact',
    'definition' => 'Emergency Contact',
  ];

  public const FEDERAL_AGENCY = [
    'code' => 'F',
    'display' => 'Federal Agency',
    'definition' => 'Federal Agency',
  ];

  public const INSURANCE_COMPANY = [
    'code' => 'I',
    'display' => 'Insurance Company',
    'definition' => 'Insurance Company',
  ];

  public const NEXT_OF_KIN = [
    'code' => 'N',
    'display' => 'Next-of-Kin',
    'definition' => 'Next-of-Kin',
  ];

  public const STATE_AGENCY = [
    'code' => 'S',
    'display' => 'State Agency',
    'definition' => 'State Agency',
  ];

  public const OTHER = [
    'code' => 'O',
    'display' => 'Other',
    'definition' => 'Other',
  ];

  public const UNKNOWN = [
    'code' => 'U',
    'display' => 'Unknown',
    'definition' => 'Unknown',
  ];

  public static function values(): array {
    return [
      self::EMPLOYER['code'] => self::EMPLOYER,
      self::EMERGENCY_CONTACT['code'] => self::EMERGENCY_CONTACT,
      self::FEDERAL_AGENCY['code'] => self::FEDERAL_AGENCY,
      self::INSURANCE_COMPANY['code'] => self::INSURANCE_COMPANY,
      self::NEXT_OF_KIN['code'] => self::NEXT_OF_KIN,
      self::STATE_AGENCY['code'] => self::STATE_AGENCY,
      self::OTHER['code'] => self::OTHER,
      self::UNKNOWN['code'] => self::UNKNOWN
    ];
  }
}