<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('fertilizer_stocks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cooperative_id')->constrained('cooperatives')->onDelete('cascade');
            $table->foreignId('fertilizer_type_id')->constrained('fertilizer_types')->onDelete('cascade');
            $table->unsignedInteger('initial_stock')->default(0);
            $table->unsignedInteger('stock_in')->default(0);
            $table->unsignedInteger('stock_out')->default(0);
            $table->unsignedInteger('final_stock')->default(0);
            $table->date('update_date');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('fertilizer_stocks');
    }
};
