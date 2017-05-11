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
            DBTable::USER, function (Blueprint $table) {
                $table->uuid('id');
                $table->string('username', 255);
                $table->string('email', 255)->collation('ascii_general_ci')->unique('email');
                $table->string('password_hash', 255);
                $table->softDeletes();
                $table->primary('id');
                $table->timestamps();
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
