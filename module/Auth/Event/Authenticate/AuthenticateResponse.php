<?php

namespace Skeleton\Module\Auth\Event\Authenticate;

use Electra\Core\Event\AbstractResponse;
use Skeleton\Module\User\Data\User\User;

class AuthenticateResponse extends AbstractResponse
{
  /** @var string */
  public $jwt;
  /** @var User */
  public $user;
}