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
        Schema::create('activities', function (Blueprint $table) {
            $table->id()->startingValue(10000);
            $table->string('activity',50);
            $table->mediumText('description');
            $table->enum('state', ['TODO', 'WORKING', 'REVIEW', 'DONE']);
            $table->string('color', 20);
            $table->unsignedBigInteger('board_id');
            $table->timestamps();

            $table->foreign('board_id')
                ->onDelete('cascade')
                ->onUpdate('cascade')
                ->references('id')
                ->on('boards');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activities');
    }
};
