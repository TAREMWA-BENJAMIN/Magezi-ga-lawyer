<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PracticeAreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $areas = [
            [
                'title' => 'Property & Land Law',
                'slug' => 'property-law',
                'short_description' => 'Navigate land ownership, transactions, boundary disputes, and tenant rights under the Uganda Land Act.',
                'description' => 'We provide comprehensive legal services for property and land matters across Uganda. Our team handles land acquisitions, boundary disputes, title transfers, and tenancy agreements with deep knowledge of Ugandan land tenure systems.',
                'icon' => 'Building2',
                'emoji_icon' => '🏠',
                'features' => [
                    'Land title verification and registration',
                    'Boundary and ownership dispute resolution',
                    'Lease and tenancy agreement drafting',
                    'Property conveyancing and transfers',
                    'Customary land rights protection',
                ],
            ],
            [
                'title' => 'Family Law',
                'slug' => 'family-law',
                'short_description' => 'Expert guidance on marriage, divorce, child custody, adoption, and inheritance matters across all Ugandan cultures.',
                'description' => 'Our family law practice provides compassionate and effective legal representation in all domestic matters. We handle divorce, child custody, adoption, inheritance disputes, and protection orders with sensitivity and expertise.',
                'icon' => 'Users',
                'emoji_icon' => '👨‍👩‍👧‍👦',
                'features' => [
                    'Divorce and separation proceedings',
                    'Child custody and guardianship',
                    'Adoption and fostering applications',
                    'Inheritance and succession disputes',
                    'Domestic violence protection orders',
                ],
            ],
            [
                'title' => 'Criminal Law',
                'slug' => 'criminal-law',
                'short_description' => 'Understand your rights if accused or arrested. We provide robust defence and representation in criminal proceedings.',
                'description' => 'We offer robust criminal defense and prosecution support services. Our advocates have extensive courtroom experience representing clients in all levels of Ugandan courts, from Magistrate Courts to the Supreme Court.',
                'icon' => 'Shield',
                'emoji_icon' => '⚖️',
                'features' => [
                    'Criminal defense representation',
                    'Bail and bond applications',
                    'Plea bargaining and negotiations',
                    'Appeals and judicial review',
                    'Human rights and constitutional cases',
                ],
            ],
            [
                'title' => 'Employment Law',
                'slug' => 'employment-law',
                'short_description' => 'Protect your workplace rights — unfair dismissal, wage disputes, contracts, and occupational safety compliance.',
                'description' => 'We protect the rights of both employers and employees under Ugandan labour legislation. Our practice covers unfair dismissal claims, workplace discrimination, contract disputes, and regulatory compliance advisory.',
                'icon' => 'Briefcase',
                'emoji_icon' => '💼',
                'features' => [
                    'Employment contract drafting and review',
                    'Unfair dismissal and redundancy claims',
                    'Workplace discrimination and harassment',
                    'Labour dispute mediation and arbitration',
                    'Regulatory compliance and HR advisory',
                ],
            ],
            [
                'title' => 'Commercial Law',
                'slug' => 'commercial-law',
                'short_description' => 'Company registration, contract drafting, trade disputes, and regulatory compliance for Ugandan businesses.',
                'description' => 'Our commercial law team advises businesses of all sizes on corporate governance, contract negotiations, regulatory compliance, and dispute resolution. We help Ugandan enterprises navigate complex legal landscapes and grow with confidence.',
                'icon' => 'Scale',
                'emoji_icon' => '🏢',
                'features' => [
                    'Company incorporation and registration',
                    'Commercial contract negotiation',
                    'Corporate governance advisory',
                    'Intellectual property protection',
                    'Mergers, acquisitions, and partnerships',
                ],
            ],
        ];

        foreach ($areas as $area) {
            \App\Models\PracticeArea::create($area);
        }
    }
}
