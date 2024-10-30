<?php

namespace PhpSatuSehat\Module;

class Organization extends BaseModule {
  public function get($filter = []) {
    return $this->sendRequest("get", "/Practitioner", null, $filter);
  }

  public function find($nik) {
    return $this->get([
      "identifier" => "https://fhir.kemkes.go.id/id/nik|$nik"
    ]);
  }
}