<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('biaya_kategori', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kategori', 100);
            $table->decimal('biaya_kumite', 8, 2);
            $table->decimal('biaya_kata', 8, 2);
            $table->decimal('biaya_beregu', 8, 2);
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('biaya_kategori');
    }
};
