<?php

namespace PhpSatuSehat\Builder;

use Exception;
use PhpSatuSehat\FHIR\AddressType;
use PhpSatuSehat\FHIR\AddressUse;
use PhpSatuSehat\FHIR\AdministrativeGender;
use PhpSatuSehat\FHIR\ContactPointSystem;
use PhpSatuSehat\FHIR\ContactPointUse;
use PhpSatuSehat\FHIR\ContactRole;
use PhpSatuSehat\FHIR\IdentifierUse;
use PhpSatuSehat\FHIR\MaritalStatus;

class Patient extends ResourceBuilder
{
  protected $data = [
    "resourceType" => "Patient",
    "meta" => [
      "profile" => [
        "https://fhir.kemkes.go.id/r4/StructureDefinition/Patient"
      ],
    ],
    "identifier" => [],
    "active" => true,
    "name" => [],
    "telecom" => [],
    "gender" => "female",
    "birthDate" => "1945-11-17",
    "deceasedBoolean" => false,
    "multipleBirthBoolean" => false,
    "address" => [],
    "maritalStatus" => [],
    "contact" => [],
    "communication" => [],
    "extension" => [],
  ];

  /**
   * Status aktif pasien
   * 
   * @param bool $value 
   * @return $this 
   */
  public function setActive(bool $value)
  {
    $this->data["active"] = $value ? true : false;
    return $this;
  }

  /**
   * Jenis kelamin pasien
   * 
   * @param mixed $value male | female | other | unknown
   * @see \PhpSatuSehat\FHIR\AdministrativeGender
   * @return $this 
   * @throws Exception 
   */
  public function setGender($value)
  {
    $value = AdministrativeGender::get($value);
    if (!$value) throw new \Exception("AdministrativeGender untuk `$value` tidak ditemukan");
    $this->data["gender"] = $value;
    return $this;
  }

  /**
   * Tanggal lahir
   * 
   * @param string $value format YYYY-MM-DD
   * @return $this
   * @throws \Exception
   */
  public function setBirthDate($value)
  {
    if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $value)) {
      throw new \Exception("BirthDate harus berupa format YYYY-MM-DD");
    }
    // check if date is valid
    $y = substr($value, 0, 4);
    $m = substr($value, 5, 2);
    $d = substr($value, 8, 2);

    if (!checkdate($m, $d, $y)) {
      throw new \Exception("BirthDate tidak valid");
    }
    $this->data["birthDate"] = $value;
    return $this;
  }

  /**
   *
   * @param bool $value
   * @return $this
   */
  public function setDeceased($value)
  {
    $this->data["deceasedBoolean"] = $value ? true : false;
    return $this;
  }

  /**
   *
   * @param int $value
   * @return $this
   */
  public function setMultipleBirth(int $value)
  {
    $this->data["multipleBirthBoolean"] = $value;
    return $this;
  }

  /**
   * Identifier pasien
   *
   * @param string $use
   * @see \PhpSatuSehat\FHIR\IdentifierUse
   */
  public function addIdentifier($use, $type, $value)
  {
    $use = IdentifierUse::get($use);
    if (!$use) throw new \Exception("IdentifierUse untuk `$use` tidak ditemukan");
    $identifier = [
      "use" => $use["code"],
      "system" => "https://fhir.kemkes.go.id/id/$type",
      "value" => $value,
    ];
    $this->data["identifier"][] = $identifier;

    return $this;
  }

  /**
   * Nama pasien
   *
   * @param string $use
   * @see \PhpSatuSehat\FHIR\IdentifierUse
   * @param string $value
   */
  public function addName($use, $value)
  {
    $use = IdentifierUse::get($use);
    if (!$use) throw new \Exception("IdentifierUse untuk `$use` tidak ditemukan");
    $this->data["name"][] = [
      "use" => $use["code"],
      "text" => $value,
    ];
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
  public function addTelecom($system, $use, $value)
  {
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
   * Menambahkan alamat pasien
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
  public function addAddress(mixed $use, mixed $type, array $line, string $city, string $postalCode, string $country, mixed $extension = [])
  {
    $use = AddressUse::get($use);
    if (!$use) throw new \Exception("AddressUse untuk `$use` tidak ditemukan");
    $type = AddressType::get($type);
    if (!$type) throw new \Exception("AddressType untuk `$type` tidak ditemukan");

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
   * Set status pernikahan pasien.
   *
   * @param mixed $value Marital status code.
   * @see \PhpSatuSehat\FHIR\MaritalStatus
   * @return $this
   * @throws Exception if the marital status is not found.
   */
  public function setMaritalStatus($value)
  {
    $value = MaritalStatus::get($value);
    if (!$value) throw new \Exception("MaritalStatus untuk `$value` tidak ditemukan");
    $this->data["maritalStatus"] = [
      "coding" => [
        [
          "system" => "http://terminology.hl7.org/CodeSystem/v3-MaritalStatus",
          "code" => $value["code"],
          "display" => $value["display"]
        ]
      ],
      "text" => $value["display"]
    ];
    return $this;
  }

  /**
   * Tambahkan informasi kontak pasien.
   *
   * @param mixed $relationType The type of relationship to the patient.
   * @see \PhpSatuSehat\FHIR\ContactRole
   * @param mixed $nameType The type of name for the contact person.
   * @see \PhpSatuSehat\FHIR\IdentifierUse
   * @param string $name The name of the contact person.
   * @param mixed|null $telecom Optional telecommunications contact information.
   * 
   * @return $this
   * @throws \Exception if the relation type is not found.
   */
  public function addContact($relationType, $nameType, $name, $telecom = null)
  {
    $relationType = ContactRole::get($relationType);
    if (!$relationType) throw new \Exception("ContactRole untuk `$relationType` tidak ditemukan");

    $nameType = IdentifierUse::get($nameType);
    if (!$nameType) throw new \Exception("IdentifierUse untuk `$nameType` tidak ditemukan");
    $this->data["contact"][] = [
      "relationship" => [
        "coding" => [
          [
            "system" => $relationType["system"],
            "code" => $relationType["code"],
          ]
        ],
      ],
      "name" => [
        "use" => $nameType["code"],
        "text" => $name
      ],
      "telecom" => $telecom
    ];

    return $this;
  }

  /**
   * Tambahkan informasi bahasa komunikasi yang diperlukan pasien
   *
   * @param string $languageTag Bahasa yang digunakan dalam format ietf:bcp47 cth: "id-ID"
   * @param string $text Deskripsi bahasa, digunakan sebagai display
   * @param bool $prefered Opsional, apakah komunikasi ini lebih diutamakan
   *
   * @see https://www.hl7.org/fhir/patient-definitions.html#Patient.communication
   * @return $this
   * @throws \Exception jika languageTag tidak berupa ietf:bcp47
   */
  public function addComunication($languageTag, $text, $prefered = false)
  {
    if (!preg_match('/^[a-z]{2}(-[A-Z]{2})?$/', $languageTag)) {
      throw new \Exception("languageTag harus berupa ietf:bcp47");
    }

    $this->data["communication"][] = [
      "language" => [
        "coding" => [
          [
            "system" => "urn:ietf:bcp47",
            "code" => $languageTag,
            "display" => $text,
          ]
        ],
        "text" => $text,
      ],
      "preferred" => $prefered,
    ];
    return $this;
  }


  /**
   * Tambahkan extension pada resource pasien.
   *
   * @param array $extension data extension dalam bentuk array
   *
   * @see https://www.hl7.org/fhir/extensibility.html#Extension
   * @return $this
   */
  public function addExtension($extension)
  {

    $this->data["extension"][] = $extension;
    return $this;
  }
}
