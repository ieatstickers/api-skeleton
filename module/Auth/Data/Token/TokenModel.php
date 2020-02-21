<?php

namespace Skeleton\Module\Auth\Data\Token;

use Electra\Dal\Database\Mysql\Model;

class TokenModel extends Model
{
  protected $connection = 'auth';
  protected $table = 'token';
}