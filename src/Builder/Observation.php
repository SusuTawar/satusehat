<?php

namespace PhpSatuSehat\Builder;

use Exception;
use PhpSatuSehat\FHIR\ObservationCategory;
use PhpSatuSehat\FHIR\ObservationStatus;

/**
 * Class observation
 *
 * @see http://hl7.org/fhir/R4/observation-definitions.html
 * @package PhpSatuSehat\Builder
 */
class observation extends ResourceBuilder
{
  protected $data = [
    'resourceType' => 'Observation',
    'status' => "final",
    'category' => [],
    'code' => null,
    'subject' => null,
    'performer' => [],
    'encounter' => null,
    'effectiveDateTime' => null,
    'issued' => null,
    'valueQuantity' => null
  ];

  public function setStatus($status) {
    $status = ObservationStatus::get($status);
    if ($status === null) {
      throw new Exception("Status observation $status not found");
    }
    $this->data['status'] = $status['code'];
    return $this;
  }

  public function addCategory($category) {
    $category = ObservationCategory::get($category);
    if ($category === null) {
      throw new Exception("Category observation $category not found");
    }
    $this->data['category'][] = [
      'coding' => [
        [
          'system' => 'http://terminology.hl7.org/CodeSystem/observation-category',
          'code' => $category['code'],
          'display' => $category['display']
        ]
      ]
    ];
    return $this;
  }

  public function addCode($system, $code, $display) {
    if (!isset($this->data['code']['coding'])) {
      $this->data['code']['coding'] = [];
    }
    $this->data['code']['coding'][] = [
      'system' => $system,
      'code' => $code,
      'display' => $display
    ];
    return $this;
  }

  public function setSubject($patientId) {
    $this->data['subject'] = [
      'reference' => "Patient/$patientId"
    ];
    return $this;
  }

  public function addPerformer($performerId) {
    $this->data['performer'][] = [
      'reference' => "Practitioner/$performerId"
    ];
    return $this;
  }

  public function setEncounter($encounterId, $display) {
    $this->data['encounter'] = [
      'reference' => "Encounter/$encounterId",
      'display' => $display
    ];
    return $this;
  }

  public function setEffectiveDateTime($dateTime) {
    $this->data['effectiveDateTime'] = $dateTime;
    return $this;
  }

  public function setIssued($dateTime) {
    $this->data['issued'] = $dateTime;
    return $this;
  }

  public function setValueQuantity($value, $unit, $code) {
    $this->data['valueQuantity'] = [
      'value' => $value,
      'unit' => $unit,
      'system' => 'http://unitsofmeasure.org',
      'code' => $code
    ];
    return $this;
  }
}