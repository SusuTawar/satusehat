<?php

namespace PhpSatuSehat\Builder;

use Exception;
use PhpSatuSehat\FHIR\AddressType;
use PhpSatuSehat\FHIR\AddressUse;
use PhpSatuSehat\FHIR\ContactPointSystem;
use PhpSatuSehat\FHIR\ContactPointUse;
use PhpSatuSehat\FHIR\IdentifierUse;
use PhpSatuSehat\FHIR\OrganizationType;

/**
 * Class Organization
 *
 * @see http://hl7.org/fhir/R4/organization-definitions.html
 * @package PhpSatuSehat\Builder
 */
class Organization {
  private $data = [
    "resourceType" => "Organization",
    "active" => true,
    "identifier" => [],
    "type" => [],
    "name" => "",
    "telecom" => [],
    "address" => [],
    "partOf" => []
  ];

  public function __construct(array $data = []) {
    $this->data = array_merge($this->data, $data);
  }

  public static function create(array $data) {
    return new Organization($data);
  }

  public function toJson() {
    return json_encode($this->data);
  }

  /**
   * Menambahkan identitas organisasi
   *
   * @param mixed $use salah satu dari "usual", "official", "temp", "secondary"
   * @see \PhpSatuSehat\FHIR\IdentifierUse
   * @param mixed $value identitas organisasi
   * @param string $organizationId Id dari organisasi sumber.
   * @return $this
   * @throws Exception
   */
  public function addIdentifier($use, $value, $organizationId) {
    $use = IdentifierUse::get($use);
    if (!$use) throw new \Exception("IdentifierUse untuk `$use` tidak ditemukan");
    $this->data["identifier"][] = [
      "use" => $use["code"],
      "value" => $value,
      "system" => "http://sys-ids.kemkes.go.id/organization/$organizationId",
    ];

    return $this;
  }

  /**
   * Menambahkan tipe organisasi
   *
   * @param mixed $code tipe organisasi
   * @see \PhpSatuSehat\FHIR\OrganizationType
   * @return $this
   * @throws Exception
   */
  public function addType($code) {
    $orgType = OrganizationType::get($code);
    if(!$orgType) {
      throw new \Exception("OrganizationType untuk `$code` tidak ditemukan");
    }
    $this->data["type"][] = [
      [
        "coding" => [
          "system" => "http://terminology.hl7.org/CodeSystem/organization-type",
          "code" => $orgType['code'],
          "display" => $orgType['display'],
        ]
      ]
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
   * @see https://www.hl7.org/fhir/R4/organization-definitions.html#Organization.telecom
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

  /**
   * Mereferensikan sumber dari organisasi ini.
   *
   * @param mixed $organizationId Id dari organisasi sumber.
   * @return $this
   */
  public function setSource($organizationId) {
    $this->data["partOf"] = [
      "reference" => "Organization/$organizationId"
    ];
    return $this;
  }

  /**
   * Set status aktif/nonaktif organisasi
   *
   * @param bool $value
   * @return $this
   */
  public function setActive($value) {
    $this->data["active"] = $value;
    return $this;
  }

  /**
   * Set nama organisasi
   *
   * @param string $name
   * @return $this
   */
  public function setName($name) {
    $this->data["name"] = $name;
    return $this;
  }

  /**
   * Menambahkan alamat organisasi
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
   * @see https://www.hl7.org/fhir/R4/organization-definitions.html#Organization.address
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
}