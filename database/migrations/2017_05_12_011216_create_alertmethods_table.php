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
        Schema::create(DBTable::ALERT_METHOD, function (Blueprint $table) {
            $table->uuid('id');
            $table->string('name', 100);
            $table->tinyInteger('type')->comment('1=Email, 2=SMS,3=Webhook');
            $table->string('email', 200)->collation('ascii_general_ci')->unique('email');
            $table->string('phone_number', 20);
            $table->string('webhook', 200);
            $table->timestamps();
            $table->softDeletes();
            $table->primary('id');
        });
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
