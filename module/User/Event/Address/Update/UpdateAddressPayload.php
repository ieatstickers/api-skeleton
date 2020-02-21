<?php

namespace Skeleton\Module\User\Event\Address\Update;

use Electra\Core\Event\AbstractPayload;

class UpdateAddressPayload extends AbstractPayload
{
  /** @var int */
  public $id;
  /** @var string */
  public $addressLine1;
  /** @var string */
  public $addressLine2;
  /** @var string */
  public $town;
  /** @var string */
  public $county;
  /** @var string */
  public $postCode;

  /** @return string[] */
  public function getRequiredProperties(): array
  {
    return [ 'id' ];
  }

  /** @return array */
  public function getPropertyTypes(): array
  {
    return [
      'id' => 'integer',
      'addressLine1' => 'string',
      'addressLine2' => 'string',
      'town' => 'string',
      'county' => 'string',
      'postCode' => 'string',
    ];
  }
}