<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            if (!Schema::hasColumn('orders', 'collector_id')) {
                $table->foreignId('collector_id')->nullable()->constrained('users')->nullOnDelete()->after('user_id');
            }
            // ensure status exists and default is 'pending'
            if (!Schema::hasColumn('orders', 'status')) {
                $table->string('status')->default('pending')->after('total');
            }
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            if (Schema::hasColumn('orders', 'collector_id')) {
                $table->dropConstrainedForeignId('collector_id');
            }
            if (Schema::hasColumn('orders', 'status')) {
                // be careful not to drop if original had status; adjust as necessary
                // $table->dropColumn('status');
            }
        });
    }
};
