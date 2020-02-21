<?php

namespace Skeleton\Module\User\Data\User;

use Carbon\Carbon;
use Electra\Dal\Data\Collection;
use Electra\Utility\Mutators;
use Electra\Utility\Objects;
use Skeleton\Module\User\Data\Address\Address;

class User implements \JsonSerializable
{
  /** @var UserModel */
  private static $model;

  /** @var int */
  public $id;
  /** @var string */
  public $firstNames;
  /** @var string */
  public $lastName;
  /** @var string */
  public $preferredName;
  /** @var string */
  public $emailAddress;
  /** @var Carbon */
  public $dateOfBirth;
  /** @var string */
  public $homeContactNumber;
  /** @var string */
  public $mobileContactNumber;
  /** @var string */
  public $password;
  /** @var Carbon */
  public $created;
  /** @var Carbon */
  public $updated;

  /** @var Address */
  public $address;

  /**
   * @return UserModel
   * @throws \Exception
   */
  private static function getModel(): UserModel
  {
    if (!self::$model)
    {
      self::$model = new UserModel();
    }

    return clone self::$model;
  }

  /**
   * @param \stdClass | array | object $data
   * @return User
   * @throws \Exception
   */
  public static function create($data = []): ?self
  {
    if (is_null($data))
    {
      return null;
    }

    return Objects::hydrate(
      new self(),
      (object)$data,
      [
        'dateOfBirth' => Mutators::dateStringToCarbon(),
        'created' => Mutators::dateTimeStringToCarbon(),
        'updated' => Mutators::dateTimeStringToCarbon()
      ]
    );
  }

  /**
   * @param User $user
   * @return User|null
   * @throws \Exception
   */
  public static function save(User $user)
  {
    if (!$user->id)
    {
      $user->created = new Carbon();
    }

    $user->updated = new Carbon();

    $model = Objects::copyAllProperties(
      $user,
      self::getModel(),
      [
        'dateOfBirth' => Mutators::carbonToDateString(),
        'created' => Mutators::carbonToDateTimeString(),
        'updated' => Mutators::carbonToDateTimeString()
      ],
      [
        'address'
      ]
    );

    $model->save();

    if (!$user->id)
    {
      $user->id = $model->id;
    }

    return $user;
  }

  /**
   * @param int $id
   * @return User
   * @throws \Exception
   */
  public static function getById(int $id)
  {
    $model = self::getModel()
      ->query()
      ->where('id', '=', $id)
      ->get()
      ->first();

    return self::create($model);
  }

  /**
   * @param string $emailAddress
   * @return User
   * @throws \Exception
   */
  public static function getByEmailAddress(string $emailAddress)
  {
    $model = self::getModel()
      ->query()
      ->where('emailAddress', '=', $emailAddress)
      ->get()
      ->first();

    return self::create($model);
  }

  /**
   * @param int[] $ids
   * @return Collection
   * @throws \Exception
   */
  public static function getAllByIds(array $ids)
  {
    $modelCollection = self::getModel()
      ->query()
      ->whereIn('id', $ids)
      ->get();

    $entityCollection = new Collection();

    foreach ($modelCollection->all() as $model)
    {
      $entityCollection->add(self::create($model));
    }

    return $entityCollection;
  }

  /**
   * @return Collection
   * @throws \Exception
   */
  public static function getAll()
  {
    $modelCollection = self::getModel()->all();

    $entityCollection = new Collection();

    foreach ($modelCollection->all() as $model)
    {
      $entityCollection->add(self::create($model));
    }

    return $entityCollection;
  }

  /**
   * @return mixed|object
   */
  public function jsonSerialize()
  {
    return Objects::copyAllProperties(
      $this,
      new \stdClass(),
      [
        'dateOfBirth' => Mutators::carbonToDateString()
      ],
      [
        'password'
      ]
    );
  }

}