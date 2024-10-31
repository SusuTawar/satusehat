<?php

namespace PhpSatuSehat\Builder;

/**
 * Class Organization
 *
 * @see http://hl7.org/fhir/R4/organization-definitions.html
 * @package PhpSatuSehat\Builder
 */
class ResourceBuilder {
  protected $data = [];

  public function __construct(array $data = []) {
    $this->data = array_merge($this->data, $data);
  }

  public static function create(array $data) {
    return new ResourceBuilder($data);
  }

  public function toJson() {
    return json_encode($this->data);
  }
}