<?php

namespace Skeleton\Module\User\Endpoint\User\Get;

use Electra\Web\Endpoint\EndpointInterface;
use Skeleton\Module\User\Event\User\Get\GetUserEvent;

class GetUserEndpoint extends GetUserEvent implements EndpointInterface
{
  /** @return string */
  public function getUri(): string
  {
    return '/user/{id}';
  }

  /** @return string[] */
  public function getHttpMethods(): array
  {
    return ['get'];
  }

  /** @return bool */
  public function requiresAuth()
  {
    return true;
  }
}