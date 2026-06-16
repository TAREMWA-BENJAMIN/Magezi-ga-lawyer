import { Link } from 'react-router-dom'
import './ActsPage.css'

const acts = [
  {
    id: 1,
    title: 'The Land Act, 1998',
    description: 'An Act to provide for the tenure, ownership and management of land in Uganda.',
    year: '1998',
    fileSize: '2.4 MB'
  },
  {
    id: 2,
    title: 'The Contracts Act, 2010',
    description: 'An Act to amend and consolidate the law relating to contracts.',
    year: '2010',
    fileSize: '1.8 MB'
  },
  {
    id: 3,
    title: 'The Employment Act, 2006',
    description: 'An Act to revise and consolidate the laws governing individual employment relationships.',
    year: '2006',
    fileSize: '3.1 MB'
  },
  {
    id: 4,
    title: 'The Constitution of the Republic of Uganda, 1995',
    description: 'The supreme law of Uganda, establishing the framework for government and citizens\' rights.',
    year: '1995',
    fileSize: '5.6 MB'
  },
  {
    id: 5,
    title: 'The Penal Code Act',
    description: 'An Act to establish a code of criminal law.',
    year: '1950',
    fileSize: '4.2 MB'
  },
  {
    id: 6,
    title: 'The Companies Act, 2012',
    description: 'An Act to provide for the incorporation, regulation and administration of companies.',
    year: '2012',
    fileSize: '3.9 MB'
  }
];

function ActsPage() {
  return (
    <div className="acts-page">
      <section className="page-header">
        <nav className="breadcrumb" aria-label="Breadcrumb">
          <Link to="/">Home</Link>
          <span aria-hidden="true">›</span>
          <span aria-current="page">Client Portal</span>
        </nav>
        <h1>Legal Acts & Documents</h1>
        <p>
          Welcome to your client portal. Here you can securely access, read, and download important legal acts and case documents.
        </p>
      </section>

      <section className="acts-section">
        <div className="acts-grid">
          {acts.map((act) => (
            <div key={act.id} className="act-card">
              <div className="act-card-header">
                <div className="act-icon">
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                    <polyline points="14 2 14 8 20 8"></polyline>
                    <line x1="16" y1="13" x2="8" y2="13"></line>
                    <line x1="16" y1="17" x2="8" y2="17"></line>
                    <polyline points="10 9 9 9 8 9"></polyline>
                  </svg>
                </div>
                <span className="act-year">{act.year}</span>
              </div>
              <h3 className="act-title">{act.title}</h3>
              <p className="act-description">{act.description}</p>
              <div className="act-actions">
                <button className="btn-read" onClick={() => alert(`Opening PDF for ${act.title}`)}>
                  Read PDF
                </button>
                <span className="act-size">{act.fileSize}</span>
              </div>
            </div>
          ))}
        </div>
      </section>
    </div>
  )
}

export default ActsPage
