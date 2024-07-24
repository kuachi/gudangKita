<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('konversi_plu', function (Blueprint $table) {
            $table->id();
            $table->string('plu_asal', 10);
            $table->string('plu_akhir', 10);
            $table->integer('qty')->default(1);
            $table->string('unit');
            $table->integer('qty_hasil')->default(1);
            $table->string('unit_hasil');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('konversi_plu');
    }
};
