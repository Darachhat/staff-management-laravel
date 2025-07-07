<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Employee Skills pivot table
        Schema::create('employee_skill', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained()->onDelete('cascade');
            $table->foreignId('skill_id')->constrained()->onDelete('cascade');
            $table->enum('proficiency_level', ['beginner', 'intermediate', 'advanced', 'expert'])->default('beginner');
            $table->date('acquired_date')->nullable();
            $table->timestamps();

            $table->unique(['employee_id', 'skill_id']);
        });

        // Employee Services pivot table
        Schema::create('employee_service', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained()->onDelete('cascade');
            $table->foreignId('service_id')->constrained()->onDelete('cascade');
            $table->decimal('custom_rate', 8, 2)->nullable();
            $table->date('assigned_date')->nullable();
            $table->timestamps();

            $table->unique(['employee_id', 'service_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('employee_service');
        Schema::dropIfExists('employee_skill');
    }
};
