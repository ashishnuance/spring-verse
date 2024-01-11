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
        Schema::create('post', function (Blueprint $table) {
            $table->id();
            $table->string('title',100)->nullable()->index();
            $table->text('description')->nullable();
            $table->string('location',250)->nullable()->index();
            $table->string('latitude',50)->nullable();
            $table->string('longitude',50)->nullable();
            $table->integer('created_by')->default(0)->comment('user id who created');
            $table->string('item',100)->nullable()->index();
            $table->string('type',100)->nullable()->index();
            $table->string('model',100)->nullable()->index();
            $table->string('year',8)->nullable();
            $table->text('issue')->nullable();
            $table->enum('sell_type',['car','parts'])->nullable();
            $table->double('price',8,2)->default(0)->index();
            $table->string('subcategory',100)->nullable();
            $table->date('event_date')->nullable()->index();
            $table->time('event_time')->nullable();
            $table->integer('like_count')->length(2)->default(0);
            $table->integer('favourite_count')->length(2)->default(0);
            $table->integer('winger_it')->length(2)->default(0);
            $table->integer('comment_count')->length(2)->default(0);
            $table->integer('active_status')->length(2)->default(1)->comment('1=active,0=inactive');
            $table->integer('trash')->length(2)->default(0)->comment('1=delete');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post');
    }
};
