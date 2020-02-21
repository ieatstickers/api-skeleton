<?php

namespace Skeleton\Module\User\Event\Address\Get;

use Electra\Core\Event\AbstractResponse;
use Skeleton\Module\User\Data\Address\Address;

/**
 * Class GetAddressResponse
 * @method static $this create($data = [])
 */
class GetAddressResponse extends AbstractResponse
{
  /** @var Address */
  public $address;
}