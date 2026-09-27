<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::table('repair_requests', function (Blueprint $table) {
        $table->foreignId('brand_id')
            ->nullable()
            ->after('phone')
            ->constrained('brands')
            ->nullOnDelete();

        $table->foreignId('model_id')
            ->nullable()
            ->after('brand_id')
            ->constrained('phone_models')
            ->nullOnDelete();

        $table->foreignId('damage_id')
            ->nullable()
            ->after('model_id')
            ->constrained('damages')
            ->nullOnDelete();
    });
}

    public function down(): void
{
    Schema::table('repair_requests', function (Blueprint $table) {
        $table->dropForeign(['brand_id']);
        $table->dropForeign(['model_id']);
        $table->dropForeign(['damage_id']);

        $table->dropColumn([
            'brand_id',
            'model_id',
            'damage_id',
        ]);
    });
}
};