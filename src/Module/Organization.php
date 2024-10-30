<?php

namespace PhpSatuSehat\Module;

use PhpSatuSehat\Builder\Organization as BuilderOrganization;

class Organization extends BaseModule {

  public function get($filter = []) {
    return $this->sendRequest("get", "/Organization", null, $filter);
  }

  public function post(BuilderOrganization $data) {
    return $this->sendRequest("post", "/Organization", $data);
  }

  public function update($id, BuilderOrganization $data) {
    return $this->sendRequest("put", "/Organization/$id", $data);
  }
}