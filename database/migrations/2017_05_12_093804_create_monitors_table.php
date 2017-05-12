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
            $table->string('result', 45);
            $table->char('website_id', 36);
            $table->char('alert_group_id', 36);
            $table->timestamps();
            $table->softDeletes();
            $table->primary('id');
        });
        Schema::table(DBTable::MONITOR, function (Blueprint $table) {
            $table->foreign('website_id', 'fk__dtb_websites_dtb_monitors')->references('id')->on(DBTable::WEBSITE)->onDelete('cascade');
            $table->foreign('alert_group_id','fk__dtb_alert_groups_dtb_monitors')->references('id')->on(DBTable::ALERTGROUP)->onDelete('cascade');
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
