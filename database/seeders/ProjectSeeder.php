<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

/** Imports the projects that used to be hard-coded in the homepage. */
class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        if (Project::exists()) {
            return;
        }

        $projects = [
            ['Prakata.pro', 'web', 'img/opt/porto-1.webp', 'https://prakata.pro/', ['PHP', 'Tailwind', 'PostgreSQL'],
                'A comprehensive web application for data visualization and analytics with modern UI/UX design.'],
            ['Kamarispa.com', 'web', 'img/opt/porto-2.webp', null, ['PHP', 'Tailwind', 'PostgreSQL'],
                'E-commerce platform with advanced features and responsive design for spa services.'],
            ['Jayadewataacademy.com', 'web', 'img/opt/porto-3.webp', null, ['PHP', 'Tailwind', 'PostgreSQL'],
                'Educational platform with learning management system and interactive features.'],
            ['Bidan Nova', 'graphic', 'img/opt/porto-bidan.webp', null, ['Photoshop', 'Figma', 'Mockup'],
                'Complete brand identity design including logo, business cards, and marketing materials.'],
            ['Alluneed Digital Indonesia', 'graphic', 'img/opt/porto-alluneed.webp', null, ['Photoshop', 'Figma', 'Mockup'],
                'Digital marketing agency branding with modern and professional design approach.'],
            ['Waroenk Ikatan Cinta', 'graphic', 'img/opt/porto-waroek.webp', null, ['Photoshop', 'Figma', 'Mockup'],
                'Restaurant branding with unique visual identity and marketing materials.'],
        ];

        foreach ($projects as $i => [$title, $category, $image, $url, $tags, $description]) {
            Project::create([
                'title' => $title,
                'category' => $category,
                'image' => $image,
                'url' => $url,
                'tags' => $tags,
                'description' => $description,
                'sort_order' => $i + 1,
                'is_published' => true,
            ]);
        }
    }
}
