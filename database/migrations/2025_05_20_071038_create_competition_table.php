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
            $table->string("name");
            $table->text("description");
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
            $table->unsignedBigInteger("registration_fee");
            $table->unsignedSmallInteger("max_participation_amount");
            $table->foreignId(column: "creator")->constrained("user");
            $table->enum("status", [
                "WAITING",
                "ACCEPTED",
                "REJECTED"
            ]);
            $table->text("rejection_note");
            $table->string("verificator")->nullable();
            $table->foreign("verificator")->references("nip")->on("admin")->onDelete('cascade');
            $table->date("verified_at");
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
