<?php

use App\Models\Company\Company;
use App\Models\Language;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('companies', static function (Blueprint $table): void {
            $table->id();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->unsignedTinyInteger('number_of_employees')->default(0);
            $table->string('slug')->nullable();
            $table->boolean('is_active')->default(false);
            $table->timestampsTz();
        });

        Schema::create('company_translations', static function (Blueprint $table): void {
            $table->id();
            $table->foreignIdFor(Company::class)->constrained()->cascadeOnDelete();
            $table->string('language', 2);
            $table->string('title');
            $table->text('description');
            $table->string('meta_title');
            $table->string('meta_description');
            $table->timestampsTz();

            $table->foreign('language')
                ->references('code')
                ->on('languages')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->unique(['company_id', 'language']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
        Schema::dropIfExists('company_translations');
    }
};
