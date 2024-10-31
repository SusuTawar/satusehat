<?php

namespace PhpSatuSehat\FHIR;

class EncounterParticipantType extends Base {
  public const ADM = [
    'code' => 'ADM',
    'display' => 'admitter',
    'definition' => 'The practitioner who is responsible for admitting a patient to a patient encounter.',
  ];

  public const ATND = [
    'code' => 'ATND',
    'display' => 'attender',
    'definition' => "The practitioner that has responsibility for overseeing a patient's care during a patient encounter.",
  ];

  public const CALLBCK = [
    'code' => 'CALLBCK',
    'display' => 'callback contact',
    'definition' => 'A person or organization who should be contacted for follow-up questions about the act in place of the author.',
  ];

  public const CON = [
    'code' => 'CON',
    'display' => 'consultant',
    'definition' => 'An advisor participating in the service by performing evaluations and making recommendations.',
  ];

  public const DIS = [
    'code' => 'DIS',
    'display' => 'discharger',
    'definition' => 'The practitioner who is responsible for the discharge of a patient from a patient encounter.',
  ];

  public const ESC = [
    'code' => 'ESC',
    'display' => 'escort',
    'definition' => 'Only with Transportation services. A person who escorts the patient.',
  ];

  public const REF = [
    'code' => 'REF',
    'display' => 'referrer',
    'definition' => 'A person having referred the subject of the service to the performer (referring physician). Typically, a referring physician will receive a report.',
  ];

  public const SPRF = [
    'code' => 'SPRF',
    'display' => 'secondary performer',
    'definition' => 'A person assisting in an act through his substantial presence and involvement This includes: assistants, technicians, associates, or whatever the job titles may be.',
  ];

  public const PPRF = [
    'code' => 'PPRF',
    'display' => 'primary performer',
    'definition' => 'The principal or primary performer of the act.',
  ];

  public const PART = [
    'code' => 'PART',
    'display' => 'Participation',
    'definition' => 'Indicates that the target of the participation is involved in some manner in the act, but does not qualify how.',
  ];

  public const TRANSLATOR = [
    'code' => 'TRANSLATOR',
    'display' => 'Translator',
    'definition' => 'A translator who is facilitating communication with the patient during the encounter.',
  ];

  public const EMERGENCY = [
    'code' => 'EMERGENCY',
    'display' => 'Emergency',
    'definition' => 'A person to be contacted in case of an emergency during the encounter.',
  ];

  public static function values(): array {
    return [
      self::ADM['code'] => self::ADM,
      self::ATND['code'] => self::ATND,
      self::CALLBCK['code'] => self::CALLBCK,
      self::CON['code'] => self::CON,
      self::DIS['code'] => self::DIS,
      self::ESC['code'] => self::ESC,
      self::REF['code'] => self::REF,
      self::SPRF['code'] => self::SPRF,
      self::PPRF['code'] => self::PPRF,
      self::PART['code'] => self::PART,
      self::TRANSLATOR['code'] => self::TRANSLATOR,
      self::EMERGENCY['code'] => self::EMERGENCY
    ];
  }
}