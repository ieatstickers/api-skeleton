<?php

namespace Skeleton\Module\User\Event\Address\Update;

use Electra\Core\Event\AbstractResponse;
use Skeleton\Module\User\Data\Address\Address;

class UpdateAddressResponse extends AbstractResponse
{
  /** @var Address */
  public $address;
}