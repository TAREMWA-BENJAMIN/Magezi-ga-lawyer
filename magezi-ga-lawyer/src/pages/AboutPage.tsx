import { Link } from 'react-router-dom'
import { useState, useEffect } from 'react'
import { api } from '../services/api'

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

interface TeamMember {
  id: number
  name: string
  role: string
  specialization: string
  bio: string
  image: string
  email: string
}

interface FirmStats {
  casesResolved: number
  yearsExperience: number
  teamMembers: number
  clientSatisfaction: number
  areasOfPractice: number
  documentsProcessed: number
}

function AboutPage() {
  const [team, setTeam] = useState<TeamMember[]>([])
  const [stats, setStats] = useState<FirmStats | null>(null)
  const [siteSettings, setSiteSettings] = useState<any>({})
  const [milestonesList, setMilestonesList] = useState<typeof milestones>([])
  const [valuesList, setValuesList] = useState<typeof values>([])

  useEffect(() => {
    api.getTeam().then(setTeam).catch(console.error)
    api.getStats().then(setStats).catch(console.error)
    api.getSiteSettings().then(setSiteSettings).catch(console.error)
    api.getMilestones().then(setMilestonesList).catch(console.error)
    api.getCoreValues().then(setValuesList).catch(console.error)
  }, [])

  return (
    <div className="about-page">
      {/* ── Page Header ── */}
      <section className="page-header">
        <nav className="breadcrumb" aria-label="Breadcrumb">
          <Link to="/">Home</Link>
          <span aria-hidden="true">›</span>
          <span aria-current="page">About Us</span>
        </nav>
        <h1>{siteSettings.about_header_title || 'About Magezi ga Lawyer'}</h1>
        <p>
          {siteSettings.about_header_text || 'Founded in 2005, Magezi ga Lawyer is one of Uganda\'s most trusted law firms — dedicated to making justice accessible, affordable, and effective for every Ugandan.'}
        </p>
      </section>

      {/* ── Stats Section ── */}
      {stats && (
        <section className="about-stats" style={{ display: 'grid', gridTemplateColumns: 'repeat(auto-fit, minmax(150px, 1fr))', gap: '20px', padding: '40px 20px', background: 'var(--surface)', borderRadius: '12px', margin: '20px', textAlign: 'center' }}>
          <div><h3 style={{ fontSize: '2rem', color: 'var(--primary)', marginBottom: '5px' }}>{stats.casesResolved}+</h3><p>Cases Resolved</p></div>
          <div><h3 style={{ fontSize: '2rem', color: 'var(--primary)', marginBottom: '5px' }}>{stats.yearsExperience}</h3><p>Years Experience</p></div>
          <div><h3 style={{ fontSize: '2rem', color: 'var(--primary)', marginBottom: '5px' }}>{stats.teamMembers}</h3><p>Team Members</p></div>
          <div><h3 style={{ fontSize: '2rem', color: 'var(--primary)', marginBottom: '5px' }}>{stats.clientSatisfaction}%</h3><p>Client Satisfaction</p></div>
        </section>
      )}

      {/* ── Mission & Vision ── */}
      <section className="about-mission">
        <div className="mission-grid">
          <article className="mission-card">
            <span className="mission-icon" aria-hidden="true">🎯</span>
            <h2>Our Mission</h2>
            <p>
              {siteSettings.about_mission_text || 'To provide expert, compassionate legal services that empower ordinary Ugandans to navigate the law with confidence — whether in court, in business, or in everyday life.'}
            </p>
          </article>
          <article className="mission-card">
            <span className="mission-icon" aria-hidden="true">🌟</span>
            <h2>Our Vision</h2>
            <p>
              {siteSettings.about_vision_text || 'A Uganda where no one is denied justice because of the complexity of the law or the cost of legal services. We envision a society where legal knowledge is a right, not a privilege.'}
            </p>
          </article>
        </div>
      </section>

      {/* ── Core Values ── */}
      <section className="about-values">
        <h2>Our Core Values</h2>
        <div className="values-grid">
          {(valuesList.length > 0 ? valuesList : values).map((v) => (
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
          {(milestonesList.length > 0 ? milestonesList : milestones).map((m) => (
            <li className="timeline-item" key={m.year}>
              <span className="timeline-year">{m.year}</span>
              <p className="timeline-event">{m.event}</p>
            </li>
          ))}
        </ol>
      </section>

      {/* ── Team Section ── */}
      {team.length > 0 && (
        <section className="about-team" style={{ padding: '60px 20px', maxWidth: '1200px', margin: '0 auto' }}>
          <h2 style={{ textAlign: 'center', marginBottom: '40px' }}>Meet Our Legal Team</h2>
          <div style={{ display: 'grid', gridTemplateColumns: 'repeat(auto-fit, minmax(300px, 1fr))', gap: '30px' }}>
            {team.map(member => (
              <article key={member.id} className="team-card" style={{ background: 'var(--surface)', borderRadius: '12px', overflow: 'hidden', boxShadow: '0 4px 6px rgba(0,0,0,0.05)' }}>
                <img src={member.image} alt={member.name} style={{ width: '100%', height: '250px', objectFit: 'cover' }} />
                <div style={{ padding: '20px' }}>
                  <h3 style={{ margin: '0 0 5px 0' }}>{member.name}</h3>
                  <p style={{ color: 'var(--primary)', fontWeight: 'bold', margin: '0 0 10px 0' }}>{member.role}</p>
                  <p style={{ fontSize: '0.9rem', color: 'var(--text-light)', marginBottom: '15px' }}><strong>Specialization:</strong> {member.specialization}</p>
                  <p style={{ fontSize: '0.9rem', lineHeight: '1.5' }}>{member.bio}</p>
                  <a href={`mailto:${member.email}`} style={{ display: 'inline-block', marginTop: '15px', color: 'var(--primary)', textDecoration: 'none', fontWeight: 'bold' }}>Contact {member.name.split(' ')[0]} →</a>
                </div>
              </article>
            ))}
          </div>
        </section>
      )}

    </div>
  )
}

export default AboutPage
