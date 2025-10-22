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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title', 200)->index('title');
            $table->string('added_by', 30);
            $table->integer('user_id');
            $table->integer('category_id');
            $table->integer('address_id')->nullable();
            $table->mediumText('slug')->nullable();
            $table->string('image')->nullable();
            $table->string('img_watermark')->nullable();
            $table->string('audio_file', 300)->nullable();
            $table->string('video_provider', 20)->nullable();
            $table->string('video_link', 500)->nullable();
            $table->string('source', 500)->nullable();
            $table->longText('description')->nullable();
            $table->integer('is_publish')->default(1);
            $table->boolean('is_approve')->default(false);
            $table->boolean('is_feature')->default(false);
            $table->boolean('is_breaking_news')->default(true);
            $table->integer('view_count')->default(0);
            $table->mediumText('meta_title')->nullable();
            $table->longText('meta_description')->nullable();
            $table->string('meta_img', 255)->nullable();
            $table->string('pdf', 255)->nullable();
            $table->string('reporter_name')->nullable();
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
        Schema::dropIfExists('posts');
    }
};
