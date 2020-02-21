<?php

namespace Skeleton\Module\User\Event\User\Update;

use Carbon\Carbon;
use Electra\Core\Event\AbstractEvent;
use Electra\Core\Exception\ElectraException;
use Electra\Utility\Passwords;
use Skeleton\Module\User\Data\User\User;

class UpdateUserEvent extends AbstractEvent
{
  /** @return string */
  public function getPayloadClass(): string
  {
    return UpdateUserPayload::class;
  }

  /**
   * @param UpdateUserPayload $payload
   * @return UpdateUserResponse
   * @throws \Exception
   */
  protected function process($payload): UpdateUserResponse
  {
    $user = User::getById($payload->id);

    if (!$user)
    {
      throw (
        new ElectraException(
        'Cannot update a user that does not exist',
        'User not found'
        )
      )
        ->addMetaData('id', $payload->id);
    }

    $updated = false;

    // firstNames
    if (
      $payload->firstNames
      && $payload->firstNames !== $user->firstNames
    )
    {
      $user->firstNames = $payload->firstNames;
      $updated = true;
    }

    // preferredName
    if (
      $payload->preferredName
      && $payload->preferredName !== $user->preferredName
    )
    {
      $user->preferredName = $payload->preferredName;
      $updated = true;
    }

    // lastName
    if (
      $payload->lastName
      && $payload->lastName !== $user->lastName
    )
    {
      $user->lastName = $payload->lastName;
      $updated = true;
    }

    // emailAddress
    if (
      $payload->emailAddress
      && $payload->emailAddress !== $user->emailAddress
    )
    {
      $user->emailAddress = $payload->emailAddress;
      $updated = true;
    }

    // password
    if (
      $payload->password
      && $payload->password !== $user->password
    )
    {
      $user->password = Passwords::hashPassword($payload->password);
      $updated = true;
    }

    // dateOfBirth

    $dateOfBirth = null;

    if (
      $payload->dateOfBirth
      && $payload->dateOfBirth instanceof Carbon
    )
    {
      $dateOfBirth = $payload->dateOfBirth;
    }
    elseif (is_string($payload->dateOfBirth))
    {
      $dateOfBirth = new Carbon($payload->dateOfBirth);
    }

    if (
      $dateOfBirth
      && !$dateOfBirth->is($user->dateOfBirth)
    )
    {
      $user->dateOfBirth = $dateOfBirth;
      $updated = true;
    }

    // homeContactNumber
    if (
      $payload->homeContactNumber
      && $payload->homeContactNumber !== $user->homeContactNumber
    )
    {
      $user->homeContactNumber = $payload->homeContactNumber;
      $updated = true;
    }

    // mobileContactNumber
    if (
      $payload->mobileContactNumber
      && $payload->mobileContactNumber !== $user->mobileContactNumber
    )
    {
      $user->mobileContactNumber = $payload->mobileContactNumber;
      $updated = true;
    }

    if ($updated)
    {
      User::save($user);
    }

    $response = UpdateUserResponse::create();
    $response->user = $user;

    return $response;
  }
}