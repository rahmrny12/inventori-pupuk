<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('farmers', function (Blueprint $table) {
            $table->id();
            $table->string('national_id', 16)->unique();
            $table->string('farmer_name', 100);
            $table->text('address');
            $table->string('phone_number', 20)->nullable();
            $table->date('birth_date')->nullable();
            $table->char('gender', 1);
            $table->decimal('land_area', 8, 2)->nullable();
            $table->foreignId('village_id')->nullable()
                  ->constrained('villages')->onDelete('set null');
            $table->string('status', 20)->default('active');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('farmers');
    }
};
