<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('retro_items', function (Blueprint $table) {
            $table->enum('categoria', ['positivo', 'negativo', 'accion'])->change();
        });
    }

    public function down()
    {
        Schema::table('retro_items', function (Blueprint $table) {
            $table->string('categoria')->change(); // o el tipo anterior que tenía
        });
    }
};