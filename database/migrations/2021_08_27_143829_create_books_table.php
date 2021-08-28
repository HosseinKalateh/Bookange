<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
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

            // Category FK
            $table->unsignedBigInteger("category_id")->index();

            // Publisher FK
            $table->unsignedBigInteger("publisher_id")->index();

            $table->string('name');
            $table->string('picture');
            $table->longText('description');
            $table->float("price", 20, 2)->nullable()->default(0);

            // Details
            $table->string('ISBN');
            $table->integer('number_of_pages')->default(0);
            $table->string("published_at")->nullable();

            $table->timestamps();
        });

        // Create author_book Pivot Table
        Schema::create('author_book', function(Blueprint $table) {
            $table->unsignedBigInteger("author_id");
            $table->unsignedBigInteger("book_id");

            // Table Primary Key
            $table->primary(['author_id', 'book_id']);
        });

        // Create book_translator Pivot Table
        Schema::create('book_translator', function(Blueprint $table) {
            $table->unsignedBigInteger("book_id");
            $table->unsignedBigInteger("translator_id");

            // Table Primary Key 
            $table->primary(['book_id', 'translator_id']);
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
        Schema::dropIfExists('author_book');
        Schema::dropIfExists('book_translator');
    }
}
