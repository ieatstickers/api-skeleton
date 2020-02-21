<?php

namespace Skeleton\Module\Auth\Migration;

use Electra\Dal\Database\Mysql\Mysql;
use Electra\Migrate\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTokenTable extends Migration
{
  /**
   * @return mixed|void
   * @throws \Exception
   */
  public function up()
  {
    Mysql::schema("auth")->create("token", function(Blueprint $table)
    {
      $table->increments('id');
      $table->text('token');
      $table->integer('userId')->index();
      $table->dateTime('expiry')->nullable();
      $table->dateTime('created');
      $table->dateTime('updated');
    });
  }

  /**
   * @return mixed|void
   * @throws \Exception
   */
  public function down()
  {
    Mysql::schema("auth")->table("token", function(Blueprint $table)
    {
      $table->dropIfExists();
    });
  }
}