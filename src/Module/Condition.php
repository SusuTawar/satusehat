<?php

namespace PhpSatuSehat\Module;

use PhpSatuSehat\Builder\Condition as BuilderCondition;

class Condition extends BaseModule {

  public function find($id) {
    return $this->sendRequest("get", "/Condition/$id");
  }

  public function get($filter = []) {
    return $this->sendRequest("get", "/Condition", null, $filter);
  }

  public function post(BuilderCondition $data) {
    return $this->sendRequest("post", "/Condition", $data);
  }

  public function put($id, BuilderCondition $data) {
    return $this->sendRequest("put", "/Condition/$id", $data);
  }
}