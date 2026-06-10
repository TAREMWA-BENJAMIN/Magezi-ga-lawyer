import { Link } from 'react-router-dom'

const practiceAreas = [
  {
    icon: '🏠',
    title: 'Property & Land Law',
    description:
      "Uganda's land tenure system is complex, with four distinct types: customary, freehold, mailo, and leasehold. Our property law team helps individuals, families, and communities navigate land ownership, transfers, and disputes with clarity and confidence.",
    services: [
      'Land title verification and transfer',
      'Boundary and neighbour disputes',
      'Landlord and tenant matters',
      'Mailo land and kibanja rights',
      'Compulsory acquisition and compensation',
      'Land fraud investigation and recovery',
    ],
  },
  {
    icon: '👨‍👩‍👧‍👦',
    title: 'Family Law',
    description:
      'Family law in Uganda intersects with customary, religious, and statutory systems. We guide you through marriage, separation, custody, and succession with sensitivity and deep cultural understanding.',
    services: [
      'Marriage registration and ceremonies',
      'Divorce and judicial separation',
      'Child custody and guardianship',
      'Maintenance and child support orders',
      'Adoption proceedings',
      'Succession and inheritance planning',
      'Domestic violence protection orders',
    ],
  },
  {
    icon: '⚖️',
    title: 'Criminal Law',
    description:
      'Whether you are accused, a victim, or a witness, understanding criminal procedures in Uganda is critical. We provide strong defence representation and guide victims through the justice system at every stage.',
    services: [
      'Bail applications and criminal defence',
      'Plea bargaining and case management',
      'Appeals and sentence reviews',
      'Police bond and rights at arrest',
      'Sexual and gender-based violence cases',
      'Cybercrime and fraud defence',
      'Juvenile justice proceedings',
    ],
  },
  {
    icon: '💼',
    title: 'Employment Law',
    description:
      "Uganda's Employment Act 2006 and related statutes provide important protections for workers. We help both employees and employers understand their obligations and resolve workplace disputes effectively.",
    services: [
      'Employment contract review and drafting',
      'Unfair dismissal claims',
      'Workplace discrimination and harassment',
      'Labour tribunal representation',
      'Occupational safety compliance',
      'Pension and terminal benefits disputes',
      'Trade union and collective bargaining matters',
    ],
  },
  {
    icon: '🏢',
    title: 'Commercial Law',
    description:
      "From start-ups to established businesses, navigating Uganda's regulatory landscape requires specialised legal knowledge. We support businesses with registration, compliance, contracts, and dispute resolution.",
    services: [
      'Company registration and incorporation',
      'Commercial contract drafting and review',
      'Trade and intellectual property disputes',
      'Tax compliance and advisory',
      'Mergers, acquisitions, and partnerships',
      'Regulatory and licensing compliance',
      'Debt recovery and insolvency proceedings',
    ],
  },
]

function PracticeAreasPage() {
  return (
    <div className="practice-areas-page">
      {/* ── Page Header ── */}
      <section className="page-header">
        <nav className="breadcrumb" aria-label="Breadcrumb">
          <Link to="/">Home</Link>
          <span aria-hidden="true">›</span>
          <span aria-current="page">Practice Areas</span>
        </nav>
        <h1>Our Practice Areas</h1>
        <p>
          We provide expert legal services across the areas of law most relevant
          to everyday Ugandans. Each practice area is staffed by experienced
          lawyers committed to accessible, affordable, and effective representation.
        </p>
      </section>

      {/* ── Practice Area Cards ── */}
      <section className="practice-grid" aria-label="Practice areas">
        {practiceAreas.map((area) => (
          <article className="practice-area-card" key={area.title}>
            <div className="practice-card-header">
              <span className="practice-icon" aria-hidden="true">{area.icon}</span>
              <h2>{area.title}</h2>
            </div>
            <p>{area.description}</p>
            <div className="practice-services">
              <h3>Key Services</h3>
              <ul>
                {area.services.map((service) => (
                  <li key={service}>{service}</li>
                ))}
              </ul>
            </div>
            <Link to="/contact" className="hero-button">
              Enquire About {area.title.split(' ')[0]} Law
            </Link>
          </article>
        ))}
      </section>

      {/* ── CTA ── */}
      <section className="cta-section">
        <div className="cta-content">
          <h2>Not Sure Which Area Applies to You?</h2>
          <p>
            Legal matters often overlap multiple areas. Contact us for a free initial
            consultation and we'll point you in the right direction.
          </p>
          <Link className="hero-button" to="/contact">
            Get a Free Consultation
          </Link>
        </div>
      </section>
    </div>
  )
}

export default PracticeAreasPage
