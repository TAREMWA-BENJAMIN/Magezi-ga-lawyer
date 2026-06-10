import { useState, useEffect } from 'react'
import { Link } from 'react-router-dom'
import { api } from '../services/api'

interface LibraryItem {
  id: string
  title: string
  category: string
  summary: string
  content?: string
}

const staticLibraryItems: LibraryItem[] = [
  {
    id: 'land-rights',
    title: 'Understanding Land Ownership in Uganda',
    category: 'Property',
    summary: 'A guide to the four land tenure systems in Uganda — customary, freehold, mailo, and leasehold — and what each means for your rights.',
    content: 'Uganda recognises four land tenure systems under the 1995 Constitution and the Land Act. Customary tenure is the most widespread, especially in northern and eastern Uganda, and is based on the norms and practices of the community. Freehold grants the holder full ownership rights in perpetuity. Mailo tenure, unique to the Buganda region, separates land ownership from occupancy rights, which often leads to disputes between registered owners and lawful/bona fide occupants (bibanja holders). Leasehold is a contractual tenure granted for a specified period. Understanding which system applies to your land is the first step to protecting your rights.',
  },
  {
    id: 'family-law-basics',
    title: 'Family Law Basics in Uganda',
    category: 'Family',
    summary: 'Marriage, divorce, custody, and inheritance — understand your family rights under Ugandan statutory and customary law.',
    content: 'Family law in Uganda is governed by multiple legal systems — the Marriage Act, the Divorce Act, the Succession Act, and various customary and religious marriage laws. A valid marriage can be contracted under civil, customary, Hindu, or Islamic rites. Divorce procedures depend on the type of marriage. Child custody decisions are always guided by the best interests of the child under the Children Act. Inheritance is governed by the Succession Act, which provides for distribution of estate among the spouse, children, and dependants of the deceased. Customary inheritance practices also apply in many regions but cannot override constitutional rights.',
  },
  {
    id: 'criminal-rights',
    title: 'Your Rights When Arrested',
    category: 'Criminal',
    summary: 'What to do if you are arrested or detained by police in Uganda — your constitutional rights explained clearly.',
    content: 'Under the 1995 Constitution of Uganda, every arrested person has fundamental rights. You must be informed immediately of the reason for your arrest. You have the right to a lawyer of your choice, and if you cannot afford one, the state must provide one for capital offences. You must be brought before a court within 48 hours of arrest (or 24 hours in the case of a minor). You cannot be compelled to confess or incriminate yourself. Police must provide you with a police bond for bailable offences. If these rights are violated, you may apply to the High Court for enforcement under Article 50 of the Constitution.',
  },
  {
    id: 'employment-contracts',
    title: 'Employment Contracts & Worker Rights',
    category: 'Employment',
    summary: 'Know your rights as an employee in Uganda — contracts, working hours, leave, termination, and labour tribunal complaints.',
    content: 'The Employment Act 2006 is the primary law governing employment relationships in Uganda. Every employer must provide a written contract within 12 weeks of engagement. The Act sets the maximum working hours at 48 per week, provides for annual leave of 7 working days, and mandates sick leave of one month on full pay and one month on half pay. Termination must be with notice (or payment in lieu) and for a valid reason. Unfair dismissal includes termination based on pregnancy, trade union membership, or filing a workplace complaint. Disputes can be referred to the Industrial Court under the Labour Disputes (Arbitration and Settlement) Act.',
  },
  {
    id: 'business-registration',
    title: 'Registering a Business in Uganda',
    category: 'Commercial',
    summary: 'Step-by-step guide to registering a company, business name, or NGO with the Uganda Registration Services Bureau.',
    content: 'To register a business in Uganda, you must first decide on the business structure — sole proprietorship, partnership, or limited company. Business names and companies are registered with the Uganda Registration Services Bureau (URSB). For a company, you need to prepare a Memorandum and Articles of Association, reserve a company name, and file incorporation documents. The process typically takes 2-5 working days. After registration, you must obtain a Tax Identification Number (TIN) from the Uganda Revenue Authority, and depending on your business type, additional licences from KCCA or the relevant district local government.',
  },
  {
    id: 'domestic-violence',
    title: 'Protection from Domestic Violence',
    category: 'Family',
    summary: 'Understand the Domestic Violence Act 2010 and how to obtain a protection order if you or your family members are at risk.',
    content: 'The Domestic Violence Act 2010 defines domestic violence as any act that harms or endangers the health, safety, or well-being of a person in a domestic relationship. This includes physical, sexual, emotional, verbal, psychological, and economic abuse. Victims can apply for a Protection Order from a Magistrate\'s Court, which may prohibit the abuser from entering the home, contacting the victim, or committing further violence. Breach of a protection order is a criminal offence. The Act also provides for compensation to victims and requires police to assist victims in accessing medical treatment and safe shelter.',
  },
  {
    id: 'tenant-rights',
    title: 'Tenant Rights & Eviction Law',
    category: 'Property',
    summary: 'What tenants in Uganda need to know about rental agreements, rent increases, and lawful eviction procedures.',
    content: 'Tenants in Uganda are protected by several laws, including the Landlord and Tenant Act (for commercial premises) and general contract law principles for residential tenancies. A landlord must give reasonable notice before evicting a tenant — typically corresponding to the rental period (monthly tenants receive one month\'s notice). Evictions must be carried out lawfully; self-help evictions (changing locks, removing property, cutting off utilities) are illegal. Disputes can be taken to the Rent Restriction Tribunal in Kampala or to the local Magistrate\'s Court in other areas. Rent increases must also follow reasonable notice periods.',
  },
  {
    id: 'will-writing',
    title: 'How to Write a Valid Will in Uganda',
    category: 'Family',
    summary: 'A practical guide to creating a legally valid will under Ugandan law to protect your family and assets.',
    content: 'Under the Succession Act (Cap 162), a valid will in Uganda must be in writing, signed by the testator (or someone in their presence and by their direction), and witnessed by at least two competent witnesses who also sign the will. The testator must be of sound mind and at least 21 years old. Important: Ugandan law limits testamentary freedom — a testator cannot disinherit a spouse, children, or dependants entirely. At least a portion of the estate must go to these dependants. Wills can be deposited at the High Court for safekeeping. It\'s advisable to seek legal assistance to ensure your will is valid and covers all your assets.',
  },
]

