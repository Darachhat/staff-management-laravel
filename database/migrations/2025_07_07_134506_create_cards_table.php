<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('cards', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained()->onDelete('cascade');
            $table->string('card_number')->unique();
            $table->string('card_type')->default('rfid'); // rfid, nfc, barcode
            $table->date('issued_date');
            $table->date('expiry_date')->nullable();
            $table->enum('status', ['active', 'inactive', 'blocked', 'lost'])->default('active');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cards');
    }
};
