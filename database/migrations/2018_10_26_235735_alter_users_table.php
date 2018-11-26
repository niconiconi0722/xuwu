<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function($table){
            $table->index('ni_cheng')->change();
            $table->index('email')->change();
            $table->index('authority')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function($table){
            $table->dropIndex('users_ni_cheng_index');
            $table->dropIndex('users_email_index');
            $table->dropIndex('users_authority_index');
        });
    }
}
