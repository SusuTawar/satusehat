<?php

namespace PhpSatuSehat\Module;

use PhpSatuSehat\Builder\Patient as BuilderPatient;

class Patient extends BaseModule {
  public function get($filter = []) {
    return $this->sendRequest("get", "/Patient", null, $filter);
  }

  public function byNik($nik, $nikIbu = false, $filter = []) {
    $query = "https://fhir.kemkes.go.id/id/nik";
    if ($nikIbu) $query .= "-ibu";
    $query .= "|$nik";
    $filter = array_merge($filter, ["identifier" => $query]);
    return $this->get($filter);
  }

  public function create(BuilderPatient $data) {
    
  }
}
