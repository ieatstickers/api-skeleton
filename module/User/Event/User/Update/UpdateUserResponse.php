<?php

namespace Skeleton\Module\User\Event\User\Update;

use Electra\Core\Event\AbstractResponse;
use Skeleton\Module\User\Data\User\User;

/**
 * Class UpdateUserResponse
 * @method static $this create($data = [])
 */
class UpdateUserResponse extends AbstractResponse
{
  /** @var User */
  public $user;
}