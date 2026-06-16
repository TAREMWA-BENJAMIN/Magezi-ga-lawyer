<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TeamMember;
use App\Models\Faq;
use App\Models\LibraryItem;
use App\Models\SiteSetting;
use App\Models\CoreValue;
use App\Models\Milestone;
use App\Models\Testimonial;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // === Site Settings ===
        SiteSetting::insert([
            ['key' => 'home_hero_title', 'value' => 'Accessible Legal Guidance for Every Ugandan', 'type' => 'string'],
            ['key' => 'home_hero_subtitle', 'value' => 'Magezi ga Lawyer helps you find trusted legal information, build easy document templates, and connect with experienced lawyers — all in a calm, readable interface designed for clarity.', 'type' => 'string'],
            ['key' => 'about_header_title', 'value' => 'About Magezi ga Lawyer', 'type' => 'string'],
            ['key' => 'about_header_text', 'value' => 'Founded in 2005, Magezi ga Lawyer is one of Uganda\'s most trusted law firms — dedicated to making justice accessible, affordable, and effective for every Ugandan.', 'type' => 'string'],
            ['key' => 'about_mission_text', 'value' => 'To provide expert, compassionate legal services that empower ordinary Ugandans to navigate the law with confidence — whether in court, in business, or in everyday life.', 'type' => 'string'],
            ['key' => 'about_vision_text', 'value' => 'A Uganda where no one is denied justice because of the complexity of the law or the cost of legal services. We envision a society where legal knowledge is a right, not a privilege.', 'type' => 'string'],
            ['key' => 'firm_stats', 'value' => json_encode(['casesResolved' => 1200, 'yearsExperience' => 15, 'teamMembers' => 6, 'clientSatisfaction' => 98, 'areasOfPractice' => 5, 'documentsProcessed' => 3000]), 'type' => 'json'],
            ['key' => 'get_started_steps', 'value' => json_encode([
                ['id' => 1, 'title' => 'Create your account', 'desc' => 'Fill in your personal details to open your free client account.'],
                ['id' => 2, 'title' => 'Describe your matter', 'desc' => 'Tell us briefly about the legal issue you need help with.'],
                ['id' => 3, 'title' => 'Get matched', 'desc' => 'We\'ll connect you with the right specialist from our team.'],
                ['id' => 4, 'title' => 'Free consultation', 'desc' => 'Speak with your assigned lawyer at no charge to get started.'],
            ]), 'type' => 'json']
        ]);

        // === Milestones ===
        Milestone::insert([
            ['year' => '2005', 'event' => 'Firm founded by Babirye Catherine Magezi in Kampala with a focus on property and land law.'],
            ['year' => '2009', 'event' => 'Expanded into criminal and family law, adding two senior partners to the team.'],
            ['year' => '2013', 'event' => 'Opened a second office in Jinja to serve clients in eastern Uganda.'],
            ['year' => '2016', 'event' => 'Launched the Community Legal Aid Clinic, providing pro bono services to underserved communities.'],
            ['year' => '2019', 'event' => 'Introduced the online legal library — Uganda\'s first free public legal resource hub.'],
            ['year' => '2022', 'event' => 'Recognised by the Uganda Law Society as a leading firm in access to justice initiatives.'],
            ['year' => '2024', 'event' => 'Launched the digital document templates service to empower Ugandans to self-draft basic legal documents.'],
        ]);

        // === Core Values ===
        CoreValue::insert([
            ['icon' => '⚖️', 'title' => 'Justice for All', 'description' => 'We believe that every Ugandan, regardless of income or background, deserves access to quality legal representation.'],
            ['icon' => '🤝', 'title' => 'Integrity', 'description' => 'We act with honesty and transparency in every client relationship, upholding the highest ethical standards of the legal profession.'],
            ['icon' => '🌍', 'title' => 'Community First', 'description' => 'Our roots are in the communities we serve. We measure success not just in court victories but in lives improved.'],
            ['icon' => '📚', 'title' => 'Continuous Learning', 'description' => 'Uganda\'s legal landscape evolves. We invest in ongoing education to stay at the forefront of the law for our clients.'],
        ]);

        // === Testimonials ===
        Testimonial::insert([
            ['name' => 'Nalubega Sarah', 'location' => 'Kampala', 'quote' => 'Magezi ga Lawyer helped me understand my land title documents in plain language. I was able to resolve a boundary dispute with my neighbour without going to court. The guides are clear and truly accessible.', 'avatar' => null],
            ['name' => 'Okello David', 'location' => 'Gulu', 'quote' => 'When I was wrongfully dismissed from my job, I found the employment law guides on this site. They helped me understand my rights and prepare for my labour tribunal hearing. I won my case.', 'avatar' => null],
            ['name' => 'Ainembabazi Grace', 'location' => 'Mbarara', 'quote' => 'As a single mother, understanding custody law was overwhelming. The family law section gave me confidence and clarity. The lawyers here genuinely care about helping ordinary Ugandans.', 'avatar' => null],
        ]);

        // === Team Members ===
        TeamMember::insert([
            ['name' => 'John Mukasa', 'role' => 'Managing Partner & Senior Advocate', 'specialization' => 'Property Law & Land Disputes', 'bio' => 'John Mukasa is a seasoned advocate with over 15 years of experience in Ugandan property law. He has successfully represented clients in landmark land disputes across the Central and Eastern regions. John holds an LLB from Makerere University and an LLM from the University of London.', 'image' => 'https://ui-avatars.com/api/?name=John+Mukasa&size=300&background=0f4d85&color=fff', 'email' => 'john@magezi.ug'],
            ['name' => 'Sarah Nakambi', 'role' => 'Senior Advocate', 'specialization' => 'Commercial & Corporate Law', 'bio' => 'Sarah Nakambi specializes in commercial law, corporate governance, and business advisory services. With a decade of practice, she has advised numerous SMEs and multinational corporations on Ugandan regulatory compliance and contract negotiations.', 'image' => 'https://ui-avatars.com/api/?name=Sarah+Nakambi&size=300&background=0c6f57&color=fff', 'email' => 'sarah@magezi.ug'],
            ['name' => 'Grace Okonkwo', 'role' => 'Legal Aid Officer & Family Law Specialist', 'specialization' => 'Family Law & Gender-Based Violence', 'bio' => 'Grace Okonkwo is a passionate advocate for family justice and women\'s rights in Uganda. She has handled hundreds of custody, divorce, and domestic violence cases, providing compassionate legal support to vulnerable communities through pro bono initiatives.', 'image' => 'https://ui-avatars.com/api/?name=Grace+Okonkwo&size=300&background=b8232f&color=fff', 'email' => 'grace@magezi.ug'],
            ['name' => 'David Osei', 'role' => 'Associate Advocate', 'specialization' => 'Employment & Labour Law', 'bio' => 'David Osei focuses on employment law, workers\' rights, and labour dispute resolution. He has represented both employers and employees in unfair dismissal claims, workplace discrimination cases, and collective bargaining agreements.', 'image' => 'https://ui-avatars.com/api/?name=David+Osei&size=300&background=8b5cf6&color=fff', 'email' => 'david@magezi.ug'],
            ['name' => 'Peter Banda', 'role' => 'Advocate & Criminal Defense Specialist', 'specialization' => 'Criminal Law & Human Rights', 'bio' => 'Peter Banda is a dedicated criminal defense advocate with extensive courtroom experience. He has represented clients in high-profile criminal cases across Uganda, specializing in bail applications, plea bargaining, and appellate advocacy.', 'image' => 'https://ui-avatars.com/api/?name=Peter+Banda&size=300&background=f59e0b&color=fff', 'email' => 'peter@magezi.ug'],
            ['name' => 'Amina Otieno', 'role' => 'Legal Aid Officer & Community Outreach Lead', 'specialization' => 'Legal Aid & Community Justice', 'bio' => 'Amina Otieno leads community legal outreach programs across rural Uganda, ensuring access to justice for underserved populations. She specializes in legal literacy, alternative dispute resolution, and community mediation services.', 'image' => 'https://ui-avatars.com/api/?name=Amina+Otieno&size=300&background=06b6d4&color=fff', 'email' => 'amina@magezi.ug'],
        ]);

        // === FAQs ===
        Faq::insert([
            ['question' => 'How do I verify land ownership in Uganda?', 'answer' => 'Land ownership in Uganda can be verified by conducting a search at the relevant District Land Office or the Ministry of Lands, Housing and Urban Development. You will need the plot number and the area/block details. Our team can assist you with official land title searches and due diligence to ensure the property is free from encumbrances.'],
            ['question' => 'What are the grounds for divorce in Uganda?', 'answer' => 'Under the Divorce Act of Uganda, grounds for divorce include adultery, cruelty (both physical and mental), desertion for at least two years, and a combination of these grounds. For Muslim marriages, provisions under the Marriage and Divorce of Mohammedans Act apply. We recommend consulting with our family law specialists for guidance specific to your situation.'],
            ['question' => 'What are my rights if I am arrested in Uganda?', 'answer' => 'Under the Constitution of Uganda, you have the right to remain silent, the right to be informed of the reason for your arrest, the right to legal representation, the right to be brought before a court within 48 hours, and the right not to be tortured or subjected to cruel treatment. If you or a loved one has been arrested, contact us immediately for legal assistance.'],
            ['question' => 'How does inheritance work under Ugandan law?', 'answer' => 'Inheritance in Uganda is governed by the Succession Act, which provides for both testate (with a will) and intestate (without a will) succession. Under intestate succession, the surviving spouse, children, and dependants are entitled to specified shares of the estate. Customary law may also apply depending on the community. Our family law team can guide you through probate and estate administration.'],
        ]);

        // === Library Items ===
        LibraryItem::create([
            'title' => 'Understanding Land Tenure Systems in Uganda',
            'category' => 'Property Law',
            'summary' => 'A comprehensive guide to the four land tenure systems recognized under the Ugandan Constitution and Land Act.',
            'content' => 'Uganda recognizes four distinct land tenure systems: Freehold, Leasehold, Mailo, and Customary. Freehold tenure grants the holder registered ownership in perpetuity, allowing full rights to use, develop, and transfer the land. Leasehold tenure is granted for a specified period, typically 49 or 99 years, and is common for urban and government-allocated land. Mailo tenure, unique to the Buganda Kingdom, was established under the 1900 Buganda Agreement and grants ownership in perpetuity similar to freehold, but with a distinction between landowners (mailo owners) and lawful/bona fide occupants. Customary tenure is governed by the rules and customs of the community where the land is located, and is the most prevalent form of land ownership in rural Uganda. The Land Act of 1998 and its amendments provide the legal framework for the administration and management of all land tenure types.',
            'related_links' => [
                ['title' => 'The Land Act 1998', 'url' => 'https://ulii.org/ug/legislation/consolidated-act/227'],
                ['title' => 'Ministry of Lands Uganda', 'url' => 'https://mlhud.go.ug/'],
            ],
        ]);
        LibraryItem::create([
            'title' => 'Your Rights During Arrest and Detention',
            'category' => 'Criminal Law',
            'summary' => 'Know your constitutional rights if you are arrested or detained by Ugandan authorities.',
            'content' => 'The Constitution of Uganda under Article 23 provides comprehensive protections for persons who are arrested or detained. Every person arrested has the right to be informed immediately of the reason for the arrest. You have the right to a lawyer of your choice, and if you cannot afford one, the state is obligated to provide legal representation in cases involving serious offences. You must be brought before a court within 48 hours of arrest. You have the right to apply for bail, which may be granted at the discretion of the court. You cannot be subjected to torture, cruel, inhuman, or degrading treatment. Any statement obtained through coercion is inadmissible in court. The Police must keep proper records of arrests and detentions. If your rights are violated, you may file a complaint with the Uganda Human Rights Commission.',
            'related_links' => [
                ['title' => 'Constitution of Uganda - Chapter 4', 'url' => 'https://ulii.org/ug/legislation/consolidated-act/0'],
                ['title' => 'Uganda Human Rights Commission', 'url' => 'https://uhrc.ug/'],
            ],
        ]);
    }
}
