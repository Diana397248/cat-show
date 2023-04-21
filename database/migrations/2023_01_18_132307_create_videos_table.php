<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->text('video');
            $table->text('thumbnail');
            $table->text('user');
            $table->text('description');
            $table->text('views');
            //todo category category dislikes
            $table->string('category', 100)->default('non-category');
            $table->bigInteger('likes')->default('0');
            $table->bigInteger('dislikes')->default('0');
            $table->enum('restrictions',
                ['AVAILABLE', 'VIOLATION', 'SHADOW_BAN', 'BAN']
            )->default('AVAILABLE');
            $table->enum('video_type',
                ['PUBLIC', 'PRIVATE']
            )->default('PUBLIC');
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
        Schema::dropIfExists('videos');
    }
};
