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
        Schema::create('help', function (Blueprint $table) {
            $table->increments('id');
            
            $table->string('title',30)->nullable();
            $table->string('description',250)->nullable();
            $table->unsignedBigInteger('user_id')->default(0);
            $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onDelete('cascade'); 
            
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
        Schema::dropIfExists('help');
    }
};
