<?php

namespace Skeleton\Module\User\Endpoint\User\Create;

use Electra\Web\Endpoint\EndpointInterface;
use Skeleton\Module\User\Event\User\Create\CreateUserEvent;

class CreateUserEndpoint extends CreateUserEvent implements EndpointInterface
{
  /** @return string */
  public function getUri(): string
  {
    return '/user';
  }

  /** @return string[] */
  public function getHttpMethods(): array
  {
    return ['post'];
  }

  /** @return bool */
  public function requiresAuth()
  {
    return true;
  }
}