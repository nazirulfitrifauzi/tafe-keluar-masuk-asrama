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
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('chapter_id')->nullable(); // Make nullable initially
            $table->unsignedBigInteger('title_id')->nullable(); // Make nullable initially
            $table->string('link')->nullable(); // For video links
            $table->string('doc_path')->nullable(); // For document files
            $table->timestamps();

            // Add foreign key constraints after creating the related tables
            $table->foreign('chapter_id')
                  ->references('id')
                  ->on('chapters')
                  ->onDelete('cascade');
                  
            $table->foreign('title_id')
                  ->references('id')
                  ->on('titles')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notes');
    }
}; 