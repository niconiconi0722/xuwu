<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRepliesTable extends Migration
{
	public function up()
	{
		Schema::create('replies', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->collation = 'utf8mb4_bin';

            $table->increments('id');
            $table->integer('article_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->text('content');
            $table->timestamps();

            $table->foreign('user_id')
            ->references('id')->on('users')
            ->onDelete('cascade');

            $table->foreign('article_id')
            ->references('id')->on('articles')
            ->onDelete('cascade');
        });
	}

	public function down()
	{
		Schema::drop('replies');
	}
}
