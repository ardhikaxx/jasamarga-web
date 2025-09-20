<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sfo_activities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained()->onDelete('cascade');
            $table->date('tanggal_sfo');
            $table->integer('sta_awal');
            $table->integer('sta_akhir');
            $table->foreignId('location_id')->constrained()->onDelete('cascade');
            $table->decimal('panjang', 10, 2);
            $table->decimal('lebar', 10, 2);
            $table->decimal('tebal', 10, 2);
            $table->decimal('luas', 10, 2);
            $table->foreignId('work_type_id')->constrained()->onDelete('cascade');
            $table->enum('status', ['Unprocessed', 'Process', 'Done'])->default('Unprocessed');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sfo_activities');
    }
};