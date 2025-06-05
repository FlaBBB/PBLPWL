<?php

namespace Database\Seeders;

use App\Models\Competition;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class CompetitionTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $competitions = Competition::all();
        $tags = Tag::all();

        foreach ($competitions as $competition) {
            $attachedTags = [];
            $numberOfTags = rand(1, min(5, $tags->count()));

            for ($i = 0; $i < $numberOfTags; $i++) {
                $tag = $tags->except($attachedTags)->random();
                $competition->tags()->attach($tag->id);
                $attachedTags[] = $tag->id;
            }
        }
    }
}
