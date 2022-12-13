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
        Schema::table('advertisers', function (Blueprint $table) {
            $table->string('first_name', )->nullable()->change();
            $table->string('last_name', )->nullable()->change();
            $table->string('company_name')->nullable()->after('last_name');
            $table->string('address')->nullable()->after('company_name');
            $table->string('address2')->nullable()->after('address');
            $table->string('city')->nullable()->after('address2');
            $table->string('state')->nullable()->after('city');
            $table->string('zip')->nullable()->after('state');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('advertisers', 'company_name')) {
            Schema::table('advertisers', function (Blueprint $table) {
                $table->dropColumn('company_name');
            });
        }
        if (Schema::hasColumn('advertisers', 'address')) {
            Schema::table('advertisers', function (Blueprint $table) {
                $table->dropColumn('address');
            });
        }
        if (Schema::hasColumn('advertisers', 'address2')) {
            Schema::table('advertisers', function (Blueprint $table) {
                $table->dropColumn('address2');
            });
        }
        if (Schema::hasColumn('advertisers', 'city')) {
            Schema::table('advertisers', function (Blueprint $table) {
                $table->dropColumn('city');
            });
        }
        if (Schema::hasColumn('advertisers', 'state')) {
            Schema::table('advertisers', function (Blueprint $table) {
                $table->dropColumn('state');
            });
        }
        if (Schema::hasColumn('advertisers', 'zip')) {
            Schema::table('advertisers', function (Blueprint $table) {
                $table->dropColumn('zip');
            });
        }
    }
};
