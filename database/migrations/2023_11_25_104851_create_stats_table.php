<?php

use App\Models\Country;
use App\Models\Platform;
use App\Models\Publisher;
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
        Schema::create('stats', function (Blueprint $table) {
            $table->id();
            $table->date('day');
            $table->foreignIdFor(Country::class);
            $table->foreignIdFor(Platform::class);
            $table->foreignIdFor(Publisher::class);
            $table->integer('impressions');
            $table->integer('conversions');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stats');
    }
};
