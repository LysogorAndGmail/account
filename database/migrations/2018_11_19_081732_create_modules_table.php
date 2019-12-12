<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modules', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->decimal('price', 18, 2);
            $table->integer('trial_lenght');
            $table->integer('pay_period');
            $table->timestamps();
            $table->softDeletes();
        });

        DB::table('modules')->insert([
            [
                'name' => 'WORKFORCE',
                'price' => 300,
                'trial_lenght' => 30,
                'pay_period' => 12,
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
        Schema::dropIfExists('modules');
    }
}
