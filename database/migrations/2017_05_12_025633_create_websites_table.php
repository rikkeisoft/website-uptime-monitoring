<?php

use App\Contracts\DBTable;
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
        Schema::create(DBTable::WEBSITE, function (Blueprint $table) {
            $table->uuid('id');
            $table->string('url', 255);
            $table->string('name', 100);
            $table->tinyInteger('sensitivity')->comment('1=Low, 2=Medium,3=High');
            $table->tinyInteger('status')->comment('1=disable, 2=enable');
            $table->integer('frequency');
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
        Schema::dropIfExists(DBTable::WEBSITE);
    }
}
