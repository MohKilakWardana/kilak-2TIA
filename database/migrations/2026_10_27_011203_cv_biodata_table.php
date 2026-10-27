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
        Schema::table('biodata_1116', function (Blueprint $table) {
            $table->string('tempat_lahir', 100)->nullable()->after('jenis_kelamin');
            $table->string('agama', 30)->nullable();
            $table->string('kewarganegaraan', 50)->nullable()->default('Indonesia');
            $table->string('status', 30)->nullable();
            $table->string('profesi', 100)->nullable();
            $table->string('foto')->nullable();
            $table->text('pendidikan')->nullable();
            $table->text('pengalaman')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('biodata_1116', function (Blueprint $table) {
            $table->dropColumn([
                'tempat_lahir', 'agama', 'kewarganegaraan', 'status',
                'profesi', 'foto', 'pendidikan', 'pengalaman',
            ]);
        });
    }
};
