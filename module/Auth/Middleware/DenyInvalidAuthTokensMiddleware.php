<?php

namespace Skeleton\Module\Auth\Middleware;

use Carbon\Carbon;
use Electra\Jwt\Context\ElectraJwtContext;
use Electra\Utility\Classes;
use Skeleton\Module\Auth\Event\AuthEvents;
use Skeleton\Module\Auth\Event\Token\Get\GetTokenPayload;
use Electra\Core\Exception\ElectraException;
use Electra\Core\Exception\ElectraUnauthorizedException;
use Electra\Web\Endpoint\EndpointInterface;
use Electra\Web\Http\Request;
use Electra\Web\Middleware\MiddlewareInterface;

class DenyInvalidAuthTokensMiddleware implements MiddlewareInterface
{
  /**
   * @param EndpointInterface $endpoint
   * @param Request $request
   * @param array $routeParams
   * @return bool
   * @throws ElectraException
   * @throws \Exception
   */
  public function run(EndpointInterface $endpoint, Request $request, ...$routeParams): bool
  {
    if (!$endpoint->requiresAuth()) return true;

    $hasValidAuthToken = false;

    // If auth header is set
    if ($authHeaderValue = $request->header('Authorization'))
    {
      [$schema, $jwt] = explode(' ', $authHeaderValue);

      // Get token from JWT context (wil have been set by previous middleware if Authorization header is present)
      $jwtToken = ElectraJwtContext::getToken();

      // If we have a verified token set on the context
      if ($jwtToken && $jwtToken->verified)
      {
        // Get matching token from the DB
        $getTokenPayload = GetTokenPayload::create();
        $getTokenPayload->token = $jwt;
        $getTokenPayload->userId = $jwtToken->getRequiredClaim('uid');

        $getTokenResponse = AuthEvents::getToken($getTokenPayload);

        // If we have a related token in the DB and it has no expiry, return true
        if (
          $getTokenResponse->token
          && !$getTokenResponse->token->expiry
        )
        {
          return true;
        }

        // If the token has an expiry but the date hasn't passed, return true
        if (
          $getTokenResponse->token
          && $getTokenResponse->token->expiry
          && $getTokenResponse->token->expiry->gte(new Carbon())
        )
        {
          $hasValidAuthToken = true;
        }
      }
    }

    // If endpoint is authenticated & no token is set
    if (!$hasValidAuthToken)
    {
      throw (new ElectraUnauthorizedException('Unauthorized'))
        ->addMetaData('endpoint', Classes::getClassName(get_class($endpoint)))
        ->addMetaData('token', ElectraJwtContext::getToken());
    }

    return true;
  }
}