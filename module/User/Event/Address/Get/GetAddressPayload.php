<?php

namespace Skeleton\Module\User\Event\Address\Get;

use Electra\Core\Event\AbstractPayload;

/**
 * Class GetAddressPayload
 * @method static $this create($data = [])
 */
class GetAddressPayload extends AbstractPayload
{
  /** @var int */
  public $userId;

  /** @return string[] */
  public function getRequiredProperties(): array
  {
    return [ 'userId' ];
  }

  /** @return array */
  public function getPropertyTypes(): array
  {
    return [ 'userId' => 'integer' ];
  }
}