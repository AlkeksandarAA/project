<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('events_users_tickets', function (Blueprint $table) {
            $table->foreignId('ticket_id')->constrained('tickets')->onDelete('cascade');
            $table->timestamp('purchese_made')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events_users_tickets', function (Blueprint $table) {
            $table->dropForeign('ticket_id');
            $table->dropColumn('ticket_id');
        });
    }
};
