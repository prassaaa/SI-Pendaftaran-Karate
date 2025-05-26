<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('peserta_id')->constrained('peserta')->onDelete('cascade');
            $table->string('kode_pembayaran', 20)->unique();
            $table->decimal('jumlah_bayar', 10, 2);
            $table->enum('metode_pembayaran', ['transfer', 'cash', 'qris']);
            $table->enum('status_bayar', ['pending', 'paid', 'expired', 'failed'])->default('pending');
            $table->string('bukti_bayar_path', 255)->nullable();
            $table->datetime('tanggal_bayar')->nullable();
            $table->datetime('tanggal_expired')->nullable();
            $table->text('keterangan')->nullable();
            $table->foreignId('verified_by')->nullable()->constrained('users');
            $table->datetime('verified_at')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pembayaran');
    }
};
