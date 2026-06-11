<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use App\Models\HeroSlide;

class HeroSlideSeeder extends Seeder
{
    /**
     * Seeds the hero_slides table using the images already in the React assets folder.
     * Copies them into storage/app/public/hero-slides/ so Laravel can serve them.
     */
    public function run(): void
    {
        // Source images (relative to the Backend directory — adjust path if needed)
        $assetDir = base_path('../magezi-ga-lawyer/src/assets');

        $slides = [
            ['file' => 'hero_slide_1.png', 'alt' => 'Ugandan lawyer reviewing legal documents in a modern office',  'title' => 'Expert Legal Guidance'],
            ['file' => 'hero_slide_2.png', 'alt' => 'Couple consulting a legal advisor',                            'title' => 'Personal Consultations'],
            ['file' => 'hero_slide_3.png', 'alt' => 'Woman signing an important legal document',                    'title' => 'Secure Documentation'],
            ['file' => 'hero_slide_4.png', 'alt' => 'Justice scales and gavel on a polished desk',                 'title' => 'Justice for All'],
            ['file' => 'hero_slide_5.png', 'alt' => 'Man accessing legal services on a smartphone',                'title' => 'Access Anywhere'],
            ['file' => 'hero_slide_6.png', 'alt' => 'Ugandan courtroom interior',                                  'title' => 'Court Ready'],
            ['file' => 'hero_slide_7.png', 'alt' => 'Legal professionals collaborating in a conference room',      'title' => 'Expert Team'],
            ['file' => 'hero.png',         'alt' => 'Legal agreement and partnership',                             'title' => 'Trusted Partner'],
        ];

        HeroSlide::truncate();

        foreach ($slides as $index => $slide) {
            $sourcePath = $assetDir . DIRECTORY_SEPARATOR . $slide['file'];
            $destPath   = 'hero-slides/' . $slide['file'];

            // Copy file into public storage disk
            if (file_exists($sourcePath)) {
                Storage::disk('public')->put($destPath, file_get_contents($sourcePath));
            }

            HeroSlide::create([
                'title'      => $slide['title'],
                'alt_text'   => $slide['alt'],
                'image_path' => $destPath,
                'sort_order' => $index,
                'is_active'  => true,
            ]);
        }

        $this->command->info('Hero slides seeded successfully (' . count($slides) . ' slides).');
    }
}
