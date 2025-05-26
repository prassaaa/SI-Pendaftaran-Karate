<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('peserta', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('kode_pendaftaran', 15)->unique();
            $table->string('nama_lengkap', 255);
            $table->string('tempat_lahir', 100);
            $table->date('tanggal_lahir');
            $table->text('alamat');
            $table->string('no_telepon', 20);
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->foreignId('ranting_id')->constrained('ranting');
            $table->enum('golongan_darah', ['A', 'B', 'AB', 'O']);
            $table->foreignId('kategori_usia_id')->constrained('kategori_usia');
            $table->decimal('berat_badan', 5, 2);
            $table->boolean('kumite_perorangan')->default(false);
            $table->boolean('kata_perorangan')->default(false);
            $table->boolean('kata_beregu')->default(false);
            $table->boolean('kumite_beregu')->default(false);
            $table->string('foto_path', 255)->nullable();
            $table->decimal('total_biaya', 10, 2);
            $table->enum('status_pendaftaran', ['pending', 'approved', 'rejected'])->default('pending');
            $table->enum('status_bayar', ['unpaid', 'pending', 'paid'])->default('unpaid');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('peserta');
    }
};
