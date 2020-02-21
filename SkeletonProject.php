<?php

namespace Skeleton;

use Electra\Config\Config;
use Electra\Dal\Database\Mysql\Mysql;
use Electra\Jwt\Context\ElectraJwtContext;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;

class SkeletonProject
{
  /** @throws \Exception */
  public static function init()
  {
    self::setExceptionHandler();
    self::setupConfig();
    self::setDbConnections();
    self::setupJwt();
  }

  public static function setExceptionHandler()
  {
    // Whoops Exception Handler
    $whoops = new Run;
    $whoops->prependHandler(new PrettyPageHandler);
    $whoops->register();
  }

  /** @throws \Exception */
  private static function setupConfig()
  {
    Config::addConfigDir(__DIR__);
    Config::addMergeRule('/^electra\.yaml/');
    Config::generate();
  }

  /** @throws \Exception */
  private static function setDbConnections()
  {
    $dbConfigs = Config::getByPath('electra:dal:connections');
    Mysql::setDbConnections($dbConfigs);
  }

  private static function setupJwt()
  {
    // Set JWT secret
    ElectraJwtContext::setSecret('secret');
  }
}