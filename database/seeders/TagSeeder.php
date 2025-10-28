<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Cat Breeds - Hierarchical structure
        $catBreeds = Tag::create([
            'name' => 'Cat Breeds',
            'slug' => 'cat-breeds',
            'parent_id' => null,
        ]);

        // Longhaired Cats
        $longhaired = Tag::create([
            'name' => 'Longhaired Cats',
            'slug' => 'longhaired-cats',
            'parent_id' => $catBreeds->id,
        ]);

        $bigBrother = Tag::create([
            'name' => 'Big Brother',
            'slug' => 'big-brother',
            'parent_id' => $longhaired->id,
        ]);

        // Big Brother breeds
        Tag::create(['name' => 'Maine Coon', 'slug' => 'maine-coon', 'parent_id' => $bigBrother->id]);
        Tag::create(['name' => 'Norwegian Forest Cat', 'slug' => 'norwegian-forest-cat', 'parent_id' => $bigBrother->id]);
        Tag::create(['name' => 'Siberian Forest Cat', 'slug' => 'siberian-forest-cat', 'parent_id' => $bigBrother->id]);

        // Other longhaired breeds
        Tag::create(['name' => 'Persian', 'slug' => 'persian', 'parent_id' => $longhaired->id]);
        Tag::create(['name' => 'Ragdoll', 'slug' => 'ragdoll', 'parent_id' => $longhaired->id]);
        Tag::create(['name' => 'Himalayan', 'slug' => 'himalayan', 'parent_id' => $longhaired->id]);

        // Shorthaired Cats
        $shorthaired = Tag::create([
            'name' => 'Shorthaired Cats',
            'slug' => 'shorthaired-cats',
            'parent_id' => $catBreeds->id,
        ]);

        Tag::create(['name' => 'British Shorthair', 'slug' => 'british-shorthair', 'parent_id' => $shorthaired->id]);
        Tag::create(['name' => 'American Shorthair', 'slug' => 'american-shorthair', 'parent_id' => $shorthaired->id]);
        Tag::create(['name' => 'Russian Blue', 'slug' => 'russian-blue', 'parent_id' => $shorthaired->id]);
        Tag::create(['name' => 'Siamese', 'slug' => 'siamese', 'parent_id' => $shorthaired->id]);
        Tag::create(['name' => 'Bengal', 'slug' => 'bengal', 'parent_id' => $shorthaired->id]);

        // Cat Topics
        $catTopics = Tag::create([
            'name' => 'Cat Topics',
            'slug' => 'cat-topics',
            'parent_id' => null,
        ]);

        // Care subtopics
        $care = Tag::create(['name' => 'Cat Care', 'slug' => 'cat-care', 'parent_id' => $catTopics->id]);
        Tag::create(['name' => 'Grooming', 'slug' => 'grooming', 'parent_id' => $care->id]);
        Tag::create(['name' => 'Nutrition', 'slug' => 'nutrition', 'parent_id' => $care->id]);
        Tag::create(['name' => 'Health', 'slug' => 'health', 'parent_id' => $care->id]);

        // Behavior subtopics
        $behavior = Tag::create(['name' => 'Cat Behavior', 'slug' => 'cat-behavior', 'parent_id' => $catTopics->id]);
        Tag::create(['name' => 'Training', 'slug' => 'training', 'parent_id' => $behavior->id]);
        Tag::create(['name' => 'Socialization', 'slug' => 'socialization', 'parent_id' => $behavior->id]);
        Tag::create(['name' => 'Play & Toys', 'slug' => 'play-toys', 'parent_id' => $behavior->id]);

        // Age Groups
        $ageGroups = Tag::create([
            'name' => 'Age Groups',
            'slug' => 'age-groups',
            'parent_id' => null,
        ]);

        Tag::create(['name' => 'Kittens', 'slug' => 'kittens', 'parent_id' => $ageGroups->id]);
        Tag::create(['name' => 'Adult Cats', 'slug' => 'adult-cats', 'parent_id' => $ageGroups->id]);
        Tag::create(['name' => 'Senior Cats', 'slug' => 'senior-cats', 'parent_id' => $ageGroups->id]);
    }
}
