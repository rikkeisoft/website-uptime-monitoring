<?php

use App\Contracts\DatabaseTables;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateAlertMethodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(DatabaseTables::ALERT_METHODS, function (Blueprint $table) {
            $table->string('email', 255)->nullable()->change();
            $table->string('phone_number', 255)->nullable()->change();
            $table->string('webhook', 255)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(DatabaseTables::ALERT_METHODS, function (Blueprint $table) {
            $table->string('email', 255)->change();
            $table->string('phone_number', 255)->change();
            $table->string('webhook', 255)->change();
        });
    }
}
