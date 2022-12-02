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
        Schema::create('position', function (Blueprint $table) {
            $table->id();

            $table->foreignId('product_id')
                    ->constrained('product')
                    ->onDelete('cascade');

            $table->string('unit');
            $table->decimal('net_price',11,2);
            $table->integer('vat');
            $table->decimal('gross_price',11,2);

            $table->foreignId('business_document_id')
                    ->constrained('business_document')
                    ->onDelete('cascade');

            $table->foreignId('vat_rate')
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
        Schema::dropIfExists('position');
    }
};
