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
        Schema::create('mahasiswa_preferences', function (Blueprint $table) {
            $table->string("nim");
            $table->foreign("nim")->references("nim")->on("mahasiswa")->onDelete("cascade");
            $table->foreignId("id_tag")->constrained("tag")->onDelete("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswa_preferences');
    }
};
