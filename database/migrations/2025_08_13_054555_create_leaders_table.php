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
        Schema::create('leaders', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('position');
            $table->string('photo')->nullable();
            $table->string('birth_place')->nullable();
            $table->date('birth_date')->nullable();
            // Kolom-kolom ini akan disimpan sebagai JSON
            $table->text('education')->nullable();
            $table->text('career')->nullable();
            $table->text('achievements')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('leaders');
    }
};
