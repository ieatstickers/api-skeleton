<?php

namespace Skeleton\Module\User\Event\Address\Create;

use Electra\Core\Event\AbstractEvent;
use Skeleton\Module\User\Data\Address\Address;

class CreateAddressEvent extends AbstractEvent
{
  /** @return string */
  public function getPayloadClass(): string
  {
    return CreateAddressPayload::class;
  }

  /**
   * @param CreateAddressPayload $payload
   * @return CreateAddressResponse
   * @throws \Exception
   */
  protected function process($payload): CreateAddressResponse
  {
    $address = Address::create($payload);
    Address::save($address);

    $response = CreateAddressResponse::create();
    $response->address = $address;

    return $response;
  }
}