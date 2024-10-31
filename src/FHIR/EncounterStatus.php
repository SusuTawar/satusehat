<?php

namespace PhpSatuSehat\FHIR;

class EncounterStatus extends Base {
  public const PLANNED = [
    "code" => "planned",
    "display" => "Planned",
    "definition" => "The Encounter has not yet started."
  ];

  public const ARRIVED = [
    "code" => "arrived",
    "display" => "Arrived",
    "definition" => "The Patient is present for the encounter, however is not currently meeting with a practitioner."
  ];

  public const TRIAGED = [
    "code" => "triaged",
    "display" => "Triaged",
    "definition" => "The patient has been assessed for the priority of their treatment based on the severity of their condition."
  ];

  public const IN_PROGRESS = [
    "code" => "in-progress",
    "display" => "In Progress",
    "definition" => "The Encounter has begun and the patient is present / the practitioner and the patient are meeting."
  ];

  public const ON_LEAVE = [
    "code" => "onleave",
    "display" => "On Leave",
    "definition" => "	The Encounter has begun, but the patient is temporarily on leave."
  ];

  public const FINISHED = [
    "code" => "finished",
    "display" => "Finished",
    "definition" => "The Encounter has ended."
  ];

  public const CANCELLED = [
    "code" => "cancelled",
    "display" => "Cancelled",
    "definition" => "The Encounter has ended before it has begun."
  ];

  public const ENTERED_IN_ERROR = [
    "code" => "entered-in-error",
    "display" => "Entered in Error",
    "definition" => "This instance should not have been part of this patient's medical record."
  ];

  public const UNKNOWN = [
    "code" => "unknown",
    "display" => "Unknown",
    "definition" => 'The encounter status is unknown. Note that "unknown" is a value of last resort and every attempt should be made to provide a meaningful value other than "unknown".'
  ];

  public static function values(): array {
    return [
      self::PLANNED['code'] => self::PLANNED,
      self::ARRIVED['code'] => self::ARRIVED,
      self::TRIAGED['code'] => self::TRIAGED,
      self::IN_PROGRESS['code'] => self::IN_PROGRESS,
      self::ON_LEAVE['code'] => self::ON_LEAVE,
      self::FINISHED['code'] => self::FINISHED,
      self::CANCELLED['code'] => self::CANCELLED,
      self::ENTERED_IN_ERROR['code'] => self::ENTERED_IN_ERROR,
      self::UNKNOWN['code'] => self::UNKNOWN
    ];
  }
}