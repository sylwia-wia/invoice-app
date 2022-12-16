<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('document_type', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        DB::table('document_type')->insert(
            [
                [
                    'id' => 1,
                    'name' => 'FS',
                    'created_at' => '2022-12-14 10:00:00'
                ],
                [
                    'id' => 2,
                    'name' => 'FS',
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
        Schema::dropIfExists('document_type');
    }
};
