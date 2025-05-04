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
        Schema::create('provider_adapters', function (Blueprint $table) {
            $table->tinyIncrements('id');
            $table->unsignedTinyInteger('partner_id');
            $table->string('name', 50);
            $table->boolean('enabled')->default(false);
            $table->timestamps();

            $table->foreign('partner_id')->references('id')->on('provider_partners')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('provider_adapters');
    }
};
