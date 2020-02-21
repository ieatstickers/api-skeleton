<?php

namespace Skeleton\Module\User\Event\Address\Update;

use Electra\Core\Event\AbstractEvent;
use Electra\Core\Exception\ElectraException;
use Skeleton\Module\User\Data\Address\Address;

class UpdateAddressEvent extends AbstractEvent
{
  /** @return string */
  public function getPayloadClass(): string
  {
    return UpdateAddressPayload::class;
  }

  /**
   * @param UpdateAddressPayload $payload
   * @return UpdateAddressResponse
   * @throws \Exception
   */
  protected function process($payload): UpdateAddressResponse
  {
    $address = Address::getById($payload->id);

    if (!$address)
    {
      throw (
        new ElectraException(
        'Cannot update an address that does not exist',
        'Address not found'
        )
      )
        ->addMetaData('id', $payload->id);
    }

    $updated = false;

    // Address line 1
    if (
      $payload->addressLine1
      && $payload->addressLine1 !== $address->addressLine1
    )
    {
      $address->addressLine1 = $payload->addressLine1;
      $updated = true;
    }

    // Address line 2
    if (
      $payload->addressLine2
      && $payload->addressLine2 !== $address->addressLine2
    )
    {
      $address->addressLine2 = $payload->addressLine2;
      $updated = true;
    }

    // Town
    if (
      $payload->town
      && $payload->town !== $address->town
    )
    {
      $address->town = $payload->town;
      $updated = true;
    }

    // County
    if (
      $payload->county
      && $payload->county !== $address->county
    )
    {
      $address->county = $payload->county;
      $updated = true;
    }

    // Post code
    if (
      $payload->postCode
      && $payload->postCode !== $address->postCode
    )
    {
      $address->postCode = $payload->postCode;
      $updated = true;
    }

    if ($updated)
    {
      Address::save($address);
    }

    $response = UpdateAddressResponse::create();
    $response->address = $address;

    return $response;
  }
}