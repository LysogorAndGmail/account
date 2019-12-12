<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrgSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('org_subscriptions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('org_id')->unsigned();
            $table->foreign('org_id')->references('id')->on('organizations')->onDelete('cascade');
            $table->integer('module_id')->unsigned();
            $table->foreign('module_id')->references('id')->on('modules')->onDelete('cascade');
            $table->timestamp('purchased_at')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->timestamp('valid_till')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        DB::table('org_subscriptions')->insert([
            [
                'org_id'       => 1,
                'module_id'    => 1,
                'purchased_at' => \Carbon\Carbon::now(),
                'paid_at'      => \Carbon\Carbon::now(),
                'valid_till'   => \Carbon\Carbon::now()->addYear(),
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
        Schema::dropIfExists('org_subscriptions');
    }
}
