<?php

use App\Models\FbUser;
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
        Schema::create('fb_groups', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(FbUser::class,'fb_user_id');
            $table->text('access_token')->index();
            $table->string('group_id');
            $table->string('name');
            $table->string('category')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fb_groups');
    }
};
