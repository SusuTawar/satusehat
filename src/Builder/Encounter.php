<?php

namespace PhpSatuSehat\Builder;

use Exception;
use PhpSatuSehat\FHIR\ActEncounterCode;
use PhpSatuSehat\FHIR\EncounterParticipantType;
use PhpSatuSehat\FHIR\EncounterStatus;

/**
 * Class Encounter
 *
 * @see http://hl7.org/fhir/R4/encounter-definitions.html
 * @package PhpSatuSehat\Builder
 */
class Encounter extends ResourceBuilder
{
  protected $data = [
    "resourceType" => "Encounter",
    "status" => "arrived",
    "class" => null,
    "subject" => null,
    "participant" => [],
    "period" => null,
    "location" => [],
    "statusHistory" => [],
    "serviceProvider" => "",
    "identifier" => null,
  ];

  /**
   * Set uuid encounter
   * 
   * hanya digunakan untuk PUT
   * 
   * @param string $uuid
   * @return $this
   */
  public function setId($uuid)
  {
    $this->data["id"] = $uuid;
    return $this;
  }

  /**
   * Set status encounter
   *
   * hanya digunakan untuk POST
   *
   * @see \PhpSatuSehat\FHIR\LocationPhysicalType\EncounterStatus
   * @param string $status
   * @return $this
   */
  public function setStatus($status)
  {
    $status = EncounterStatus::get($status);
    if ($status === null) {
      throw new Exception("Status encounter $status not found");
    }
    $this->data["status"] = $status["code"];
    return $this;
  }

  /**
   * Set class encounter
   *
   * @see \PhpSatuSehat\FHIR\LocationPhysicalType\ActEncounterCode
   * @param string $class
   * @return $this
   */
  public function setClass($class)
  {
    $class = ActEncounterCode::get($class);
    if ($class === null) {
      throw new Exception("Class encounter $class not found");
    }
    $this->data["class"] = [
      "system" => "http://terminology.hl7.org/CodeSystem/v3-ActCode",
      "code" => $class["code"],
      "display" => $class["display"]
    ];
    return $this;
  }

  /**
   * Set pasien encounter
   *
   * @param string $patientId
   * @param string $name
   * @return $this
   */
  public function setPatient($patientId, $name)
  {
    $this->data["subject"] = [
      "reference" => "Patient/$patientId",
      "display" => $name
    ];
    return $this;
  }

  /**
   * Set practitioner encounter
   *
   * @see \PhpSatuSehat\FHIR\LocationPhysicalType\EncounterParticipantType
   * @param mixed $type
   * @param string $practitionerId
   * @param string $name
   * @return $this
   */
  public function addParticipant($type, $practitionerId, $name)
  {
    $type = EncounterParticipantType::get($type);
    if ($type === null) {
      throw new Exception("Type encounter $type not found");
    }
    $this->data["participant"][] = [
      "type" => [
        "coding" => [
          "system" => "http://terminology.hl7.org/CodeSystem/v3-ParticipationType",
          "code" => $type["code"],
          "display" => $type["display"]
        ]
      ],
      "individual" => [
        "reference" => "Practitioner/$practitionerId",
        "display" => $name
      ]
    ];
    return $this;
  }

  /**
   * Set lokasi encounter
   *
   * @param string $locationId Uuid lokasi
   * @param string $name Deskripsi lokasi
   * @return $this
   */
  public function addLocation($locationId, $name)
  {
    $this->data["location"][] = [
      "reference" => "Location/$locationId",
      "display" => $name
    ];
    return $this;
  }

  /**
   * Set status encounter
   *
   * @see \PhpSatuSehat\FHIR\LocationPhysicalType\EncounterStatus
   * @param mixed $status
   * @param string $start
   * @return $this
   */
  public function addStatusHistory($status, $start)
  {
    $status = EncounterStatus::get($status);
    if ($status === null) {
      throw new Exception("Status encounter $status not found");
    }
    $this->data["statusHistory"][] = [
      "status" => $status["code"],
      "period" => [
        "start" => $start
      ]
    ];
    return $this;
  }

  /**
   * Set provider encounter
   *
   * @param string $organizationId
   * @return $this
   */
  public function setServiceProvider($organizationId)
  {
    $this->data["serviceProvider"] = [
      "reference" => "Organization/$organizationId"
    ];
    return $this;
  }

  /**
   * Set identifier encounter
   *
   * @param string $organizationId
   * @param string $value
   * @return $this
   */
  public function addIdentifier($organizationId, $value)
  {
    $this->data["identifier"][] = [
      "system" => "http://sys-ids.kemkes.go.id/encounter/$organizationId",
      "value" => $value
    ];
    return $this;
  }
}
