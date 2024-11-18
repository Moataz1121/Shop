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
        Schema::table('sellers', function (Blueprint $table) {
            //
            $table->decimal('wallet', 15, 2)->default(0.00)->after('email'); // Replace 'column_name' with the column after which you want to add 'wallet'

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sellers', function (Blueprint $table) {
            //
            $table->dropColumn('wallet');
        });
    }
};
