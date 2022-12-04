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
        Schema::create('advertiser_email_addresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('advertiser_id')->unsigned()->index('advertiser_id');
            $table->foreign('advertiser_id')->references('id')->on('advertisers');
            $table->unsignedBigInteger('email_address_id')->unsigned()->index('email_address_id');
            $table->foreign('email_address_id')->references('id')->on('email_addresses');
            $table->unsignedBigInteger('created_by')->unsigned()->index('created_by');
            $table->foreign('created_by')->references('id')->on('users');
            $table->unsignedBigInteger('updated_by')->unsigned()->nullable()->index('updated_by');
            $table->foreign('updated_by')->references('id')->on('users');
            $table->timestamps();
            $table->unsignedBigInteger('deleted_by')->unsigned()->nullable()->index('deleted_by');
            $table->foreign('deleted_by')->references('id')->on('users');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('advertiser_email_addresses');
    }
};
