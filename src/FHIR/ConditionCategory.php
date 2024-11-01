<?php

namespace PhpSatuSehat\FHIR;

class ConditionCategory extends Base
{
  const PROBLEM_LIST_ITEM = [
    "code" => "problem-list-item",
    "display" => "Problem List Item",
    "definition" => "An item on a problem list that can be managed over time and can be expressed by a practitioner (e.g. physician, nurse), patient, or related person.",
  ];

  const ENCOUNTER_DIAGNOSIS = [
    "code" => "encounter-diagnosis",
    "display" => "Encounter Diagnosis",
    "definition" => "A point in time diagnosis (e.g. from a physician or nurse) in context of an encounter.",
  ];

  public static function values(): array
  {
    return [
      self::PROBLEM_LIST_ITEM['code'] => self::PROBLEM_LIST_ITEM,
      self::ENCOUNTER_DIAGNOSIS['code'] => self::ENCOUNTER_DIAGNOSIS
    ];
  }
}