<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('staff_apoteks', function (Blueprint $table) {
            $table->id();
            $table->string('id_staff', 30)->unique();
            $table->string('nama');
            $table->text('alamat');
            $table->date('tanggal_lahir');
            $table->string('tempat_lahir');
            $table->string('no_hp', 20);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('staff_apoteks');
    }
};
