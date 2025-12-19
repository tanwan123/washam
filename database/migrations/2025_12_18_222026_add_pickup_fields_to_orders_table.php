<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::table('orders', function (Blueprint $table) {
        $table->string('pickup_address')->nullable();
        $table->string('delivery_address')->nullable();
        $table->string('contact_phone')->nullable();
    });
}

public function down()
{
    Schema::table('orders', function (Blueprint $table) {
        $table->dropColumn([
            'pickup_address',
            'delivery_address',
            'contact_phone'
        ]);
    });
}

};
