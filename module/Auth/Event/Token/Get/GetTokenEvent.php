<?php

namespace Skeleton\Module\Auth\Event\Token\Get;

use Skeleton\Module\Auth\Data\Token\Token;
use Electra\Core\Event\AbstractEvent;

class GetTokenEvent extends AbstractEvent
{
  /** @return string */
  public function getPayloadClass(): string
  {
    return GetTokenPayload::class;
  }

  /**
   * @param GetTokenPayload $payload
   * @return GetTokenResponse
   * @throws \Exception
   */
  protected function process($payload): GetTokenResponse
  {
    $response = GetTokenResponse::create();

    $token = Token::getByTokenAndUserId(
      $payload->token,
      $payload->userId
    );

    $response->token = $token;

    return $response;
  }
}