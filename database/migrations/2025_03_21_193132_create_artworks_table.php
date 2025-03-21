<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   // database/migrations/xxxx_xx_xx_create_artworks_table.php
public function up()
{
    Schema::create('artworks', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->string('artist');
        $table->integer('year');
        $table->date('acquisition_date');
        $table->decimal('estimated_price', 10, 2);
        $table->text('description');
        $table->string('photo')->nullable();
        $table->foreignId('category_id')->constrained()->onDelete('cascade');
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artworks');
    }
};
