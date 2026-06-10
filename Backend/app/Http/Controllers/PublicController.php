<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublicController extends Controller
{
    /**
     * Returns JSON array of lawyer profiles for public display
     */
    public function team()
    {
        return response()->json([
            [
                'id' => 1,
                'name' => 'John Mukasa',
                'role' => 'Managing Partner & Senior Advocate',
                'specialization' => 'Property Law & Land Disputes',
                'bio' => 'John Mukasa is a seasoned advocate with over 15 years of experience in Ugandan property law. He has successfully represented clients in landmark land disputes across the Central and Eastern regions. John holds an LLB from Makerere University and an LLM from the University of London.',
                'image' => 'https://ui-avatars.com/api/?name=John+Mukasa&size=300&background=0f4d85&color=fff',
                'email' => 'john@magezi.ug',
            ],
            [
                'id' => 2,
                'name' => 'Sarah Nakambi',
                'role' => 'Senior Advocate',
                'specialization' => 'Commercial & Corporate Law',
                'bio' => 'Sarah Nakambi specializes in commercial law, corporate governance, and business advisory services. With a decade of practice, she has advised numerous SMEs and multinational corporations on Ugandan regulatory compliance and contract negotiations.',
                'image' => 'https://ui-avatars.com/api/?name=Sarah+Nakambi&size=300&background=0c6f57&color=fff',
                'email' => 'sarah@magezi.ug',
            ],
            [
                'id' => 3,
                'name' => 'Grace Okonkwo',
                'role' => 'Legal Aid Officer & Family Law Specialist',
                'specialization' => 'Family Law & Gender-Based Violence',
                'bio' => 'Grace Okonkwo is a passionate advocate for family justice and women\'s rights in Uganda. She has handled hundreds of custody, divorce, and domestic violence cases, providing compassionate legal support to vulnerable communities through pro bono initiatives.',
                'image' => 'https://ui-avatars.com/api/?name=Grace+Okonkwo&size=300&background=b8232f&color=fff',
                'email' => 'grace@magezi.ug',
            ],
            [
                'id' => 4,
                'name' => 'David Osei',
                'role' => 'Associate Advocate',
                'specialization' => 'Employment & Labour Law',
                'bio' => 'David Osei focuses on employment law, workers\' rights, and labour dispute resolution. He has represented both employers and employees in unfair dismissal claims, workplace discrimination cases, and collective bargaining agreements.',
                'image' => 'https://ui-avatars.com/api/?name=David+Osei&size=300&background=8b5cf6&color=fff',
                'email' => 'david@magezi.ug',
            ],
            [
                'id' => 5,
                'name' => 'Peter Banda',
                'role' => 'Advocate & Criminal Defense Specialist',
                'specialization' => 'Criminal Law & Human Rights',
                'bio' => 'Peter Banda is a dedicated criminal defense advocate with extensive courtroom experience. He has represented clients in high-profile criminal cases across Uganda, specializing in bail applications, plea bargaining, and appellate advocacy.',
                'image' => 'https://ui-avatars.com/api/?name=Peter+Banda&size=300&background=f59e0b&color=fff',
                'email' => 'peter@magezi.ug',
            ],
            [
                'id' => 6,
                'name' => 'Amina Otieno',
                'role' => 'Legal Aid Officer & Community Outreach Lead',
                'specialization' => 'Legal Aid & Community Justice',
                'bio' => 'Amina Otieno leads community legal outreach programs across rural Uganda, ensuring access to justice for underserved populations. She specializes in legal literacy, alternative dispute resolution, and community mediation services.',
                'image' => 'https://ui-avatars.com/api/?name=Amina+Otieno&size=300&background=06b6d4&color=fff',
                'email' => 'amina@magezi.ug',
            ],
        ]);
    }

    /**
     * Returns JSON array of practice areas
     */
    public function practiceAreas()
    {
        return response()->json([
            [
                'id' => 1,
                'title' => 'Property Law',
                'slug' => 'property-law',
                'description' => 'We provide comprehensive legal services for property and land matters across Uganda. Our team handles land acquisitions, boundary disputes, title transfers, and tenancy agreements with deep knowledge of Ugandan land tenure systems.',
                'icon' => 'Building2',
                'features' => [
                    'Land title verification and registration',
                    'Boundary and ownership dispute resolution',
                    'Lease and tenancy agreement drafting',
                    'Property conveyancing and transfers',
                    'Customary land rights protection',
                ],
            ],
            [
                'id' => 2,
                'title' => 'Family Law',
                'slug' => 'family-law',
                'description' => 'Our family law practice provides compassionate and effective legal representation in all domestic matters. We handle divorce, child custody, adoption, inheritance disputes, and protection orders with sensitivity and expertise.',
                'icon' => 'Users',
                'features' => [
                    'Divorce and separation proceedings',
                    'Child custody and guardianship',
                    'Adoption and fostering applications',
                    'Inheritance and succession disputes',
                    'Domestic violence protection orders',
                ],
            ],
            [
                'id' => 3,
                'title' => 'Criminal Law',
                'slug' => 'criminal-law',
                'description' => 'We offer robust criminal defense and prosecution support services. Our advocates have extensive courtroom experience representing clients in all levels of Ugandan courts, from Magistrate Courts to the Supreme Court.',
                'icon' => 'Shield',
                'features' => [
                    'Criminal defense representation',
                    'Bail and bond applications',
                    'Plea bargaining and negotiations',
                    'Appeals and judicial review',
                    'Human rights and constitutional cases',
                ],
            ],
            [
                'id' => 4,
                'title' => 'Employment Law',
                'slug' => 'employment-law',
                'description' => 'We protect the rights of both employers and employees under Ugandan labour legislation. Our practice covers unfair dismissal claims, workplace discrimination, contract disputes, and regulatory compliance advisory.',
                'icon' => 'Briefcase',
                'features' => [
                    'Employment contract drafting and review',
                    'Unfair dismissal and redundancy claims',
                    'Workplace discrimination and harassment',
                    'Labour dispute mediation and arbitration',
                    'Regulatory compliance and HR advisory',
                ],
            ],
            [
                'id' => 5,
                'title' => 'Commercial Law',
                'slug' => 'commercial-law',
                'description' => 'Our commercial law team advises businesses of all sizes on corporate governance, contract negotiations, regulatory compliance, and dispute resolution. We help Ugandan enterprises navigate complex legal landscapes and grow with confidence.',
                'icon' => 'Scale',
                'features' => [
                    'Company incorporation and registration',
                    'Commercial contract negotiation',
                    'Corporate governance advisory',
                    'Intellectual property protection',
                    'Mergers, acquisitions, and partnerships',
                ],
            ],
        ]);
    }

    /**
     * Returns public-safe statistics
     */
    public function stats()
    {
        return response()->json([
            'casesResolved' => 1200,
            'yearsExperience' => 15,
            'teamMembers' => 6,
            'clientSatisfaction' => 98,
            'areasOfPractice' => 5,
            'documentsProcessed' => 3000,
        ]);
    }

    /**
     * Returns JSON array of FAQs about Ugandan legal topics
     */
    public function faq()
    {
        return response()->json([
            [
                'id' => 1,
                'question' => 'How do I verify land ownership in Uganda?',
                'answer' => 'Land ownership in Uganda can be verified by conducting a search at the relevant District Land Office or the Ministry of Lands, Housing and Urban Development. You will need the plot number and the area/block details. Our team can assist you with official land title searches and due diligence to ensure the property is free from encumbrances.',
            ],
            [
                'id' => 2,
                'question' => 'What are the grounds for divorce in Uganda?',
                'answer' => 'Under the Divorce Act of Uganda, grounds for divorce include adultery, cruelty (both physical and mental), desertion for at least two years, and a combination of these grounds. For Muslim marriages, provisions under the Marriage and Divorce of Mohammedans Act apply. We recommend consulting with our family law specialists for guidance specific to your situation.',
            ],
            [
                'id' => 3,
                'question' => 'What are my rights if I am arrested in Uganda?',
                'answer' => 'Under the Constitution of Uganda, you have the right to remain silent, the right to be informed of the reason for your arrest, the right to legal representation, the right to be brought before a court within 48 hours, and the right not to be tortured or subjected to cruel treatment. If you or a loved one has been arrested, contact us immediately for legal assistance.',
            ],
            [
                'id' => 4,
                'question' => 'How does inheritance work under Ugandan law?',
                'answer' => 'Inheritance in Uganda is governed by the Succession Act, which provides for both testate (with a will) and intestate (without a will) succession. Under intestate succession, the surviving spouse, children, and dependants are entitled to specified shares of the estate. Customary law may also apply depending on the community. Our family law team can guide you through probate and estate administration.',
            ],
            [
                'id' => 5,
                'question' => 'What should I do if I am unfairly dismissed from my job?',
                'answer' => 'If you believe you have been unfairly dismissed, you should first gather evidence of your employment terms and the circumstances of your dismissal. Under the Employment Act 2006, you may be entitled to compensation or reinstatement. You can file a complaint with the Labour Officer in your district or pursue a case through the Industrial Court. Our employment law specialists can help you assess your claim and represent your interests.',
            ],
            [
                'id' => 6,
                'question' => 'How do I register a business in Uganda?',
                'answer' => 'Business registration in Uganda is done through the Uganda Registration Services Bureau (URSB). You will need to reserve a company name, prepare a memorandum and articles of association, and submit incorporation documents. The process typically takes 2-5 working days. Our commercial law team can handle the entire registration process on your behalf and advise on the most suitable business structure.',
            ],
            [
                'id' => 7,
                'question' => 'What is the difference between freehold and leasehold land in Uganda?',
                'answer' => 'Uganda recognizes four land tenure systems: freehold, leasehold, mailo, and customary. Freehold grants the holder ownership in perpetuity, while leasehold is granted for a specified period (usually 49 or 99 years). Mailo land is unique to Buganda and grants ownership in perpetuity similar to freehold. Customary tenure is governed by local customs and traditions. Each system has different legal implications for ownership, transfer, and development.',
            ],
            [
                'id' => 8,
                'question' => 'Can I get legal aid if I cannot afford a lawyer?',
                'answer' => 'Yes, Uganda has several legal aid programs. The Justice Law and Order Sector (JLOS) provides legal aid through various organizations. Additionally, Magezi Ga Lawyer offers pro bono services and reduced-fee consultations for qualifying individuals. Our Legal Aid Officers can assess your eligibility and connect you with the appropriate resources to ensure access to justice.',
            ],
            [
                'id' => 9,
                'question' => 'How long does a typical court case take in Uganda?',
                'answer' => 'The duration of court cases in Uganda varies significantly depending on the type of case, court level, and complexity. Simple civil matters may be resolved within 3-6 months, while complex commercial or criminal cases can take 1-3 years or more. Alternative dispute resolution methods such as mediation and arbitration can significantly reduce resolution time. Our team works efficiently to minimize delays and keep you informed throughout the process.',
            ],
            [
                'id' => 10,
                'question' => 'What protection exists for women\'s property rights in Uganda?',
                'answer' => 'The Constitution of Uganda guarantees equal rights for women, including property ownership. The Land Act provides that decisions regarding family land require consent of both spouses. Women can own, buy, and sell property independently. However, enforcement challenges remain, especially in rural areas where customary practices may conflict with statutory law. Our team has extensive experience advocating for women\'s property rights and can provide specialized legal support.',
            ],
        ]);
    }

    /**
     * Validates and returns success response for contact form
     */
    public function contactSubmit(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'phone'   => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:5000',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Thank you for contacting Magezi Ga Lawyer. We have received your message and will respond within 24-48 hours.',
            'reference' => 'REF-' . strtoupper(substr(md5(now()->toISOString()), 0, 8)),
        ], 201);
    }

    /**
     * Returns expanded library items across all practice areas
     */
    public function library()
    {
        return response()->json([
            [
                'id' => 1,
                'title' => 'Understanding Land Tenure Systems in Uganda',
                'category' => 'Property Law',
                'summary' => 'A comprehensive guide to the four land tenure systems recognized under the Ugandan Constitution and Land Act.',
                'content' => 'Uganda recognizes four distinct land tenure systems: Freehold, Leasehold, Mailo, and Customary. Freehold tenure grants the holder registered ownership in perpetuity, allowing full rights to use, develop, and transfer the land. Leasehold tenure is granted for a specified period, typically 49 or 99 years, and is common for urban and government-allocated land. Mailo tenure, unique to the Buganda Kingdom, was established under the 1900 Buganda Agreement and grants ownership in perpetuity similar to freehold, but with a distinction between landowners (mailo owners) and lawful/bona fide occupants. Customary tenure is governed by the rules and customs of the community where the land is located, and is the most prevalent form of land ownership in rural Uganda. The Land Act of 1998 and its amendments provide the legal framework for the administration and management of all land tenure types.',
                'relatedLinks' => [
                    ['title' => 'The Land Act 1998', 'url' => 'https://ulii.org/ug/legislation/consolidated-act/227'],
                    ['title' => 'Ministry of Lands Uganda', 'url' => 'https://mlhud.go.ug/'],
                ],
            ],
            [
                'id' => 2,
                'title' => 'Your Rights During Arrest and Detention',
                'category' => 'Criminal Law',
                'summary' => 'Know your constitutional rights if you are arrested or detained by Ugandan authorities.',
                'content' => 'The Constitution of Uganda under Article 23 provides comprehensive protections for persons who are arrested or detained. Every person arrested has the right to be informed immediately of the reason for the arrest. You have the right to a lawyer of your choice, and if you cannot afford one, the state is obligated to provide legal representation in cases involving serious offences. You must be brought before a court within 48 hours of arrest. You have the right to apply for bail, which may be granted at the discretion of the court. You cannot be subjected to torture, cruel, inhuman, or degrading treatment. Any statement obtained through coercion is inadmissible in court. The Police must keep proper records of arrests and detentions. If your rights are violated, you may file a complaint with the Uganda Human Rights Commission.',
                'relatedLinks' => [
                    ['title' => 'Constitution of Uganda - Chapter 4', 'url' => 'https://ulii.org/ug/legislation/consolidated-act/0'],
                    ['title' => 'Uganda Human Rights Commission', 'url' => 'https://uhrc.ug/'],
                ],
            ],
            [
                'id' => 3,
                'title' => 'Guide to Marriage and Divorce Laws in Uganda',
                'category' => 'Family Law',
                'summary' => 'An overview of the legal framework governing marriage, separation, and divorce in Uganda.',
                'content' => 'Uganda recognizes several forms of marriage: civil marriage under the Marriage Act, church marriages, Hindu marriages, and Islamic marriages under the Marriage and Divorce of Mohammedans Act. Customary marriages are also recognized. The Divorce Act, which primarily applies to civil and church marriages, sets out grounds for divorce including adultery, cruelty, and desertion. For Islamic marriages, divorce provisions are governed by Islamic law. In all cases, the court considers the welfare of children first when making custody decisions. Property acquired during marriage is considered matrimonial property and is subject to equitable distribution. The court may also award maintenance to either spouse. It is advisable to seek legal counsel early in any divorce proceedings to protect your rights and interests.',
                'relatedLinks' => [
                    ['title' => 'The Marriage Act', 'url' => 'https://ulii.org/ug/legislation/consolidated-act/251'],
                    ['title' => 'The Divorce Act', 'url' => 'https://ulii.org/ug/legislation/consolidated-act/249'],
                ],
            ],
            [
                'id' => 4,
                'title' => 'Employment Rights Under Ugandan Labour Law',
                'category' => 'Employment Law',
                'summary' => 'Essential information about employee rights, contracts, and workplace protections under the Employment Act 2006.',
                'content' => 'The Employment Act 2006 is the principal legislation governing employment relationships in Uganda. It provides for minimum terms and conditions of employment, including working hours (not exceeding 48 hours per week), paid annual leave (minimum 7 working days), sick leave, and maternity leave (60 working days). Employers must provide written contracts for employment lasting more than six months. The Act prohibits unfair dismissal and requires employers to follow due process including written notice and an opportunity for the employee to be heard. Workers are entitled to severance pay upon termination after serving for at least six months. Discrimination based on race, sex, religion, or disability is prohibited. The Labour Disputes (Arbitration and Settlement) Act provides mechanisms for resolving workplace disputes through mediation and the Industrial Court.',
                'relatedLinks' => [
                    ['title' => 'Employment Act 2006', 'url' => 'https://ulii.org/ug/legislation/act/2006/6'],
                    ['title' => 'Ministry of Gender, Labour and Social Development', 'url' => 'https://mglsd.go.ug/'],
                ],
            ],
            [
                'id' => 5,
                'title' => 'Starting a Business: Legal Requirements in Uganda',
                'category' => 'Commercial Law',
                'summary' => 'Step-by-step guide to the legal requirements for registering and operating a business in Uganda.',
                'content' => 'Starting a business in Uganda requires compliance with several legal requirements. First, you must register your business with the Uganda Registration Services Bureau (URSB). For a company, you need to reserve a name, prepare a memorandum and articles of association, and file incorporation documents. Sole proprietorships and partnerships are registered under the Business Names Registration Act. After registration, you must obtain a Tax Identification Number (TIN) from the Uganda Revenue Authority (URA) and register for applicable taxes including VAT if your turnover exceeds UGX 150 million per year. Depending on your business type, you may need specific licenses from sector regulators. Employment of staff requires compliance with the Employment Act, NSSF contributions, and health and safety regulations. Our commercial law team provides end-to-end support for business formation and ongoing compliance advisory.',
                'relatedLinks' => [
                    ['title' => 'URSB - Uganda Registration Services Bureau', 'url' => 'https://ursb.go.ug/'],
                    ['title' => 'Uganda Revenue Authority', 'url' => 'https://ura.go.ug/'],
                ],
            ],
            [
                'id' => 6,
                'title' => 'Child Custody and Guardianship in Uganda',
                'category' => 'Family Law',
                'summary' => 'Understanding how Ugandan courts determine child custody and guardianship arrangements.',
                'content' => 'Child custody in Uganda is governed primarily by the Children Act, which places the welfare of the child as the paramount consideration. Courts consider multiple factors when determining custody including the age of the child, the emotional and physical needs, the ability of each parent to provide care, and the wishes of the child (if old enough to express them). Mothers of children under the age of seven are generally given preference under what is known as the "tender years doctrine," although this is not absolute. Joint custody arrangements are possible and increasingly common. Guardianship may be granted to non-parents where it serves the child\'s best interests. The court may also issue access orders to ensure the non-custodial parent maintains a relationship with the child. Our family law team provides sensitive and effective representation in all custody matters.',
                'relatedLinks' => [
                    ['title' => 'The Children Act', 'url' => 'https://ulii.org/ug/legislation/consolidated-act/59'],
                    ['title' => 'UNICEF Uganda', 'url' => 'https://www.unicef.org/uganda/'],
                ],
            ],
            [
                'id' => 7,
                'title' => 'Bail and Bond Applications in Ugandan Criminal Courts',
                'category' => 'Criminal Law',
                'summary' => 'A guide to understanding bail and bond rights and the application process in Uganda.',
                'content' => 'Bail is a constitutional right under Article 23(6) of the Ugandan Constitution. For offences triable by the High Court, an accused person is entitled to apply for bail after spending 120 days on remand without trial. For offences triable by subordinate courts, the period is 60 days. Bail may be granted on conditions including reporting to police, surrendering travel documents, and providing sureties. The court considers factors such as the seriousness of the offence, the likelihood of the accused absconding, and the potential for interference with witnesses. Police bond is available at police stations before a suspect is charged in court. Cash bail and non-cash bail options are available. Our criminal law team has extensive experience in securing bail for clients and can guide you through the process efficiently.',
                'relatedLinks' => [
                    ['title' => 'The Trial on Indictments Act', 'url' => 'https://ulii.org/ug/legislation/consolidated-act/23'],
                    ['title' => 'Judiciary of Uganda', 'url' => 'https://judiciary.go.ug/'],
                ],
            ],
            [
                'id' => 8,
                'title' => 'Intellectual Property Protection in Uganda',
                'category' => 'Commercial Law',
                'summary' => 'How to protect trademarks, patents, copyrights, and trade secrets under Ugandan law.',
                'content' => 'Intellectual property (IP) in Uganda is protected through several legislative instruments. Trademarks are registered under the Trademarks Act with URSB, granting the holder exclusive rights to use the mark for renewable periods of seven years. Patents and utility models are registered under the Industrial Property Act, providing protection for inventions for up to 20 years. Copyright protection is automatic upon creation of the work under the Copyright and Neighbouring Rights Act, but registration with URSB provides additional evidentiary benefits. Trade secrets are protected under common law principles of confidentiality. Uganda is also a member of the World Intellectual Property Organization (WIPO) and the African Regional Intellectual Property Organization (ARIPO). Our commercial law team can assist with IP registration, enforcement, licensing, and dispute resolution to safeguard your creative and business assets.',
                'relatedLinks' => [
                    ['title' => 'URSB - Intellectual Property', 'url' => 'https://ursb.go.ug/intellectual-property/'],
                    ['title' => 'WIPO Uganda', 'url' => 'https://www.wipo.int/directory/en/details.jsp?country_code=UG'],
                ],
            ],
        ]);
    }
}
