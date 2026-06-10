import { useState } from 'react'
import { Link } from 'react-router-dom'

interface FAQ {
  id: string
  category: string
  question: string
  answer: string
}

const faqs: FAQ[] = [
  // Property & Land Law
  {
    id: 'pl-1',
    category: 'Property & Land Law',
    question: 'What are the different types of land tenure in Uganda?',
    answer:
      'Uganda recognises four land tenure systems: (1) Mailo — registered ownership found mainly in central Uganda; (2) Freehold — outright ownership of land and buildings; (3) Leasehold — land leased from government or a private owner for a fixed period; and (4) Customary — communal ownership governed by local customs. Each type carries different rights, restrictions, and transfer procedures. Our property lawyers can advise you on which tenure applies to your land.',
  },
  {
    id: 'pl-2',
    category: 'Property & Land Law',
    question: 'My landlord wants to evict me. What are my rights?',
    answer:
      'Under the Landlord and Tenant Act 2022, a tenant cannot be evicted without a proper notice period (usually 1–3 months depending on the tenancy agreement) and, in most cases, a court order. Your landlord cannot unlawfully evict you by changing locks, removing your belongings, or cutting utilities. If you face unlawful eviction, contact us immediately — we can apply for an urgent injunction to protect your tenancy.',
  },
  {
    id: 'pl-3',
    category: 'Property & Land Law',
    question: 'How do I transfer land ownership in Uganda?',
    answer:
      'Transferring land requires: (1) Conducting a search at the Land Registry to confirm ownership and check for encumbrances; (2) Drafting and signing a sale agreement; (3) Paying applicable stamp duty and capital gains tax; (4) Registering the transfer at the Zonal Land Office. The process typically takes 1–3 months. Our lawyers can handle the entire process on your behalf to avoid costly mistakes.',
  },
  // Family Law
  {
    id: 'fl-1',
    category: 'Family Law',
    question: 'How do I file for divorce in Uganda?',
    answer:
      'Divorce in Uganda is governed by the Divorce Act. A spouse can file for divorce on grounds including adultery, cruelty, or desertion for at least two years. You must file a petition in the High Court. The process involves serving the other spouse, filing affidavits, and attending hearings. The entire process can take 6–24 months depending on complexity and whether it is contested. We strongly recommend legal representation to protect your rights regarding property and children.',
  },
  {
    id: 'fl-2',
    category: 'Family Law',
    question: 'Who gets custody of children after separation?',
    answer:
      'Ugandan courts apply the "best interests of the child" principle. Factors considered include: the child\'s age (young children are often placed with the mother), each parent\'s ability to provide care, the child\'s own wishes (if old enough), and any history of domestic violence or substance abuse. Joint custody arrangements are increasingly common. Our family lawyers can help negotiate a custody agreement or represent you in contested custody proceedings.',
  },
  {
    id: 'fl-3',
    category: 'Family Law',
    question: 'What is a domestic violence protection order and how do I get one?',
    answer:
      'Under the Domestic Violence Act 2010, victims of domestic violence can apply for a Protection Order at the magistrate\'s court nearest to them. This order legally prohibits the abuser from contacting or approaching you. An interim order can be granted on the same day in urgent cases. You do not need the abuser\'s consent or to file criminal charges first. Contact us urgently if you are in danger — we can assist with emergency applications.',
  },
  // Criminal Law
  {
    id: 'cr-1',
    category: 'Criminal Law',
    question: 'What should I do if I am arrested?',
    answer:
      'You have the right to: (1) Remain silent — you are not obliged to answer police questions beyond providing your name and address; (2) Be told the reason for your arrest; (3) Be brought before a court within 48 hours (or 72 hours for serious offences); (4) Contact a lawyer immediately. Do not sign any documents without legal advice. Contact Magezi ga Lawyer as soon as possible — we provide emergency legal assistance for persons in custody.',
  },
  {
    id: 'cr-2',
    category: 'Criminal Law',
    question: 'Can I get bail if I am charged with a criminal offence?',
    answer:
      'Most offences in Uganda are bailable, except capital offences (murder, aggravated robbery, terrorism, treason). For bailable offences, the police or court may grant bail upon application. The court considers factors such as your community ties, whether you are a flight risk, and the seriousness of the offence. Our criminal lawyers have extensive experience making successful bail applications and will act quickly to secure your release.',
  },
  // Employment Law
  {
    id: 'el-1',
    category: 'Employment Law',
    question: 'I was dismissed without notice. What can I do?',
    answer:
      'Under the Employment Act 2006, an employer must give notice of termination (minimum 1 month for employees paid monthly) unless terminating for gross misconduct after a fair hearing. If you were dismissed without notice and without cause, you may be entitled to: payment in lieu of notice, severance pay (if employed for 6+ months), and compensation for unfair dismissal. You must file a complaint with the Labour Officer or Industrial Court within 3 years. Contact us early to preserve your evidence and rights.',
  },
  // Commercial Law
  {
    id: 'cl-1',
    category: 'Commercial Law',
    question: 'How do I register a company in Uganda?',
    answer:
      'To register a private limited company in Uganda: (1) Reserve your company name with the Uganda Registration Services Bureau (URSB); (2) Prepare a Memorandum and Articles of Association; (3) Submit incorporation forms and pay the registration fee; (4) Obtain a Certificate of Incorporation; (5) Register for tax with URA and obtain a Tax Identification Number (TIN); (6) Open a business bank account. The process typically takes 5–10 business days. Our commercial lawyers can handle the entire process and ensure full compliance.',
  },
  // General
  {
    id: 'gen-1',
    category: 'General',
    question: 'How much does a consultation cost?',
    answer:
      'Your first consultation with Magezi ga Lawyer is completely free of charge and without obligation. This allows us to understand your situation and advise you on the best course of action. Subsequent fees depend on the complexity of your matter and are discussed transparently upfront. We also offer flexible payment plans and pro bono services for qualifying individuals who cannot afford legal fees.',
  },
  {
    id: 'gen-2',
    category: 'General',
    question: 'Do you offer services in languages other than English?',
    answer:
      'Yes. Our team includes lawyers and staff who are fluent in Luganda, Runyankore, Lusoga, Ateso, and Acholi. We are committed to ensuring that language is never a barrier to accessing legal help. Please let us know your preferred language when you contact us and we will match you with an appropriate team member.',
  },
]

