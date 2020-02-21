<?php

namespace Skeleton\Module\Auth\Event\Token\Create;

use Skeleton\Module\Auth\Data\Token\Token;
use Electra\Core\Event\AbstractResponse;

class CreateTokenResponse extends AbstractResponse
{
  /** @var Token */
  public $token;
}