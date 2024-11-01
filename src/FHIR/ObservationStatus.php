<?php

namespace PhpSatuSehat\FHIR;

class ObservationStatus extends Base {
  public const REGISTERED = [
    "code" => "registered",
    "display" => "Registered",
    "definition" => "The existence of the observation is registered, but there is no result yet available.",
  ];

  public const PRELIMINARY = [
    "code" => "preliminary",
    "display" => "Preliminary",
    "definition" => "This is an initial or interim observation: data may be incomplete or unverified.",
  ];

  public const FINAL = [
    "code" => "final",
    "display" => "Final",
    "definition" => 'The observation is complete and there are no further actions needed. Additional information such "released", "signed", etc would be represented using [Provenance](provenance.html) which provides not only the act but also the actors and dates and other related data. These act states would be associated with an observation status of `preliminary` until they are all completed and then a status of `final` would be applied.',
  ];

  public const AMENDED = [
    "code" => "amended",
    "display" => "Amended",
    "definition" => "Subsequent to being Final, the observation has been modified subsequent. This includes updates/new information and corrections.",
  ];

  public const CORRECTED = [
    "code" => "corrected",
    "display" => "Corrected",
    "definition" => "Subsequent to being Final, the observation has been modified to correct an error in the test result.",
  ];

  public const CANCELLED = [
    "code" => "cancelled",
    "display" => "Cancelled",
    "definition" => "The observation is unavailable because the measurement was not started or not completed (also sometimes called \"abandoned\").",
  ];

  public const ENTERED_IN_ERROR = [
    "code" => "entered-in-error",
    "display" => "Entered in Error",
    "definition" => 'Entered in Error	The observation has been withdrawn following previous final release. This electronic record should never have existed, though it is possible that real-world decisions were based on it. (If real-world activity has occurred, the status should be "cancelled" rather than "entered-in-error".).',
  ];

  public const UNKNOWN = [
    "code" => "unknown",
    "display" => "Unknown",
    "definition" => 'The authoring/source system does not know which of the status values currently applies for this observation. Note: This concept is not to be used for "other" - one of the listed statuses is presumed to apply, but the authoring/source system does not know which.',
  ];

  public static function values(): array {
    return [
      self::REGISTERED['code'] => self::REGISTERED,
      self::PRELIMINARY['code'] => self::PRELIMINARY,
      self::FINAL['code'] => self::FINAL,
      self::AMENDED['code'] => self::AMENDED,
      self::CORRECTED['code'] => self::CORRECTED,
      self::CANCELLED['code'] => self::CANCELLED,
      self::ENTERED_IN_ERROR['code'] => self::ENTERED_IN_ERROR,
      self::UNKNOWN['code'] => self::UNKNOWN
    ];
  }
}