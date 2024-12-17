<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
       Schema::create('kupons', function (Blueprint $table) {
            $table->id();
            $table->string('kode')->unique();
            $table->enum('tipe',['fixed','persen']);
            $table->decimal('value');
            $table->date('exp_date')->default(DB::raw("(DATE(CURRENT_TIMESTAMP))"));
            $table->timestamps();
       });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kupons');
    }
};
