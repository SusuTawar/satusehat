<?php

namespace PhpSatuSehat\Builder;

use Exception;
use PhpSatuSehat\FHIR\ConditionCategory;
use PhpSatuSehat\FHIR\ConditionClinicalStatus;

/**
 * Class Condition
 *
 * @see http://hl7.org/fhir/R4/condition-definitions.html
 * @package PhpSatuSehat\Builder
 */
class Condition extends ResourceBuilder
{
  protected $data = [
    "resourceType" => "Condition",
    "clinicalStatus" => [],
    "category" => [],
    "code" => [],
    "subject" => [],
    "encounter" => [],
  ];

  public function addClinicalStatus($status) {
    $status = ConditionClinicalStatus::get($status);
    if ($status === null) {
      throw new Exception("Status condition $status not found");
    }
    if (!isset($this->data['clinicalStatus']['coding'])) {
      $this->data['clinicalStatus']['coding'] = [];
    }
    $this->data['clinicalStatus']['coding'][] = [
      "system" => "http://terminology.hl7.org/CodeSystem/condition-clinical",
      "code" => $status['code'],
      "display" => $status['display']
    ];
    return $this;
  }

  public function addCategory($category) {
    $category = ConditionCategory::get($category);
    if ($category === null) {
      throw new Exception("Category condition $category not found");
    }
    if (!isset($this->data['category']['coding'])) {
      $this->data['category']['coding'] = [];
    }
    $this->data['category']['coding'][] = [
      "system" => "http://terminology.hl7.org/CodeSystem/condition-category",
      "code" => $category['code'],
      "display" => $category['display']
    ];
    return $this;
  }

  public function addCode($code, $display) {
    if (!isset($this->data['code']['coding'])) {
      $this->data['code']['coding'] = [];
    }
    $this->data['code']['coding'][] = [
      "system" => "http://snomed.info/sct",
      "code" => $code,
      "display" => $display
    ];
    return $this;
  }

  public function addSubject($subjectId, $name) {
    $this->data['subject'] = [
      "reference" => "Patient/$subjectId",
      "display" => $name
    ];
    return $this;
  }

  public function addEncounter($encounterId, $display) {
    $this->data['encounter'] = [
      "reference" => "Encounter/$encounterId",
      "display" => $display
    ];
    return $this;
  }
}