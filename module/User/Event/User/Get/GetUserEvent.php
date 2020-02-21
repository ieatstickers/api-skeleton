<?php

namespace Skeleton\Module\User\Event\User\Get;

use Electra\Core\Event\AbstractEvent;
use Skeleton\Module\User\Data\User\User;
use Skeleton\Module\User\Event\Address\Get\GetAddressPayload;
use Skeleton\Module\User\Event\UserEvents;

class GetUserEvent extends AbstractEvent
{
  /** @return string */
  public function getPayloadClass(): string
  {
    return GetUserPayload::class;
  }

  /**
   * @param GetUserPayload $payload
   * @return GetUserResponse
   * @throws \Exception
   */
  protected function process($payload): GetUserResponse
  {
    $user = null;

    if ($payload->id)
    {
      $user = User::getById($payload->id);
    }

    if (!$user && $payload->emailAddress)
    {
      $user = User::getByEmailAddress($payload->emailAddress);
    }

    if ($user)
    {
      $getAddressPayload = GetAddressPayload::create();
      $getAddressPayload->userId = $user->id;
      $getAddressResponse = UserEvents:: getAddress($getAddressPayload);

      if ($getAddressResponse->address)
      {
        $user->address = $getAddressResponse->address;
      }
    }

    $response = GetUserResponse::create();

    $response->user = $user;

    return $response;
  }
}