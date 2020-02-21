<?php

namespace Skeleton\Module\User\Event\User\GetAll;

use Electra\Core\Event\AbstractResponse;
use Skeleton\Module\User\Data\User\User;

/**
 * Class GetAllUsersResponse
 * @method static $this create($data = [])
 */
class GetAllUsersResponse extends AbstractResponse
{
  /** @var User */
  public $users;
}