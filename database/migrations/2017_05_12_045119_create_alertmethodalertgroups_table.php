<?php

use App\Contracts\DBTable;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlertmethodalertgroupsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(DBTable::ALERT_METHOD_ALERT_GROUP, function (Blueprint $table) {
            $table->uuid('id');
            $table->char('alert_method_id', 36);
            $table->char('alert_group_id', 36);
            $table->timestamps();
            $table->softDeletes();
            $table->primary('id');
            $table->foreign('alert_method_id','fk__dtb_alert_methods_dtb_alert_method_alert_groups')->references('id')->on(DBTable::ALERT_METHOD)->onDelete('cascade');
            $table->foreign('alert_group_id','fk__dtb_alert_groups_dtb_alert_method_alert_groups')->references('id')->on(DBTable::ALERT_GROUP)->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(DBTable::ALERT_METHOD_ALERT_GROUP);
    }
}
