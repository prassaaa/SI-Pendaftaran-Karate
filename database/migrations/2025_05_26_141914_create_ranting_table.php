<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('ranting', function (Blueprint $table) {
            $table->id();
            $table->string('nama_ranting', 150);
            $table->string('kota', 100);
            $table->string('provinsi', 100);
            $table->text('alamat');
            $table->string('kontak', 20);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ranting');
    }
};
