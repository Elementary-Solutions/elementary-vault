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
        Schema::create('providers', function (Blueprint $table) {
            $table->tinyIncrements('id');
            $table->string('name');
            $table->string('key', 10)->unique();
            $table->string('description', 150)->nullable();
            $table->unsignedTinyInteger('adapter_id');
            $table->string('access_key', 40)->unique();
            $table->boolean('enabled')->default(true);
            $table->timestamps();

            $table->foreign('adapter_id')->references('id')->on('provider_adapters')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('providers');
    }
};
