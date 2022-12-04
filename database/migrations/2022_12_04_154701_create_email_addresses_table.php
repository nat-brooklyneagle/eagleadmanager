<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('email_addresses', function (Blueprint $table) {
            $table->id();
            $table->string('email_address');
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
     */
    public function down(): void
    {
        Schema::dropIfExists('email_addresses');
    }
};
