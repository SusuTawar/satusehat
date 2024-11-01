<?php

namespace PhpSatuSehat\Module;

use PhpSatuSehat\Builder\Observation as Builderobservation;

class Observation extends BaseModule {
  public function find($id) {
    return $this->sendRequest("get", "/Observation/$id");
  }

  public function get($filter = []) {
    return $this->sendRequest("get", "/Observation", null, $filter);
  }

  public function post(Builderobservation $data) {
    return $this->sendRequest("post", "/Observation", $data);
  }

  public function update($id, Builderobservation $data) {
    return $this->sendRequest("put", "/Observation/$id", $data);
  }
}