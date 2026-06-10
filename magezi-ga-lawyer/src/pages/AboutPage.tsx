import { Link } from 'react-router-dom'

const milestones = [
  { year: '2005', event: 'Firm founded by Babirye Catherine Magezi in Kampala with a focus on property and land law.' },
  { year: '2009', event: 'Expanded into criminal and family law, adding two senior partners to the team.' },
  { year: '2013', event: 'Opened a second office in Jinja to serve clients in eastern Uganda.' },
  { year: '2016', event: 'Launched the Community Legal Aid Clinic, providing pro bono services to underserved communities.' },
  { year: '2019', event: 'Introduced the online legal library — Uganda\'s first free public legal resource hub.' },
  { year: '2022', event: 'Recognised by the Uganda Law Society as a leading firm in access to justice initiatives.' },
  { year: '2024', event: 'Launched the digital document templates service to empower Ugandans to self-draft basic legal documents.' },
]

const values = [
  {
    icon: '⚖️',
    title: 'Justice for All',
    description: 'We believe that every Ugandan, regardless of income or background, deserves access to quality legal representation.',
  },
  {
    icon: '🤝',
    title: 'Integrity',
    description: 'We act with honesty and transparency in every client relationship, upholding the highest ethical standards of the legal profession.',
  },
  {
    icon: '🌍',
    title: 'Community First',
    description: 'Our roots are in the communities we serve. We measure success not just in court victories but in lives improved.',
  },
  {
    icon: '📚',
    title: 'Continuous Learning',
    description: 'Uganda\'s legal landscape evolves. We invest in ongoing education to stay at the forefront of the law for our clients.',
  },
]

function AboutPage() {
  return (
    <div className="about-page">
      {/* ── Page Header ── */}
      <section className="page-header">
        <nav className="breadcrumb" aria-label="Breadcrumb">
          <Link to="/">Home</Link>
          <span aria-hidden="true">›</span>
          <span aria-current="page">About Us</span>
        </nav>
        <h1>About Magezi ga Lawyer</h1>
        <p>
          Founded in 2005, Magezi ga Lawyer is one of Uganda's most trusted law firms —
          dedicated to making justice accessible, affordable, and effective for every Ugandan.
        </p>
      </section>

      {/* ── Mission & Vision ── */}
      <section className="about-mission">
        <div className="mission-grid">
          <article className="mission-card">
            <span className="mission-icon" aria-hidden="true">🎯</span>
            <h2>Our Mission</h2>
            <p>
              To provide expert, compassionate legal services that empower ordinary Ugandans to
              navigate the law with confidence — whether in court, in business, or in everyday life.
            </p>
          </article>
          <article className="mission-card">
            <span className="mission-icon" aria-hidden="true">🌟</span>
            <h2>Our Vision</h2>
            <p>
              A Uganda where no one is denied justice because of the complexity of the law or the
              cost of legal services. We envision a society where legal knowledge is a right, not a privilege.
            </p>
          </article>
        </div>
      </section>

      {/* ── Our Story ── */}
      <section className="about-story">
        <h2>Our Story</h2>
        <p>
          Magezi ga Lawyer was born out of a simple but powerful idea: that Ugandans deserve a law
          firm that truly understands their lives. Our founder, Babirye Catherine Magezi, grew up
          witnessing families torn apart by land disputes they could not afford to fight in court.
          She established this firm with the conviction that legal expertise should serve people —
          not intimidate them.
        </p>
        <p>
          Over nearly two decades, we have grown from a one-partner office on Kampala Road to a
          multi-disciplinary firm with specialists across property, family, criminal, employment,
          and commercial law. Yet our founding ethos has never changed: put the client first,
          speak plainly, and fight tirelessly for justice.
        </p>
      </section>

      {/* ── Core Values ── */}
      <section className="about-values">
        <h2>Our Core Values</h2>
        <div className="values-grid">
          {values.map((v) => (
            <article className="value-card" key={v.title}>
              <span className="value-icon" aria-hidden="true">{v.icon}</span>
              <h3>{v.title}</h3>
              <p>{v.description}</p>
            </article>
          ))}
        </div>
      </section>

      {/* ── Timeline ── */}
      <section className="about-timeline">
        <h2>Our Journey</h2>
        <ol className="timeline-list">
          {milestones.map((m) => (
            <li className="timeline-item" key={m.year}>
              <span className="timeline-year">{m.year}</span>
              <p className="timeline-event">{m.event}</p>
            </li>
          ))}
        </ol>
      </section>

      {/* ── CTA ── */}
      <section className="cta-section">
        <div className="cta-content">
          <h2>Ready to Work With Us?</h2>
          <p>
            Meet our team, explore our practice areas, or contact us today for a free initial consultation.
          </p>
          <div className="cta-buttons">
            <Link className="hero-button" to="/team">Meet Our Team</Link>
            <Link className="hero-button hero-button--outline" to="/contact">Contact Us</Link>
          </div>
        </div>
      </section>
    </div>
  )
}

export default AboutPage
