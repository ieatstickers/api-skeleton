<?php

namespace Skeleton\Module\User\Data\User;

use Electra\Dal\Database\Mysql\Model;
use Skeleton\Module\User\Event\User\Get\GetUserPayload;
use Skeleton\Module\User\Event\UserEvents;

class UserModel extends Model
{
  protected $connection = 'app';
  protected $table = 'user';

  public function something()
  {
    $payload = GetUserPayload::create();
    $payload->id = 1;

    $response = UserEvents::getUser($payload);

    User::save($response->user);
  }
}