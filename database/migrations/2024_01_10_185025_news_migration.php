<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('news_articles', function (Blueprint $table) {
        $table->bigIncrements('id');
       
        $table->unsignedInteger('source_id')->nullable();
            $table->string('author');
            $table->string('title');
            $table->longText('description');
            $table->string('url');
            $table->string('url_to_image')->nullable();
            $table->datetime('published_at');
            $table->longText('content');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news_articles');
    }
};
