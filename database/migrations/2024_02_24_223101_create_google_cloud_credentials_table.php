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
        Schema::create('google_cloud_credentials', function (Blueprint $table) {
            $table->id();
            $table->string('project_id');
            $table->string('private_key_id');
            $table->string('private_key');
            $table->string('client_email');
            $table->string('client_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('google_cloud_credentials');
    }
};
