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
        Schema::create('faqs', function (Blueprint $table) {
            $table->increments('id');
            
            $table->text('question')->nullable();
            $table->text('answer')->nullable();
            $table->string('category',20)->nullable();
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
        Schema::dropIfExists('faqs');
    }
};
