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
        Schema::create('feedback', function (Blueprint $table) {
            $table->id();
            $table->string('status');
            $table->string('token');
            $table->integer('customer_id');
            $table->integer('branch_id');
            $table->integer('user_id');
            $table->integer('rating')->nullable();
            $table->longText('rating_comments')->nullable();
            $table->string('rating_sentiment')->nullable();
            $table->string('rating_score')->nullable();
            $table->integer('overall_rating')->nullable();
            $table->longText('overall_comments')->nullable();
            $table->string('overall_sentiment')->nullable();
            $table->string('overall_score')->nullable();

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
        Schema::dropIfExists('feedback');
    }
};
