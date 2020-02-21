<?php

namespace Skeleton\Module\Auth\Event\Token\Get;

use Skeleton\Module\Auth\Data\Token\Token;
use Electra\Core\Event\AbstractResponse;

class GetTokenResponse extends AbstractResponse
{
  /** @var Token */
  public $token;
}