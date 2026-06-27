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



    </div>
  )
}

export default AboutPage
