<?php

namespace Skeleton\Module\User\Endpoint\User\GetAll;

use Electra\Web\Endpoint\EndpointInterface;
use Skeleton\Module\User\Event\User\GetAll\GetAllUsersEvent;

class GetAllUsersEndpoint extends GetAllUsersEvent implements EndpointInterface
{
  /** @return string */
  public function getUri(): string
  {
    return '/users';
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