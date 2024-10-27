<?php

namespace PhpSatuSehat\FHIR;

class ContactPointSystem extends Base
{

  public const PHONE = [
    "code" => "phone",
    "display" => "Phone",
    "definition" => "The value is a telephone number used for voice calls. Use of full international numbers starting with + is recommended to enable automatic dialing support but not required."
  ];

  public const FAX = [
    "code" => "fax",
    "display" => "Fax",
    "definition" => "The value is a fax machine. Use of full international numbers starting with + is recommended to enable automatic dialing support but not required."
  ];

  public const EMAIL = [
    "code" => "email",
    "display" => "Email",
    "definition" => "The value is an email address."
  ];

  public const PAGER = [
    "code" => "pager",
    "display" => "Pager",
    "definition" => "The value is a pager number. These may be local pager numbers that are only usable on a particular pager system."
  ];

  public const URL = [
    "code" => "url",
    "display" => "URL",
    "definition" => "A contact that is not a phone, fax, pager or email address and is expressed as a URL. This is intended for various institutional or personal contacts including web sites, blogs, Skype, Twitter, Facebook, etc. Do not use for email addresses."
  ];

  public const SMS = [
    "code" => "sms",
    "display" => "SMS",
    "definition" => "A contact that can be used for sending a sms message (e.g. mobile phones, some landlines)."
  ];

  public const OTHER = [
    "code" => "other",
    "display" => "Other",
    "definition" => "A contact that is not a phone, fax, page or email address and is not expressible as a URL. E.g. Internal mail address. This SHOULD NOT be used for contacts that are expressible as a URL (e.g. Skype, Twitter, Facebook, etc.) Extensions may be used to distinguish \"other\" contact types."
  ];

  public static function values(): array
  {
    return [
      self::PHONE['code'] => self::PHONE,
      self::FAX['code'] => self::FAX,
      self::EMAIL['code'] => self::EMAIL,
      self::PAGER['code'] => self::PAGER,
      self::URL['code'] => self::URL,
      self::SMS['code'] => self::SMS,
      self::OTHER['code'] => self::OTHER
    ];
  }
}
