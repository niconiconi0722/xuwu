<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->collation = 'utf8mb4_bin';
            $table->increments('id')->unique();
            $table->string('username')->unique();
            $table->string('ni_cheng')->nullable();
            $table->string('email')->nullable();
            $table->string('password', 255);
            $table->string('iconpath')->default('/img/default.png');
            $table->integer('authority')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
