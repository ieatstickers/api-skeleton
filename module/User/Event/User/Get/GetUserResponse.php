<?php

namespace Skeleton\Module\User\Event\User\Get;

use Electra\Core\Event\AbstractResponse;
use Skeleton\Module\User\Data\User\User;

/**
 * Class GetUserResponse
 * @method static $this create($data = [])
 */
class GetUserResponse extends AbstractResponse
{
  /** @var User */
  public $user;
}