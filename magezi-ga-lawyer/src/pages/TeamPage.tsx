import { useState, useEffect } from 'react'
import { Link } from 'react-router-dom'
import { api } from '../services/api'

interface TeamMember {
  id: string
  name: string
  role: string
  specializations: string[]
  bio: string
  email: string
  initials: string
  color: string
}

const staticTeam: TeamMember[] = [
  {
    id: '1',
    name: 'Babirye Catherine Magezi',
    role: 'Managing Partner',
    specializations: ['Property Law', 'Land Disputes', 'Constitutional Law'],
    bio: 'Catherine founded Magezi ga Lawyer with a vision to make legal services accessible to ordinary Ugandans. With over 18 years of experience in property and constitutional law, she has successfully represented hundreds of clients in land disputes and has been instrumental in shaping land tenure policy advocacy in Uganda.',
    email: 'catherine@magezi.ug',
    initials: 'BM',
    color: '#1a5276',
  },
  {
    id: '2',
    name: 'Ssemakula James Okiria',
    role: 'Senior Partner — Criminal Law',
    specializations: ['Criminal Defence', 'Human Rights', 'Juvenile Justice'],
    bio: 'James brings 15 years of courtroom experience to the team. A passionate advocate for the rights of the accused, he has handled some of the most complex criminal cases in Uganda, including high-profile fraud and human rights cases. He also runs pro bono clinics for juvenile offenders.',
    email: 'james@magezi.ug',
    initials: 'SO',
    color: '#7b241c',
  },
  {
    id: '3',
    name: 'Namubiru Peace Atuhaire',
    role: 'Partner — Family Law',
    specializations: ['Family Law', 'Child Custody', 'Domestic Violence'],
    bio: 'Peace is an advocate for families and children. She specialises in divorce, custody, and domestic violence protection orders. A trained mediator, she often helps families resolve disputes amicably before they reach court, saving time, money, and emotional strain.',
    email: 'peace@magezi.ug',
    initials: 'NA',
    color: '#1e8449',
  },
  {
    id: '4',
    name: 'Mukiibi Robert Kalumba',
    role: 'Associate — Employment Law',
    specializations: ['Employment Law', 'Labour Disputes', 'Workplace Safety'],
    bio: "Robert focuses on protecting workers' rights. He has extensive experience before the Industrial Court and regularly advises both employees and employers on contract compliance, unfair dismissal, and occupational health standards. He previously worked with the National Organisation of Trade Unions (NOTU).",
    email: 'robert@magezi.ug',
    initials: 'MK',
    color: '#6c3483',
  },
  {
    id: '5',
    name: 'Acheng Margaret Laker',
    role: 'Associate — Commercial Law',
    specializations: ['Commercial Law', 'Company Registration', 'Tax Advisory'],
    bio: 'Margaret supports businesses of all sizes with company incorporation, contract drafting, regulatory compliance, and tax planning. Originally from Gulu, she is passionate about enabling entrepreneurship in northern Uganda and has helped register over 200 SMEs.',
    email: 'margaret@magezi.ug',
    initials: 'AL',
    color: '#b7950b',
  },
  {
    id: '6',
    name: 'Okwi Daniel Emuria',
    role: 'Legal Officer — Community Outreach',
    specializations: ['Legal Aid', 'Community Law', 'ADR & Mediation'],
    bio: 'Daniel leads our community outreach programme, conducting legal awareness workshops in underserved communities across Uganda. Fluent in Ateso, Luganda, and English, he bridges language barriers to ensure that every Ugandan can access legal knowledge regardless of their background.',
    email: 'daniel@magezi.ug',
    initials: 'OE',
    color: '#2e86c1',
  },
]

function TeamPage() {
  const [team, setTeam] = useState<TeamMember[]>(staticTeam)

  useEffect(() => {
    api.getTeam()
      .then((data: TeamMember[]) => {
        if (Array.isArray(data) && data.length > 0) {
          setTeam(data)
        }
      })
      .catch(() => {
        // API unavailable — continue with static data
      })
  }, [])

  return (
    <div className="team-page">
      {/* ── Page Header ── */}
      <section className="page-header">
        <nav className="breadcrumb" aria-label="Breadcrumb">
          <Link to="/">Home</Link>
          <span aria-hidden="true">›</span>
          <span aria-current="page">Our Team</span>
        </nav>
        <h1>Meet Our Legal Team</h1>
        <p>
          Our team of experienced Ugandan lawyers is dedicated to making legal services
          accessible, affordable, and effective. Each member brings deep expertise and
          a genuine commitment to justice.
        </p>
      </section>

      {/* ── Team Grid ── */}
      <section className="team-grid" aria-label="Team members">
        {team.map((member) => (
          <article className="team-card" key={member.id}>
            <div className="team-avatar" style={{ backgroundColor: member.color }}>
              <span>{member.initials}</span>
            </div>
            <div className="team-info">
              <h2>{member.name}</h2>
              <p className="team-role">{member.role}</p>
              <div className="team-specializations">
                {member.specializations.map((spec) => (
                  <span className="specialization-tag" key={spec}>{spec}</span>
                ))}
              </div>
              <p className="team-bio">{member.bio}</p>
              <a href={`mailto:${member.email}`} className="team-email">
                {member.email}
              </a>
            </div>
          </article>
        ))}
      </section>

      {/* ── Join CTA ── */}
      <section className="cta-section">
        <div className="cta-content">
          <h2>Want to Work With Us?</h2>
          <p>
            We're always looking for talented lawyers who share our mission of making
            justice accessible. Reach out to discuss opportunities.
          </p>
          <Link className="hero-button" to="/contact">
            Get in Touch
          </Link>
        </div>
      </section>
    </div>
  )
}

export default TeamPage
