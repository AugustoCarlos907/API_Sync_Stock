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
        Schema::create('stock_files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id');
            $table->string('file_name');
            $table->string('file_path');
            $table->enum('status', ['received', 'processing' , 'extracted' , 'failed']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_files');
    }
};
