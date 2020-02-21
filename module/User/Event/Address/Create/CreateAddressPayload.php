<?php

namespace Skeleton\Module\User\Event\Address\Create;

use Electra\Core\Event\AbstractPayload;

/**
 * Class CreateAddressPayload
 * @method static $this create($data = [])
 */
class CreateAddressPayload extends AbstractPayload
{
  /** @var int */
  public $userId;
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
    return [ 'userId', 'addressLine1' ];
  }

  /** @return string[] */
  public function getPropertyTypes(): array
  {
    return [
      'userId' => 'integer',
      'addressLine1' => 'string',
      'addressLine2' => 'string',
      'town' => 'string',
      'county' => 'string',
      'postCode' => 'string'
    ];
  }
}