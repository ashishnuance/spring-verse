<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Database\Seeders\UserSeeder;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name',50)->nullable();
            $table->string('email')->unique();
            $table->string('phone',50)->nullable();
            $table->timestamp('last_login')->nullable();
            $table->integer('gender')->default(1)->comment('1=male,0=female');
            $table->integer('notification_message')->default(0);
            $table->string('bio',250)->nullable();
            $table->string('instagram',200)->nullable();
            $table->string('twitter',200)->nullable();
            $table->string('facebook',200)->nullable();
            $table->string('snapchat',200)->nullable();
            $table->string('other_social_media',200)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->integer('active_status')->length(2)->default(1)->comment('1=active,0=inactive');
            $table->string('verify_code',10)->nullable();
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
        });

        $seeder = new UserSeeder();
        $seeder->run();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
