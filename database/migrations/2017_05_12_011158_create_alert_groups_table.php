<?php

use App\Contracts\DBTable;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlertGroupsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            DBTable::ALERT_GROUP, function (Blueprint $table) {
                $table->uuid('id');
                $table->char('user_id', 36);
                $table->string('name', 255);
                $table->softDeletes();
                $table->timestamps();
                $table->primary('id');
            }
        );

        Schema::table(
            DBTable::ALERT_GROUP, function (Blueprint $table) {
                $table->foreign('user_id', 'fk__users__alert_groups')->references('id')->on(DBTable::USER)->onDelete('cascade');
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
        Schema::dropIfExists(DBTable::ALERT_GROUP);
    }
}
