<?php

namespace Skeleton\Module\User\Event\Address\Get;

use Electra\Core\Event\AbstractEvent;
use Skeleton\Module\User\Data\Address\Address;

class GetAddressEvent extends AbstractEvent
{
  /** @return string */
  public function getPayloadClass(): string
  {
    return GetAddressPayload::class;
  }

  /**
   * @param GetAddressPayload $payload
   * @return GetAddressResponse
   * @throws \Exception
   */
  protected function process($payload): GetAddressResponse
  {
    $address = Address::getByUserId($payload->userId);
    $response = GetAddressResponse::create();
    $response->address = $address;

    return $response;
  }
}