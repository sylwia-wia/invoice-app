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
        Schema::create('vat_rate', function (Blueprint $table) {
            $table->id();
            $table->integer('rate');
            $table->timestamps();
        });

        DB::table('vat_rate')->insert(
            [
                [
                    'id' => 1,
                    'rate' => 0,
                    'created_at' => '2022-12-14 10:00:00'
                ],
                [
                    'id' => 2,
                    'rate' => 5,
                    'created_at' => '2022-12-14 10:00:00'
                ],
                [
                    'id' => 3,
                    'rate' => 8,
                    'created_at' => '2022-12-14 10:00:00'
                ],
                [
                    'id' => 4,
                    'rate' => 23,
                    'created_at' => '2022-12-14 10:00:00'
                ],
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vat_rate');
    }
};
