<?php

use App\Contracts\DBTable;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlertmethodsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            DBTable::ALERT_METHOD, function (Blueprint $table) {
                $table->uuid('id');
                $table->string('name', 255);
                $table->tinyInteger('type')->comment('1=Email, 2=SMS,3=Webhook');
                $table->string('email', 255)->collation('ascii_general_ci');
                $table->string('phone_number', 255);
                $table->string('webhook', 255);
                $table->char('user_id', 36);
                $table->softDeletes();
                $table->primary('id');
                $table->timestamps();
            }
        );
        Schema::table(
            DBTable::ALERT_METHOD, function (Blueprint $table) {
                $table->foreign('user_id', 'fk__users__alert_methods')->references('id')->on(DBTable::USER)->onDelete('cascade');
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
        Schema::dropIfExists(DBTable::ALERT_METHOD);
    }
}
