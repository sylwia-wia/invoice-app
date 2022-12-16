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
                    ->onDelete('cascade');

            $table->foreignId('unit_id')
                    ->constrained('unit');

            $table->decimal('net_price',11,2);
            $table->integer('vat_value');
            $table->decimal('gross_value',11,2);
            $table->decimal('quantity', 13, 4);

            $table->foreignId('business_document_id')
                    ->constrained('business_document')
                    ->onDelete('cascade');

            $table->foreignId('vat_rate_id')
                    ->constrained('vat_rate')
                    ->onDelete('restrict');

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
        Schema::dropIfExists('business_document_position');
    }
};
