<?php

namespace Skeleton\Module\User\Event\User\Get;

use Electra\Core\Event\AbstractPayload;
use Electra\Core\Exception\ElectraException;

/**
 * Class GetUserPayload
 * @method static $this create($data = [])
 */
class GetUserPayload extends AbstractPayload
{
  /** @var int */
  public $id;
  /** @var int */
  public $emailAddress;

  /** @return array */
  public function getPropertyTypes(): array
  {
    return [
      'id' => 'integer',
      'emailAddress' => 'string'
    ];
  }

  /**
   * @return bool
   * @throws ElectraException
   */
  public function validate(): bool
  {
    if (!$this->id && !$this->emailAddress)
    {
      throw new ElectraException('GetUserPayload: Cannot get user without an id or emailAddress.');
    }

    return true;
  }
}