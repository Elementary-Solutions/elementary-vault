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
        Schema::create('file_mime_types', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->unsignedTinyInteger('type_id');
            $table->string('mime', 80)->unique();
            $table->string('extension', 20)->unique();
            $table->string('description', 120)->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->foreign('type_id')->references('id')->on('file_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('file_mime_types');
    }
};
