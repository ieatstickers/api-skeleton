<?php

namespace Skeleton\Module\Auth\Event;

use Skeleton\Module\Auth\Event\Token\Create\CreateTokenEvent;
use Skeleton\Module\Auth\Event\Token\Create\CreateTokenPayload;
use Skeleton\Module\Auth\Event\Token\Create\CreateTokenResponse;
use Skeleton\Module\Auth\Event\Token\Get\GetTokenEvent;
use Skeleton\Module\Auth\Event\Token\Get\GetTokenPayload;
use Skeleton\Module\Auth\Event\Token\Get\GetTokenResponse;

class AuthEvents
{
  /**
   * @param CreateTokenPayload $payload
   * @return CreateTokenResponse
   * @throws \Exception
   */
  public static function createToken(CreateTokenPayload $payload): CreateTokenResponse
  {
    return (new CreateTokenEvent())->execute($payload);
  }

  /**
   * @param GetTokenPayload $payload
   * @return GetTokenResponse
   * @throws \Exception
   */
  public static function getToken(GetTokenPayload $payload): GetTokenResponse
  {
    return (new GetTokenEvent())->execute($payload);
  }

}