<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('brg_masuk', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no_brg_masuk');
            $table->integer('id_barang');
            $table->integer('id_user');
            $table->integer('jml_brg_masuk')->nullable();
            $table->date('tgl_brg_masuk')->nullable();
            $table->bigInteger('total')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('brg_masuk');
    }
};
