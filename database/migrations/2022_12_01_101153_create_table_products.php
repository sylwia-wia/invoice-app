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
        if(!Schema::hasTable('product')) {
            Schema::create('product', function (Blueprint $table) {
                $table->id();

                $table->foreignId('vat_rate_id')
                    ->constrained('vat_rate')
                    ->onDelete('CASCADE');

                $table->foreignId('unit_id')
                    ->constrained('unit')
                    ->onDelete('SET NULL');

                $table->string('name', 255)->unique();
                $table->decimal('price', 11, 2);
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
//        Schema::table('product', function (Blueprint $table) {
//            $table->dropForeign('vat_rate_id, unit_id');
//        });
        Schema::dropIfExists('product');
    }
};
