<?php

use App\Models\Age;
use App\Models\Quotation;
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
        Schema::create('age_quotation', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Age::class);
            $table->foreignIdFor(Quotation::class);
            $table->decimal('value');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('age_quotation');
    }
};
