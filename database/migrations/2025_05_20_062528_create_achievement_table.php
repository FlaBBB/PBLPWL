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
        Schema::create('achievement', function (Blueprint $table) {
            $table->id();
            $table->timestamp("upload_at")->default(now());
            $table->string("competition_type");
            $table->string("comptition_name");
            $table->string("competition_name_en");
            $table->string("competition_location");
            $table->string("competition_location_en");
            $table->string("competition_url");
            $table->date("start_at");
            $table->date("end_at");
            $table->unsignedInteger("pt_partition_number");
            $table->unsignedInteger("partition_number");
            $table->string("assignment_letter_number");
            $table->date("assignment_letter_date");
            $table->string("file_assignment_letter");
            $table->string("file_certificate");
            $table->string("file_activity_photo");
            $table->string("file_poster");
            $table->enum("level", [
                "INTERNAL",
                "CITY",
                "PROVINCE",
                "NATIONAL",
                "INTERNATIONAL"
            ]);
            $table->unsignedSmallInteger("place");
            $table->enum("status", [
                "WAITING",
                "REVISION",
                "ACCEPTED",
                "REJECTED"
            ]);
            $table->text("note")->nullable();
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
        Schema::dropIfExists('achievement');
    }
};
