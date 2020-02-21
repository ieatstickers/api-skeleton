<?php

namespace Skeleton\Module\User\Event\User\Create;

use Electra\Core\Event\AbstractEvent;
use Electra\Core\Event\AbstractPayload;
use Electra\Utility\Passwords;
use Skeleton\Module\User\Data\User\User;

class CreateUserEvent extends AbstractEvent
{
  /** @return string */
  public function getPayloadClass(): string
  {
    return CreateUserPayload::class;
  }

  /**
   * @param AbstractPayload $payload
   * @return CreateUserResponse
   * @throws \Exception
   */
  protected function process($payload): CreateUserResponse
  {
    $payload->password = Passwords::hashPassword($payload->password);
    $user = User::create($payload);
    User::save($user);

    $response = CreateUserResponse::create();
    $response->user = $user;

    return $response;
  }
}