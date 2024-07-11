<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('amnhacs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ten', 100);
            $table->integer('id_nhacsi')->unsigned()->nullable();
//            $table->unsignedInteger('id_nhacsi');
            $table->foreign('id_nhacsi')->on('nhacsis')
                ->references('id')
//                ->onDelete('cascade')
            ->onDelete('set null');
//            $table->foreignIdFor(Amnhac, '')
            $table->text('mota');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('amnhacs');
    }
};
