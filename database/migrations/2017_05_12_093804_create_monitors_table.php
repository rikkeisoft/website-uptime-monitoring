<?php

use App\Contracts\DBTable;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMonitorsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(DBTable::MONITOR, function (Blueprint $table) {
            $table->uuid('id');
            $table->string('result', 255);
            $table->char('website_id', 36);
            $table->char('alert_group_id', 36);
            $table->char('user_id', 36);
            $table->primary('id');
            $table->timestamps();
        });
        Schema::table(DBTable::MONITOR, function (Blueprint $table) {
            $table->foreign('website_id', 'fk__websites__monitors')->references('id')->on(DBTable::WEBSITE)->onDelete('cascade');
            $table->foreign('alert_group_id', 'fk__alert_groups__monitors')->references('id')->on(DBTable::ALERT_GROUP)->onDelete('cascade');
            $table->foreign('user_id', 'fk__users__monitors')->references('id')->on(DBTable::USER)->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(DBTable::MONITOR);
    }
}
