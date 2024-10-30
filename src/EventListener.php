<?php

namespace PhpSatuSehat;

class EventListener {
  public const ON_TOKEN_RECEIVED = 'token:received';

  private $handler;
  private $event;

  public function __construct($event, $handler) {
    $this->handler = $handler;
    $this->event = $event;
  }

  public function handle(...$arguments) {
    $handler = $this->handler;
    if (is_callable($handler)) {
      $handler(...$arguments);
    }
  }

  public function getEvent() {
    return $this->event;
  }
}