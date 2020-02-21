<?php

namespace Skeleton\Module\User\Middleware;

use Electra\Jwt\Context\ElectraJwtContext;
use Electra\Web\Endpoint\EndpointInterface;
use Electra\Web\Http\Request;
use Electra\Web\Middleware\MiddlewareInterface;
use Skeleton\Module\User\Context\UserContext;
use Skeleton\Module\User\Event\User\Get\GetUserPayload;
use Skeleton\Module\User\Event\UserEvents;

class SetAuthedUserMiddleware implements MiddlewareInterface
{
  /**
   * @param EndpointInterface $endpoint
   * @param Request $request
   * @param array $routeParams
   * @return bool
   * @throws \Exception
   */
  public function run(EndpointInterface $endpoint, Request $request, ...$routeParams): bool
  {
    $token = ElectraJwtContext::getToken();

    if ($token && $token->verified)
    {
      $userId = $token->getClaim('uid');

      $getUserPayload = GetUserPayload::create();
      $getUserPayload->id = $userId;
      $getUserResponse = UserEvents::getUser($getUserPayload);

      if ($getUserResponse->user)
      {
        UserContext::setAuthedUser($getUserResponse->user);
      }
    }

    return true;
  }
}