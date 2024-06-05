<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shop_area_id')->constrained()->cascadeOnDelete();
            $table->foreignId('shop_genre_id')->constrained()->cascadeOnDelete();
            $table->foreignId('manager_id')->constrained()->cascadeOnDelete();
            $table->string('shop_name', 50);
            $table->string('image_path');
            $table->text('shop_description', 400);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shops');
    }
};
