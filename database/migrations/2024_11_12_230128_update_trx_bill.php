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
        Schema::create('operator_prefixs', function (Blueprint $table) {
            $table->id();
            $table->string('prefix_number');//089.0888,08213
            $table->string('operator_prefix_name');
            $table->string('status_code');
            $table->string('status_message');
            // $table->string('created_by');
            // $table->string('updated_by');
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       
    }
}
