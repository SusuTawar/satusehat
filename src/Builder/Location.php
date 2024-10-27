<?php

namespace PhpSatuSehat\Builder;

use Exception;
use PhpSatuSehat\FHIR\AddressType;
use PhpSatuSehat\FHIR\AddressUse;
use PhpSatuSehat\FHIR\ContactPointSystem;
use PhpSatuSehat\FHIR\ContactPointUse;
use PhpSatuSehat\FHIR\LocationPhysicalType;

/**
 * Class Location
 *
 * @see http://hl7.org/fhir/R4/location-definitions.html
 * @package PhpSatuSehat\Builder
 */
class Location {
  private $data = [
    "resourceType" => "Location",
    "identifier" => [],
    "status" => "active",
    "name" => "",
    "description" => "",
    "mode" => "",
    "telecom" => [],
    "address" => [],
    "physicalType" => [
      "coding" => [],
    ],
    "position" => [],
    "managingOrganization" => [],
  ];

  public function __construct(array $data = []) {
    $this->data = array_merge($this->data, $data);
  }

  public static function create(array $data) {
    return new self($data);
  }

  public function toJson() {
    return json_encode($this->data);
  }

  /**
   * Nama lokasi
   *
   * @param string $name
   * @return $this
   */
  public function setName($name) {
    $this->data["name"] = $name;

    return $this;
  }

  /**
   * Deskripsi lokasi
   *
   * @param string $name
   * @return $this
   */
  public function setDescription($description) {
    $this->data["description"] = $description;

    return $this;
  }

  /**
   * mode lokasi
   *
   * @param string $mode
   * @return $this
   */
  public function setMode($mode) {
    $this->data["mode"] = $mode;

    return $this;
  }

  /**
   * Status aktif/nonaktif lokasi
   *
   * @param bool $status
   * @return $this
   */
  public function setStatus($status) {
    $this->data["status"] = $status ? "active" : "inactive";

    return $this;
  }

  /**
   * Menambahkan lokasi
   *
   * @param float $latitude
   * @param float $longitude
   * @param float $altitude
   * @return $this
   */
  public function setLocation($latitude, $longitude, $altitude = 0) {
    $this->data["position"] = [
      "latitude" => $latitude,
      "longitude" => $longitude,
      "altitude" => $altitude,
    ];

    return $this;
  }

  /**
   * Menambahkan identitas lokasi
   *
   * @param mixed $value identitas lokasi
   * @param string $organizationId Id dari organisasi sumber.
   * @return $this
   */
  public function addIdentifier($value, $organizationId) {
    $this->data["identifier"][] = [
      "value" => $value,
      "system" => "http://sys-ids.kemkes.go.id/organization/$organizationId",
    ];

    return $this;
  }

  /**
   * Menambahkan alamat lokasi
   *
   * @param mixed $use salah satu dari "home", "work", "temp", or "old"
   * @see \PhpSatuSehat\FHIR\AddressUse
   * @param mixed $type salah satu dari "postal", "physical", or "both"
   * @see \PhpSatuSehat\FHIR\AddressType
   * @param array $line alamat
   * @param string $city kota
   * @param string $postalCode kode pos
   * @param string $country negara
   * @param array $extension
   *
   * @see https://www.hl7.org/fhir/R4/loction-definitions.html#Loction.address
   * @return $this
   * @throws Exception
   */
  public function addAddress(mixed $use, mixed $type, array $line, string $city, string $postalCode, string $country, mixed $extension = []) {
    $use = AddressUse::get($use);
    if(!$use) throw new \Exception("AddressUse untuk `$use` tidak ditemukan");
    $type = AddressType::get($type);
    if(!$type) throw new \Exception("AddressType untuk `$type` tidak ditemukan");

    $this->data["address"][] = [
      "use" => $use["code"],
      "type" => $type["code"],
      "line" => $line,
      "city" => $city,
      "postalCode" => $postalCode,
      "country" => $country,
      "extension" => [[
        "url" => "https://fhir.kemkes.go.id/r4/StructureDefinition/administrativeCode",
        "extension" => $extension
      ]]
    ];
    return $this;
  }

  /**
   * Tambah data telekomunikasi
   *
   * @param string $system salah satu dari "phone", "fax", "email", "url", or "other"
   * @see \PhpSatuSehat\FHIR\ContactPointSystem
   * @param string $use salah satu dari "home", "work", "mobile", or "temp"
   * @see \PhpSatuSehat\FHIR\ContactPointUse
   * @param string $value nomor/alamat telekomunikasi
   *
   * @see https://www.hl7.org/fhir/R4/location-definitions.html#Location.telecom
   * @return $this
   * @throws Exception
   */
  public function addTelecom($system, $use, $value) {
    $system = ContactPointSystem::get($system);
    $use = ContactPointUse::get($use);
    if (!$system) throw new \Exception("ContactPointSystem untuk `$system` tidak ditemukan");
    if (!$use) throw new \Exception("ContactPointUse untuk `$use` tidak ditemukan");
    $this->data["telecom"][] = [
      "system" => $system,
      "value" => $value,
      "use" => $use
    ];

    return $this;
  }

  public function addPhysicalType($code) {
    $pysicalType = LocationPhysicalType::get($code);
    if (!$pysicalType) throw new \Exception("LocationPhysicalType untuk `$code` tidak ditemukan");
    $this->data["physicalType"]['coding'][] = [
      "system" => "http://terminology.hl7.org/CodeSystem/location-physical-type",
      "code" => $pysicalType['code'],
      "display" => $pysicalType['display'],
    ];
    return $this;
  }
}