<?php

namespace Skeleton\Module\Auth\Event\Token\Get;

use Electra\Core\Event\AbstractPayload;

class GetTokenPayload extends AbstractPayload
{
  /** @var string */
  public $token; // the jwt string
  /** @var int */
  public $userId;

  /** @return string[] */
  public function getRequiredProperties(): array
  {
    return ['token', 'userId'];
  }

  /** @return array */
  public function getPropertyTypes(): array
  {
    return [
      'token' => 'string',
      'userId' => 'integer'
    ];
  }
}