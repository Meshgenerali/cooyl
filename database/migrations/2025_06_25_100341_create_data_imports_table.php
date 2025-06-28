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
        Schema::create('data_imports', function (Blueprint $table) {
            $table->id();
            $table->string('county_code', 10)->nullable(false); // e.g., '001'
            $table->string('county_name', 100)->nullable(false); // e.g., 'MOMBASA'
            $table->string('constituency_code', 10)->nullable(false); // e.g., '001'
            $table->string('constituency_name', 100)->nullable(false); // e.g., 'CHANGAMWE'
            $table->string('ward_code', 10)->nullable(false); // e.g., '001'
            $table->string('ward_name', 100)->nullable(false); // e.g., 'PORT REITZ'
            $table->string('centre_code', 10)->nullable(false); // e.g., '001'
            $table->string('centre_name', 100)->nullable(false); // e.g., 'BOMU PRIMARY SCHOOL'
            $table->string('polling_station_code', 20)->unique()->nullable(false); // e.g., '001001001001'
            $table->string('polling_station_name', 100)->nullable(false); // e.g., 'BOMU PRIMARY SCHOOL'
            $table->integer('registered_voters')->nullable(false); // e.g., 673
            $table->index(['county_code', 'constituency_code']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_imports');
    }
};
