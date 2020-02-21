<?php

namespace Skeleton\Module\User\Endpoint\User\Update;

use Electra\Web\Endpoint\EndpointInterface;
use Skeleton\Module\User\Event\User\Update\UpdateUserEvent;

class UpdateUserEndpoint extends UpdateUserEvent implements EndpointInterface
{
  /** @return string */
  public function getUri(): string
  {
    return '/user/{id}';
  }

  /** @return string[] */
  public function getHttpMethods(): array
  {
    return ['put'];
  }

  /** @return bool */
  public function requiresAuth()
  {
    return true;
  }
}