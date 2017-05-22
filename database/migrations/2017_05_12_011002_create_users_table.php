<?php

use App\Contracts\DBTable;
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
        Schema::create(
            DBTable::USER,
            function (Blueprint $table) {
                $table->uuid('id');
                $table->string('username', 255);
                $table->string('email', 255);
                $table->string('password', 255);
                $table->string('access_token', 255)->nullable();
                $table->integer('status');
                $table->string('remember_token', 100)->nullable();
                $table->softDeletes();
                $table->timestamps();
                $table->primary('id');
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(DBTable::USER);
    }
}
