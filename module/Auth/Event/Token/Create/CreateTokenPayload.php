<?php

namespace Skeleton\Module\Auth\Event\Token\Create;

use Carbon\Carbon;
use Electra\Core\Event\AbstractPayload;

class CreateTokenPayload extends AbstractPayload
{
  /** @var string */
  public $token;
  /** @var int */
  public $userId;
  /** @var Carbon | string */
  public $expiry;

  /** @return string[] */
  public function getRequiredProperties(): array
  {
    return ['token', 'userId' ];
  }

  /** @return array */
  public function getPropertyTypes(): array
  {
    $carbonClass = Carbon::class;

    return [
      'token' => 'string',
      'userId' => 'integer',
      'expiry' => "$carbonClass|string"
    ];
  }
}