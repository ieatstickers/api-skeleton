<?php

namespace Skeleton\Module\User\Context;

use Skeleton\Module\User\Data\User\User;

class UserContext
{
  /** @var User */
  private static $authedUser;

  /** @return User|null */
  public static function getAuthedUser(): ?User
  {
    return self::$authedUser;
  }

  /**
   * @param User $authedUser
   * @return void
   */
  public static function setAuthedUser(User $authedUser)
  {
    self::$authedUser = $authedUser;
  }

}