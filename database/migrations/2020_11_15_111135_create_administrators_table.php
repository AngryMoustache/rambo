<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateAdministratorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('administrators', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('email')->unique();
            $table->string('password');
            $table->foreignId('avatar_id')->nullable()->constrained('attachments')->nullOnDelete();
            $table->boolean('online')->default(0);
            $table->timestamps();
        });

        DB::table('administrators')->insert([
            'username' => 'Admin',
            'email' => 'admin',
            'password' => '$2y$10$1KTK.XWRA22lgvB/En9IuO71bfDHsirOZmHuWmFveThRZX18XTR5e',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('administrators');
    }
}
