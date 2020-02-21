<?php

namespace Skeleton\Module\User\Event\User\Update;

use Carbon\Carbon;
use Electra\Core\Event\AbstractPayload;

/**
 * Class UpdateUserPayload
 * @method static $this create($data = [])
 */
class UpdateUserPayload extends AbstractPayload
{
  /** @var int */
  public $id;
  /** @var string */
  public $emailAddress;
  /** @var string */
  public $firstNames;
  /** @var string */
  public $preferredName;
  /** @var string */
  public $lastName;
  /** @var string */
  public $password;
  /** @var Carbon | string */
  public $dateOfBirth;
  /** @var string */
  public $homeContactNumber;
  /** @var string */
  public $mobileContactNumber;

  /** @return string[] */
  public function getRequiredProperties(): array
  {
    return [ 'id' ];
  }

  /** @return array */
  public function getPropertyTypes(): array
  {
    $carbonClass = Carbon::class;

    return [
      'id' => 'integer',
      'emailAddress' => 'string',
      'firstNames' => 'string',
      'preferredName' => 'string',
      'lastName' => 'string',
      'password' => 'string',
      'dateOfBirth' => "$carbonClass|string",
      'homeContactNumber' => 'string',
      'mobileContactNumber' => 'string'
    ];
  }
}