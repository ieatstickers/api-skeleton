<?php

namespace Skeleton\Module\Auth\Data\Token;

use Carbon\Carbon;
use Electra\Utility\Mutators;
use Electra\Utility\Objects;

class Token
{
  /** @var TokenModel */
  private static $model;

  /** @var int */
  public $id;
  /** @var string */
  public $token;
  /** @var int */
  public $userId;
  /** @var Carbon */
  public $expiry;
  /** @var Carbon */
  public $created;
  /** @var Carbon */
  public $updated;

  /**
   * @return TokenModel
   * @throws \Exception
   */
  private static function getModel(): TokenModel
  {
    if (!self::$model)
    {
      self::$model = new TokenModel();
    }

    return clone self::$model;
  }

  /**
   * @param \stdClass | array | object $data
   * @return Token
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
        'expiry' => Mutators::dateTimeStringToCarbon()
      ]
    );
  }

  /**
   * @param Token $token
   * @return Token
   * @throws \Exception
   */
  public static function save(Token $token)
  {
    if (!$token->id)
    {
      $token->created = new Carbon();
    }

    $token->updated = new Carbon();

    $model = Objects::copyAllProperties(
      $token,
      self::getModel(),
      [
        'expiry' => Mutators::carbonToDateTimeString()
      ]
    );

    $model->save();

    if (!$token->id)
    {
      $token->id = $model->id;
    }

    return $token;
  }

  /**
   * @param int $id
   * @return Token
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
   * @param string $token
   * @param int $userId
   * @return Token
   * @throws \Exception
   */
  public static function getByTokenAndUserId(
    string $token,
    int $userId
  )
  {
    $model = self::getModel()
      ->query()
      ->where('token', '=', $token)
      ->where('userId', '=', $userId)
      ->get()
      ->first();

    return self::create($model);
  }

}