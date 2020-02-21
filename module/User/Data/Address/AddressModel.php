<?php

namespace Skeleton\Module\User\Data\Address;

use Electra\Dal\Database\Mysql\Model;

class AddressModel extends Model
{
  protected $connection = 'app';
  protected $table = 'user_address';
}