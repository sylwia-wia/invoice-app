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
                $table->string('number');
                $table->date('payment_date');
                $table->decimal('net_value', 15, 2);
                $table->decimal('vat_value', 11, 2);
                $table->decimal('gross_value', 15, 2);
                $table->decimal('gross_settled', 15, 2);

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
//        Schema::table('business_document', function (Blueprint $table) {
//            $table->dropForeign('document_type_id, contractor_id');
//        });
        Schema::dropIfExists('business_document');
    }
};
