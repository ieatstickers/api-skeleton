<?php

namespace Skeleton\Module\User\Migration;

use Electra\Migrate\Migration;
use Electra\Dal\Database\Mysql\Mysql;
use Illuminate\Database\Schema\Blueprint;

class CreateUserTable extends Migration
{
  /**
   * @return mixed|void
   * @throws \Exception
   */
  public function up()
  {
    Mysql::schema("app")->create("user", function(Blueprint $table)
    {
      $table->increments('id');
      $table->string('firstNames');
      $table->string('lastName');
      $table->string('preferredName')->nullable();
      $table->string('emailAddress');
      $table->date('dateOfBirth')->nullable();
      $table->string('homeContactNumber')->nullable();
      $table->string('mobileContactNumber')->nullable();
      $table->string('password');
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
    Mysql::schema("app")->table("user", function(Blueprint $table)
    {
      $table->dropIfExists();
    });
  }
}