<?php

namespace PhpSatuSehat\Module;

class Practitioner extends BaseModule {
  public function get($filter = []) {
    return $this->sendRequest("get", "/Practitioner", null, $filter);
  }

  public function find($id) {
    return $this->get('get', "/Practitioner/$id");
  }

  public function byNik($nik) {
    return $this->get([
      "identifier" => "https://fhir.kemkes.go.id/id/nik|$nik"
    ]);
  }
}