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
        Schema::table('departments', function (Blueprint $table) {
            $table->dropForeign('departments_management_id_foreign');
            $table->renameColumn('management_id', 'direction_id');
            $table->foreign('direction_id')->references('id')->on('directions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('departments', function (Blueprint $table) {
            $table->dropForeign('managements_department_id_foreign');
            $table->renameColumn('direction_id', 'management_id');

            $table->foreign('management_id')->references('id')->on('managements')->onDelete('cascade');
        });
    }
};
