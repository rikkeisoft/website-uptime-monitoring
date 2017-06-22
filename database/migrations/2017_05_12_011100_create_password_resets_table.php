<?php

use App\Contracts\DatabaseTables;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePasswordResetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists(DatabaseTables::PASSWORD_RESETS);
        Schema::create(
            DatabaseTables::PASSWORD_RESETS,
            function (Blueprint $table) {
                $table->string('email', 100)->index();
                $table->string('token', 100)->index();
                $table->timestamp('created_at')->nullable();
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
        Schema::dropIfExists(DatabaseTables::PASSWORD_RESETS);
    }
}
