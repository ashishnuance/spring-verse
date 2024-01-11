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
        Schema::create('post_category', function (Blueprint $table) {
            $table->id();
            $table->string('name',50)->nullable()->index();
            $table->string('slug',50)->nullable()->index();
            $table->string('description',50)->nullable();
            $table->integer('active_status')->length(2)->default(1)->comment('1=active,0=inactive');
            $table->integer('trash')->length(2)->default(0)->comment('1=delete');
            $table->integer('permission')->length(2)->default(1)->comment('1=for company only');
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
        Schema::dropIfExists('post_category');
    }
};
