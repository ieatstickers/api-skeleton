<?php

namespace Skeleton\Module\User\Event\User\Create;

use Electra\Core\Event\AbstractResponse;
use Skeleton\Module\User\Data\User\User;

/**
 * Class CreateUserResponse
 * @method static $this create($data = [])
 */
class CreateUserResponse extends AbstractResponse
{
  /** @var User */
  public $user;
}