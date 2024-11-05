<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewHierarchyTable extends Migration
{
    public function up()
    {
        // php artisan migrate --path=/database/migrations/2024_08_08_054325_add_new_hierarchy_table.php
        // php artisan migrate:rollback --path=/database/migrations/2024_08_08_054325_add_new_hierarchy_table.php
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('client_name')->unique();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamps();
        });
        Schema::create('groups', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('client_id');
            $table->foreign('client_id')->references('id')->on('clients');
            $table->string('group_name');
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamps();
        });
        Schema::create('merchants', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('group_id');
            $table->foreign('group_id')->references('id')->on('groups');
            $table->string('merchant_name');
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();

            $table->timestamps();        });
        Schema::create('merchant_outlets', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('merchant_id');
            $table->foreign('merchant_id')->references('id')->on('merchants');
            $table->string('merchant_outlet_name');
            $table->string('merchant_outlet_username')->unique();
            $table->string('merchant_outlet_password');
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();

            $table->timestamps();
        });        //Product
        Schema::create('providers', function (Blueprint $table) {
            $table->id();
            $table->string('provider_name')->unique();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();

            $table->timestamps();
        });
        Schema::create('product_types', function (Blueprint $table) {            
            $table->id();
            $table->string('product_type_name')->unique();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();

            $table->timestamps();
        });
        Schema::create('product_categories', function (Blueprint $table) {
            $table->id();            
            $table->string('product_category_name')->unique();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();

            $table->timestamps();
        });
        Schema::create('product_clans', function (Blueprint $table) {
            $table->id();
            $table->string('product_clan_name')->unique();            
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamps();
        });
        Schema::create('product_providers', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('provider_id');
            $table->foreign('provider_id')->references('id')->on('providers');            
            $table->string('product_provider_name')->unique();
            $table->string('product_provider_code')->unique();
            $table->double('product_provider_price');
            $table->double('product_provider_admin_fee');
            $table->double('product_provider_merchant_fee');
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();

            $table->timestamps();
        });
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('product_provider_id');
            $table->foreign('product_provider_id')->references('id')->on('product_providers');
            $table->unsignedInteger('product_clan_id');            
            $table->foreign('product_clan_id')->references('id')->on('product_clans');
            $table->unsignedInteger('product_category_id');
            $table->foreign('product_category_id')->references('id')->on('product_categories');
            $table->unsignedInteger('product_type_id');
            $table->foreign('product_type_id')->references('id')->on('product_types');
            $table->string('product_name')->unique();
            $table->string('product_code')->unique();
            $table->string('product_nominal')->nullable();
            $table->string('product_details')->nullable();
            $table->string('icon_url')->nullable();
            $table->double('product_price');
            $table->double('product_admin_fee');
            $table->double('product_merchant_fee');
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            // product_nominal
            // product_details
            // icon_url
            $table->timestamps();
        });
        //trx
        Schema::create('biller_trxs', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('product_clan_id'); 
            $table->string('product_clan_name');
            $table->unsignedInteger('product_category_id');
            $table->string('product_category_name');
            $table->unsignedInteger('product_type_id');
            $table->string('product_type_name');
            
            $table->unsignedInteger('product_id');
            $table->string('product_name');
            $table->string('product_code');
            $table->double('product_price');
            $table->double('product_admin_fee');
            $table->double('product_merchant_fee');
            
            $table->unsignedInteger('provider_id');
            $table->string('provider_name');
            $table->unsignedInteger('product_provider_id');
            $table->string('product_provider_name');
            $table->string('product_provider_code');
            $table->double('product_provider_price');
            $table->double('product_provider_admin_fee');
            $table->double('product_provider_merchant_fee');

            $table->string('status_code');
            $table->string('status_message');
            $table->string('status_desc');
            $table->string('reference_number');
            
            $table->string('provider_status_code');
            $table->string('provider_status_message');
            $table->string('provider_status_desc');
            $table->string('provider_reference_number');
                        
            $table->unsignedInteger('client_id');
            $table->string('client_name');
            $table->unsignedInteger('group_id');
            $table->string('group_name');
            $table->unsignedInteger('merchant_id');
            $table->string('merchant_name');
            $table->unsignedInteger('merchant_outlet_id');
            $table->string('merchant_outlet_name');
            $table->string('merchant_outlet_username');
            
            $table->string('customer_id');
            $table->string('other_msg');
            $table->double('total_trx_amount');
            
            $table->string('created_by');
            $table->string('updated_by');
            $table->timestamps();
        });
        Schema::create('trx_statuses', function (Blueprint $table) {
            $table->id();
            // $table->unsignedInteger('client_id');
            $table->string('reference_number');
            $table->string('provider_reference_number');
            $table->string('status_code');
            $table->string('status_message');
            // $table->string('created_by');
            // $table->string('updated_by');
            // $table->timestamps();
        });
        Schema::create('no_generators', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('leadingzero');
            $table->string('data_type');
            $table->unsignedInteger('seqvalue');
            $table->string('prefix')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('merchant_outlets');
        Schema::dropIfExists('merchants');        
        Schema::dropIfExists('groups');
        Schema::dropIfExists('clients');
        Schema::dropIfExists('products');
        Schema::dropIfExists('product_providers');
        Schema::dropIfExists('product_categories');
        Schema::dropIfExists('product_types');
        Schema::dropIfExists('product_clans');
        Schema::dropIfExists('providers');
        Schema::dropIfExists('biller_trxs');
        Schema::dropIfExists('trx_statuses');
        Schema::dropIfExists('no_generators');
    }
}
