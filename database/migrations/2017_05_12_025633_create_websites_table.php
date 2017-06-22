<?php

use App\Contracts\DatabaseTables;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWebsitesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            DatabaseTables::WEBSITES,
            function (Blueprint $table) {
                $table->uuid('id');
                $table->char('user_id', 36);
                $table->string('url', 255);
                $table->string('name', 255);
                $table->tinyInteger('sensitivity')->comment('1: Low, 2: Medium, 3: High');
                $table->tinyInteger('status')->comment('1: Enable, 2: Disabled');
                $table->integer('frequency');
                $table->softDeletes();
                $table->timestamps();
                $table->primary('id');
            }
        );

        Schema::table(
            DatabaseTables::WEBSITES,
            function (Blueprint $table) {
                $table->foreign('user_id', 'fk__users__websites')->references('id')
                    ->on(DatabaseTables::USERS)->onDelete('cascade');
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
        Schema::dropIfExists(DatabaseTables::WEBSITES);
    }
}
