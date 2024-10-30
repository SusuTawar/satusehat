<?php

namespace PhpSatuSehat\Module;

use PhpSatuSehat\Builder\Location as BuilderLocation;

class Location extends BaseModule {
  public function get($filter = []) {
    return $this->sendRequest("get", "/Location", null, $filter);
  }

  public function post(BuilderLocation $data) {
    return $this->sendRequest("post", "/Location", $data);
  }

  public function update($id, BuilderLocation $data) {
    return $this->sendRequest("put", "/Location/$id", $data);
  }

}