const categories = Array.from(new Set(faqs.map((f) => f.category)))

function FAQPage() {
  const [activeCategory, setActiveCategory] = useState<string>('All')
  const [openId, setOpenId] = useState<string | null>(null)

  const filtered = activeCategory === 'All' ? faqs : faqs.filter((f) => f.category === activeCategory)

  const toggle = (id: string) => setOpenId(openId === id ? null : id)

  return (
    <div className="faq-page">
      {/* ── Page Header ── */}
      <section className="page-header">
        <nav className="breadcrumb" aria-label="Breadcrumb">
          <Link to="/">Home</Link>
          <span aria-hidden="true">›</span>
          <span aria-current="page">FAQs</span>
        </nav>
        <h1>Frequently Asked Questions</h1>
        <p>
          Answers to the legal questions Ugandans ask us most often — written in plain language,
          not legalese.
        </p>
      </section>

      {/* ── Category Filter ── */}
      <section className="faq-filters" aria-label="Filter FAQs by category">
        <div className="filter-tabs" role="tablist">
          {['All', ...categories].map((cat) => (
            <button
              key={cat}
              role="tab"
              aria-selected={activeCategory === cat}
              className={`filter-tab ${activeCategory === cat ? 'filter-tab--active' : ''}`}
              onClick={() => setActiveCategory(cat)}
            >
              {cat}
            </button>
          ))}
        </div>
      </section>

      {/* ── FAQ Accordion ── */}
      <section className="faq-list" aria-label="FAQ list">
        {filtered.map((faq) => (
          <article
            key={faq.id}
            className={`faq-item ${openId === faq.id ? 'faq-item--open' : ''}`}
          >
            <button
              className="faq-question"
              aria-expanded={openId === faq.id}
              onClick={() => toggle(faq.id)}
            >
              <span>{faq.question}</span>
              <span className="faq-chevron" aria-hidden="true">
                {openId === faq.id ? '▲' : '▼'}
              </span>
            </button>
            {openId === faq.id && (
              <div className="faq-answer">
                <span className="faq-category-badge">{faq.category}</span>
                <p>{faq.answer}</p>
              </div>
            )}
          </article>
        ))}
      </section>

      {/* ── CTA ── */}
      <section className="cta-section">
        <div className="cta-content">
          <h2>Didn't Find Your Answer?</h2>
          <p>
            Our legal team is happy to answer your specific question in a free initial consultation.
          </p>
          <Link className="hero-button" to="/contact">Ask a Lawyer</Link>
        </div>
      </section>
    </div>
  )
}

export default FAQPage
