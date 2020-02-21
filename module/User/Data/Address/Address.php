<?php

namespace Skeleton\Module\User\Data\Address;

use Carbon\Carbon;
use Electra\Dal\Data\Collection;
use Electra\Utility\Mutators;
use Electra\Utility\Objects;

class Address
{
  /** @var AddressModel */
  private static $model;

  /** @var int */
  public $id;
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
  /** @var Carbon */
  public $created;
  /** @var Carbon */
  public $updated;

  /**
   * @return AddressModel
   * @throws \Exception
   */
  private static function getModel(): AddressModel
  {
    if (!self::$model)
    {
      self::$model = new AddressModel();
    }

    return clone self::$model;
  }

  /**
   * @param \stdClass | array | object $data
   * @return Address
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
        'created' => Mutators::carbonToDateTimeString(),
        'updated' => Mutators::carbonToDateTimeString()
      ]
    );
  }

  /**
   * @param Address $user
   * @return Address|null
   * @throws \Exception
   */
  public static function save(Address $user)
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
        'created' => Mutators::carbonToDateTimeString(),
        'updated' => Mutators::carbonToDateTimeString()
      ],
      [
        'userOrgId'
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
   * @return Address
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
   * @param int $userId
   * @return Address
   * @throws \Exception
   */
  public static function getByUserId(int $userId)
  {
    $model = self::getModel()
      ->query()
      ->where('userId', '=', $userId)
      ->get()
      ->first();

    return self::create($model);
  }

  /**
   * @param int[] $userIds
   * @return Collection
   * @throws \Exception
   */
  public static function getAllByUserIds(array $userIds)
  {
    $models = self::getModel()
      ->query()
      ->whereIn('userId', $userIds)
      ->get()
      ->all();

    $entityCollection = new Collection();

    foreach ($models as $model)
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

}