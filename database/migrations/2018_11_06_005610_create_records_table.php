<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('records', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->collation = 'utf8mb4_bin';

            $table->increments('id');
            $table->string('action');
            $table->integer('action_user_id')->unsigned();
            $table->integer('author_user_id')->unsigned();
            $table->text('content');
            $table->timestamps();

            $table->foreign('action_user_id')
            ->references('id')->on('users')
            ->onDelete('cascade');

            $table->foreign('author_user_id')
            ->references('id')->on('users')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('records');
    }
}
