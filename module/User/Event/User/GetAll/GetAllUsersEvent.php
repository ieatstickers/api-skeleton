<?php

namespace Skeleton\Module\User\Event\User\GetAll;

use Electra\Core\Event\AbstractEvent;
use Skeleton\Module\User\Data\User\User;

class GetAllUsersEvent extends AbstractEvent
{
  /** @return string */
  public function getPayloadClass(): string
  {
    return GetAllUsersPayload::class;
  }

  /**
   * @param GetAllUsersPayload $payload
   * @return GetAllUsersResponse
   * @throws \Exception
   */
  protected function process($payload): GetAllUsersResponse
  {
    $users = User::getAll();

    $response = GetAllUsersResponse::create();
    $response->users = $users;

    return $response;
  }
}