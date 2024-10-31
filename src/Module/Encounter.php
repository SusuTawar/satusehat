<?php

namespace PhpSatuSehat\Module;

use PhpSatuSehat\Builder\Encounter as BuilderEncounter;

class Encounter extends BaseModule {
  public function find($id) {
    return $this->sendRequest("get", "/Encounter/$id");
  }

  public function get($filter = []) {
    return $this->sendRequest("get", "/Encounter", null, $filter);
  }

  public function post(BuilderEncounter $data) {
    return $this->sendRequest("post", "/Encounter", $data);
  }

  public function put($id, BuilderEncounter $data) {
    return $this->sendRequest("put", "/Encounter/$id", $data);
  }
}
