<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTrxBill extends Migration
{
    // php artisan migrate --path=/database/migrations/2024_11_12_230128_update_trx_bill.php
    // php artisan migrate:rollback --path=/database/migrations/2024_11_12_230128_update_trx_bill.php
    public function up()
    {
        Schema::table('biller_trxs', function (Blueprint $table) {
            // $table->text('other_msg')->nullable()->change();
            $table->dropColumn('other_msg');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('biller_trxs', function (Blueprint $table) {
            $table->text('other_msg')->nullable()->change();
            // $table->string('other_msg');
        });
    }
}
