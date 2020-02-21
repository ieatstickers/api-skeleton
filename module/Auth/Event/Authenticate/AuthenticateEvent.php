<?php

namespace Skeleton\Module\Auth\Event\Authenticate;

use Electra\Core\Event\AbstractEvent;
use Electra\Jwt\Context\ElectraJwtContext;
use Electra\Jwt\Data\Token\Token as JwtToken;
use Electra\Jwt\Event\ElectraJwtEvents;
use Electra\Jwt\Event\GenerateJwt\GenerateJwtPayload;
use Electra\Jwt\Event\ParseJwt\ParseJwtPayload;
use Electra\Utility\Passwords;
use Skeleton\Module\Auth\Data\Token\Token;
use Skeleton\Module\Auth\Event\AuthEvents;
use Skeleton\Module\Auth\Event\Token\Create\CreateTokenPayload;
use Skeleton\Module\User\Context\UserContext;
use Skeleton\Module\User\Event\User\Get\GetUserPayload;
use Skeleton\Module\User\Event\UserEvents;

class AuthenticateEvent extends AbstractEvent
{
  /** @return string */
  public function getPayloadClass(): string
  {
    return AuthenticatePayload::class;
  }

  /**
   * @param AuthenticatePayload $payload
   * @return AuthenticateResponse
   * @throws \Exception
   */
  protected function process($payload): AuthenticateResponse
  {
    $response = AuthenticateResponse::create();

    // Get user by emailAddress
    $getUserPayload = GetUserPayload::create($payload);
    $getUserResponse = UserEvents::getUser($getUserPayload);
    $user = $getUserResponse->user;

    // If a user is found
    if ($user)
    {
      // And the password matches
      if (Passwords::verifyPassword($payload->password, $user->password))
      {
        // Generate a new JWT string
        $jwt = $this->generateJwt($user->id);

        // Create a Token row in the DB
        $this->persistToken($jwt, $user->id);

        // Get a JwtToken instance
        $jwtToken = $this->parseJwt($jwt);

        if ($jwtToken && $jwtToken->verified)
        {
          // Set the token and the authed user on the relevant contexts
          ElectraJwtContext::setToken($jwtToken);
          UserContext::setAuthedUser($getUserResponse->user);

          // Add jwt string and authed user to response
          $response->jwt = $jwt;
          $response->user = $getUserResponse->user;
        }

        return $response;
      }
    }

    // TODO: Return message saying email or password incorrect

    return $response;
  }

  /**
   * @param int $userId
   * @return string
   * @throws \Exception
   */
  private function generateJwt(int $userId): string
  {
    $generateJwtPayload = GenerateJwtPayload::create();
    $generateJwtPayload->jwtPayload = [
      'uid' => $userId
    ];

    // Generate JWT
    $generateJwtResponse = ElectraJwtEvents::generateJwt($generateJwtPayload);

    return $generateJwtResponse->jwt;
  }

  /**
   * @param string $jwt
   * @param int $userId
   * @return Token
   * @throws \Exception
   */
  private function persistToken(string $jwt, int $userId): Token
  {
    $payload = CreateTokenPayload::create();
    $payload->userId = $userId;
    $payload->token = $jwt;
    $response = AuthEvents::createToken($payload);

    return $response->token;
  }

  /**
   * @param string $jwt
   * @return JwtToken
   * @throws \Exception
   */
  private function parseJwt(string $jwt): JwtToken
  {
    // Parse to get Token instance
    $payload = ParseJwtPayload::create();
    $payload->jwt = $jwt;
    $response = ElectraJwtEvents::parseJwt($payload);
    return $response->token;
  }
}