const categories = ['All', 'Property', 'Family', 'Criminal', 'Employment', 'Commercial']

function LegalLibraryPage() {
  const [items, setItems] = useState<LibraryItem[]>(staticLibraryItems)
  const [selectedCategory, setSelectedCategory] = useState('All')
  const [searchQuery, setSearchQuery] = useState('')
  const [selectedItem, setSelectedItem] = useState<LibraryItem | null>(null)

  useEffect(() => {
    api.getLibrary()
      .then((data: LibraryItem[]) => {
        if (Array.isArray(data) && data.length > 0) {
          setItems(data)
        }
      })
      .catch(() => {
        // API unavailable — continue using static data
      })
  }, [])

  const filteredItems = items.filter((item) => {
    const matchesCategory = selectedCategory === 'All' || item.category === selectedCategory
    const matchesSearch =
      searchQuery === '' ||
      item.title.toLowerCase().includes(searchQuery.toLowerCase()) ||
      item.summary.toLowerCase().includes(searchQuery.toLowerCase())
    return matchesCategory && matchesSearch
  })

  return (
    <div className="library-page">
      {/* ── Page Header ── */}
      <section className="page-header">
        <nav className="breadcrumb" aria-label="Breadcrumb">
          <Link to="/">Home</Link>
          <span aria-hidden="true">›</span>
          <span aria-current="page">Legal Library</span>
        </nav>
        <h1>Legal Information Library</h1>
        <p>
          Browse our collection of plain-language legal guides covering the most common
          legal issues faced by Ugandans. Search by topic or filter by category.
        </p>
        <div className="library-search">
          <input
            type="search"
            placeholder="Search legal guides — e.g. 'land rights', 'divorce', 'employee contract'"
            value={searchQuery}
            onChange={(e) => setSearchQuery(e.target.value)}
            aria-label="Search legal library"
          />
        </div>
      </section>

      {/* ── Category Filters ── */}
      <div className="library-filters" role="tablist" aria-label="Filter by category">
        {categories.map((cat) => (
          <button
            key={cat}
            type="button"
            role="tab"
            className={`filter-tab ${selectedCategory === cat ? 'active' : ''}`}
            onClick={() => {
              setSelectedCategory(cat)
              setSelectedItem(null)
            }}
            aria-selected={selectedCategory === cat}
          >
            {cat}
          </button>
        ))}
      </div>

      {/* ── Library Grid ── */}
      {selectedItem ? (
        <section className="library-card-detail" aria-label="Article detail">
          <button
            type="button"
            className="back-button"
            onClick={() => setSelectedItem(null)}
          >
            ← Back to Library
          </button>
          <article>
            <span className="detail-category">{selectedItem.category}</span>
            <h2>{selectedItem.title}</h2>
            <p className="detail-summary">{selectedItem.summary}</p>
            <div className="detail-content">
              <p>{selectedItem.content || selectedItem.summary}</p>
            </div>
            <div className="detail-disclaimer">
              <p>
                <strong>Disclaimer:</strong> This information is for general guidance only
                and does not constitute legal advice. For advice specific to your situation,
                please <Link to="/contact">contact a lawyer</Link>.
              </p>
            </div>
          </article>
        </section>
      ) : (
        <section className="library-items-grid" aria-label="Library articles">
          {filteredItems.length > 0 ? (
            filteredItems.map((item) => (
              <article
                className="library-card"
                key={item.id}
                onClick={() => setSelectedItem(item)}
                onKeyDown={(e) => e.key === 'Enter' && setSelectedItem(item)}
                tabIndex={0}
                role="button"
                aria-label={`Read more about ${item.title}`}
              >
                <span className="library-card-category">{item.category}</span>
                <h3>{item.title}</h3>
                <p>{item.summary}</p>
                <span className="card-link">Read Full Guide →</span>
              </article>
            ))
          ) : (
            <div className="no-results">
              <h3>No guides found</h3>
              <p>Try adjusting your search terms or browse a different category.</p>
            </div>
          )}
        </section>
      )}
    </div>
  )
}

export default LegalLibraryPage
