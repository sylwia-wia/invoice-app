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
        Schema::create('business_document_position', function (Blueprint $table) {
            $table->id();

            $table->foreignId('product_id')
                    ->constrained('product')
                    ->onDelete('CASCADE');

            $table->foreignId('unit_id')
                    ->constrained('unit');

            $table->decimal('net_price',11,2);
            $table->decimal('vat_value', 11, 2);
            $table->decimal('gross_value',11,2);
            $table->decimal('quantity', 13, 4);

            $table->foreignId('business_document_id')
                    ->constrained('business_document')
                    ->onDelete('CASCADE');

            $table->foreignId('vat_rate_id')
                    ->constrained('vat_rate')
                    ->onDelete('CASCADE');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//        Schema::table('business_document_position', function (Blueprint $table) {
//            $table->dropForeign('product_id, unit_id, business_document_id, vat_rate_id');
//        });
        Schema::dropIfExists('business_document_position');
    }
};
