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
        Schema::create('competition', function (Blueprint $table) {
            $table->id();
            $table->string("name")->unique();
            $table->string("description");
            $table->enum("level", [
                "INTERNAL",
                "CITY",
                "PROVINCE",
                "NATIONAL",
                "INTERNATIONAL"
            ]);
            $table->string("poster");
            $table->string("organizer");
            $table->date("start_at");
            $table->date("end_at");
            $table->date("registration_deadline");
            $table->string("registration_link");
            $table->string("registration_fee");
            $table->unsignedSmallInteger("max_participation_amount");
            $table->foreignId("creator")->constrained("user")->onDelete("cascade");
            $table->enum("status", [
                "WAITING",
                "ACCEPTED",
                "REJECTED"
            ]);
            $table->text("rejection_note")->nullable();
            $table->string("verificator");
            $table->foreign("verificator")->references("nip")->on("admin")->onDelete("cascade");
            $table->timestamp("verified_at")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('competition');
    }
};
