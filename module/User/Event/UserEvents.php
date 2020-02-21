<?php

namespace Skeleton\Module\User\Event;

use Skeleton\Module\User\Event\Address\Create\CreateAddressEvent;
use Skeleton\Module\User\Event\Address\Create\CreateAddressPayload;
use Skeleton\Module\User\Event\Address\Create\CreateAddressResponse;
use Skeleton\Module\User\Event\Address\Get\GetAddressEvent;
use Skeleton\Module\User\Event\Address\Get\GetAddressPayload;
use Skeleton\Module\User\Event\Address\Get\GetAddressResponse;
use Skeleton\Module\User\Event\Address\Update\UpdateAddressEvent;
use Skeleton\Module\User\Event\Address\Update\UpdateAddressPayload;
use Skeleton\Module\User\Event\Address\Update\UpdateAddressResponse;
use Skeleton\Module\User\Event\User\Create\CreateUserEvent;
use Skeleton\Module\User\Event\User\Create\CreateUserPayload;
use Skeleton\Module\User\Event\User\Create\CreateUserResponse;
use Skeleton\Module\User\Event\User\Get\GetUserEvent;
use Skeleton\Module\User\Event\User\Get\GetUserPayload;
use Skeleton\Module\User\Event\User\Get\GetUserResponse;
use Skeleton\Module\User\Event\User\Update\UpdateUserEvent;
use Skeleton\Module\User\Event\User\Update\UpdateUserPayload;
use Skeleton\Module\User\Event\User\Update\UpdateUserResponse;

class UserEvents
{
  /**
   * @param CreateUserPayload $payload
   * @return CreateUserResponse
   * @throws \Exception
   */
  public static function createUser(CreateUserPayload $payload): CreateUserResponse
  {
    return (new CreateUserEvent())->execute($payload);
  }

  /**
   * @param GetUserPayload $payload
   * @return GetUserResponse
   * @throws \Exception
   */
  public static function getUser(GetUserPayload $payload): GetUserResponse
  {
    return (new GetUserEvent())->execute($payload);
  }

  /**
   * @param UpdateUserPayload $payload
   * @return UpdateUserResponse
   * @throws \Exception
   */
  public static function updateUser(UpdateUserPayload $payload): UpdateUserResponse
  {
    return (new UpdateUserEvent())->execute($payload);
  }

  /**
   * @param CreateAddressPayload $payload
   * @return CreateAddressResponse
   * @throws \Exception
   */
  public static function createAddress(CreateAddressPayload $payload): CreateAddressResponse
  {
    return (new CreateAddressEvent())->execute($payload);
  }

  /**
   * @param GetAddressPayload $payload
   * @return GetAddressResponse
   * @throws \Exception
   */
  public static function getAddress(GetAddressPayload $payload): GetAddressResponse
  {
    return (new GetAddressEvent())->execute($payload);
  }

  /**
   * @param UpdateAddressPayload $payload
   * @return UpdateAddressResponse
   * @throws \Exception
   */
  public static function updateAddress(UpdateAddressPayload $payload): UpdateAddressResponse
  {
    return (new UpdateAddressEvent())->execute($payload);
  }

}