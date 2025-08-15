<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('announcements', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            // 'slug' akan digunakan untuk URL yang ramah SEO
            $table->string('slug')->unique();
            $table->longText('content');
            $table->string('image')->nullable();
            $table->date('publish_date');
            // 'status' untuk menentukan apakah pengumuman sudah terbit atau masih draf
            $table->enum('status', ['draft', 'published'])->default('draft');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('announcements');
    }
};
