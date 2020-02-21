<?php

namespace Skeleton\Module\User\Event\User\Create;

use Carbon\Carbon;
use Electra\Core\Event\AbstractPayload;
use Electra\Utility\Objects;

/**
 * Class CreateUserPayload
 * @method static $this create($data = [])
 */
class CreateUserPayload extends AbstractPayload
{
  /** @var string */
  public $firstNames;
  /** @var string */
  public $lastName;
  /** @var string */
  public $preferredName;
  /** @var string */
  public $emailAddress;
  /** @var Carbon | string */
  public $dateOfBirth;
  /** @var string */
  public $homeContactNumber;
  /** @var string */
  public $mobileContactNumber;
  /** @var string */
  public $password;
  /** @var array */
  public $address;

  /** @return string[] */
  public function getRequiredProperties(): array
  {
    return [ 'firstNames', 'lastName', 'emailAddress', 'password' ];
  }

  /**
   * @return array
   */
  public function getPropertyTypes(): array
  {
    $carbonClass = Carbon::class;
    return [
      'firstNames' => 'string',
      'lastName' => 'string',
      'preferredName' => 'string',
      'emailAddress' => 'string',
      'dateOfBirth' => "$carbonClass|string",
      'homeContactNumber' => 'string',
      'mobileContactNumber' => 'string',
      'password' => 'string',
      'address' => 'array'
    ];
  }

  /**
   * @return bool
   * @throws \Exception
   */
  public function validate(): bool
  {
    parent::validate();

    if ($this->address)
    {
      $requiredAddressProperties = [
        'addressLine1'
      ];

      $addressPropertyTypes = [
        'addressLine1' => 'string',
        'addressLine2' => 'string',
        'town' => 'string',
        'county' => 'string',
        'postCode' => 'string'
      ];

      Objects::validatePropertiesExist((object)$this->address, $requiredAddressProperties);
      Objects::validatePropertyTypes((object)$this->address, $addressPropertyTypes);
    }

    return true;
  }
}