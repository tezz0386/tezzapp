<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePortfoliosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('portfolios', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('order')->default(0);
            $table->string('title', 191);
            $table->string('image');
            $table->enum('status', ['active', 'inactive'])->default('inactive');
            $table->string('slug');
            $table->mediumText('summary')->nullable();
            $table->text('description')->nullable();
            $table->string('url');
            $table->string('type');
            $table->enum('is_developed', ['yes', 'no'])->default('no');
            $table->string('title_tag')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->text('meta_description')->nullable();
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
        Schema::dropIfExists('portfolios');
    }
}
