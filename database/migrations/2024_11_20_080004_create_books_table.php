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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('book_name', 255);
            $table->year('publish_year');
            $table->integer('total_pages');
            $table->double('price');
            $table->integer('stock');
            $table->string('address');
            $table->tinyInteger('book_type');
            $table->string('book_code', 255);
            $table->foreignId('category_id')->nullable()->constrained('book_categories')->onDelete('cascade');
            $table->foreignId('publisher_id')->nullable()->constrained('publishers')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
};
