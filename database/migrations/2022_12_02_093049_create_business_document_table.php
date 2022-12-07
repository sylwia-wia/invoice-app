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
        if(!Schema::hasTable('business_document')) {
            Schema::create('business_document', function (Blueprint $table) {
                $table->id();

                $table->foreignId('document_type_id')
                    ->nullable()
                    ->constrained('document_type')
                    ->onDelete('SET NULL');

                $table->foreignId('contractor_id')
                    ->constrained('contractor')
                    ->onDelete('CASCADE');

                $table->date('issue_date');
                $table->date('sale_date');
                $table->string('number')->unique();
                $table->date('payment_date');
                $table->decimal('net_value', 15, 2);
                $table->integer('vat');
                $table->decimal('gross_value', 15, 2);

                $table->foreignId('vat_rate_id')
                    ->constrained('vat_rate')
                    ->onDelete('RESTRICT');

                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('business_document');
    }
};
