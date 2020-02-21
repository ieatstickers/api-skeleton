<?php

namespace Skeleton\Module\Auth\Event\Authenticate;

use Electra\Core\Event\AbstractPayload;
use Electra\Utility\Objects;

class AuthenticatePayload extends AbstractPayload
{
  /** @var string */
  public $emailAddress;
  /** @var string */
  public $password;

  /** @return string[] */
  public function getRequiredProperties(): array
  {
    return ['emailAddress', 'password'];
  }

  /** @return array */
  public function getPropertyTypes(): array
  {
    return [
      'emailAddress' => 'string',
      'password' => 'string'
    ];
  }

  /**
   * @param array $data
   * @return AuthenticatePayload
   * @throws \Exception
   */
  public static function create($data = []): AuthenticatePayload
  {
    return Objects::hydrate(new self(), (object)$data);
  }
}