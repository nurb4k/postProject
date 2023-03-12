<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->string('content');
            $table->string('img')->default('noimg');
            $table->foreignId('user_id')
                ->nullable()
                ->constrained();

            $table->foreignId('post_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('comments');
    }
};
