<?php

namespace Skeleton\Module\Auth\Endpoint\Authenticate;

use Electra\Web\Endpoint\EndpointInterface;
use Skeleton\Module\Auth\Event\Authenticate\AuthenticateEvent;

class AuthenticateEndpoint extends AuthenticateEvent implements EndpointInterface
{
  /** @return string */
  public function getUri(): string
  {
    return '/auth';
  }

  /** @return string[] */
  public function getHttpMethods(): array
  {
    return ['post'];
  }

  /** @return bool */
  public function requiresAuth()
  {
    return false;
  }
}