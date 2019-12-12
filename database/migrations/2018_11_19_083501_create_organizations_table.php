<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrganizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organizations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('reg')->nullable();
            $table->string('vat')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        DB::table('organizations')->insert([
            [
                'name'    => 'Nuvalo OÜ',
                'address' => 'Pärnu mnt 130, Tallinn',
                'phone'   => '56865554',
                'email'   => 'info@merrant.ee',
                'reg'     => '8776547687',
                'vat'     => 'EE9865769879',
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('organizations');
    }
}
