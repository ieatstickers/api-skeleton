<?php

namespace Skeleton\Module\User\Event\Address\Create;

use Electra\Core\Event\AbstractResponse;
use Skeleton\Module\User\Data\Address\Address;

/**
 * Class CreateAddressResponse
 * @method static $this create($data = [])
 */
class CreateAddressResponse extends AbstractResponse
{
  /** @var Address */
  public $address;
}