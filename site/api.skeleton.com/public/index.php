<?php

use Electra\Jwt\Middleware\JwtMiddleware;
use Electra\Web\Application\Api;
use Skeleton\Module\Auth\Endpoint\Authenticate\AuthenticateEndpoint;
use Skeleton\Module\Auth\Middleware\DenyInvalidAuthTokensMiddleware;
use Skeleton\Module\User\Endpoint\User\Create\CreateUserEndpoint;
use Skeleton\Module\User\Endpoint\User\Get\GetUserEndpoint;
use Skeleton\Module\User\Endpoint\User\GetAll\GetAllUsersEndpoint;
use Skeleton\Module\User\Endpoint\User\Update\UpdateUserEndpoint;
use Skeleton\Module\User\Middleware\SetAuthedUserMiddleware;
use Skeleton\SkeletonProject;

$appDir = __DIR__ . '/../../..';
$loader = include_once $appDir . '/vendor/autoload.php';

try {
  // Handle required setup e.g. register exception handler, register DB connections etc
  SkeletonProject::init();

  $api = new Api();

  /** MIDDLEWARE */
  $api->addMiddleware(new JwtMiddleware()); // Set JWT in context if Authorization header is set
  $api->addMiddleware(new DenyInvalidAuthTokensMiddleware()); //
  $api->addMiddleware(new SetAuthedUserMiddleware());

  /** AUTH */
  $api->addEndpoint(new AuthenticateEndpoint());

  /** USER */
  $api->addEndpoint(new GetUserEndpoint());
  $api->addEndpoint(new UpdateUserEndpoint());
  $api->addEndpoint(new GetAllUsersEndpoint());
  $api->addEndpoint(new CreateUserEndpoint());

  $api->run();
}
catch (\Exception $e)
{
  // TODO: Return error response with correct response code
  throw $e;
}
