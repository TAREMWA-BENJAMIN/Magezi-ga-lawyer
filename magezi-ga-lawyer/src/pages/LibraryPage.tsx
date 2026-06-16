import { Link } from 'react-router-dom'
import LegalLibrary from '../components/LegalLibrary'

function LibraryPage() {
  return (
    <div className="library-page">
      <section className="page-header">
        <nav className="breadcrumb" aria-label="Breadcrumb">
          <Link to="/">Home</Link>
          <span aria-hidden="true">›</span>
          <span aria-current="page">Legal Library</span>
        </nav>
        <h1>Legal Library</h1>
        <p>
          Browse our comprehensive collection of legal information, guides, and resources.
        </p>
      </section>
      <LegalLibrary />
    </div>
  )
}

export default LibraryPage
