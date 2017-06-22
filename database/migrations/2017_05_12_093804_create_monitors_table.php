<?php

use App\Contracts\DatabaseTables;
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
        Schema::create(DatabaseTables::MONITORS, function (Blueprint $table) {
            $table->uuid('id');
            $table->tinyInteger('result')->comment('1: Success, 2: Failed');
            ;
            $table->char('website_id', 36);
            $table->char('alert_group_id', 36);
            $table->timestamps();
            $table->primary('id');
        });

        Schema::table(DatabaseTables::MONITORS, function (Blueprint $table) {
            $table->foreign('website_id', 'fk__websites__monitors')
                ->references('id')
                ->on(DatabaseTables::WEBSITES)
                ->onDelete('cascade');
            $table->foreign('alert_group_id', 'fk__alert_groups__monitors')
                ->references('id')
                ->on(DatabaseTables::ALERT_GROUPS)
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
        Schema::dropIfExists(DatabaseTables::MONITORS);
    }
}
