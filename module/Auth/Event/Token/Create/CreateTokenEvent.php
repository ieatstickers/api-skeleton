<?php

namespace Skeleton\Module\Auth\Event\Token\Create;

use Skeleton\Module\Auth\Data\Token\Token;
use Electra\Core\Event\AbstractEvent;

class CreateTokenEvent extends AbstractEvent
{
  /** @return string */
  public function getPayloadClass(): string
  {
    return CreateTokenPayload::class;
  }

  /**
   * @param CreateTokenPayload $payload
   * @return CreateTokenResponse
   * @throws \Exception
   */
  protected function process($payload): CreateTokenResponse
  {
    $response = CreateTokenResponse::create();

    $token = Token::create($payload);
    Token::save($token);

    $response->token = $token;

    return $response;
  }
}