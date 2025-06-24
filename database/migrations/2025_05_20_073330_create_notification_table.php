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
        Schema::create('notification', function (Blueprint $table) {
            $table->id();
            $table->foreignId("id_user")->constrained("user");
            $table->unsignedBigInteger('id_reference')->nullable(); // Can be used for polymorphic relations or general reference
            $table->string('type')->nullable(); // e.g., 'message', 'task', 'announcement'
            $table->text('content');
            $table->boolean('is_read')->default(false);
            $table->foreignId('sender_id')->nullable()->constrained('user'); // Optional: who sent the notification
            $table->timestamp('read_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notification');
    }
};
