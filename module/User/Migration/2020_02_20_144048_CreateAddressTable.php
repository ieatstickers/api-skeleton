<?php

namespace Skeleton\Module\User\Migration;

use Electra\Migrate\Migration;
use Electra\Dal\Database\Mysql\Mysql;
use Illuminate\Database\Schema\Blueprint;

class CreateAddressTable extends Migration
{
  /**
   * @return mixed|void
   * @throws \Exception
   */
  public function up()
  {
    Mysql::schema("app")->create("user_address", function(Blueprint $table)
    {
      $table->increments('id');
      $table->integer('userId')->index();
      $table->string('addressLine1');
      $table->string('addressLine2')->nullable();
      $table->string('town')->nullable();
      $table->string('county')->nullable();
      $table->string('postCode')->nullable();
      $table->datetime('created');
      $table->datetime('updated');
    });
  }

  /**
   * @return mixed|void
   * @throws \Exception
   */
  public function down()
  {
    Mysql::schema("app")->table("user_address", function(Blueprint $table)
    {
      $table->dropIfExists();
    });
  }
}