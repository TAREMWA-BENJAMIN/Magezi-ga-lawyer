import { useLanguage } from '../contexts/LanguageContext'

function HeroSection() {
  const { translate } = useLanguage()

  return (
    <section className="hero-panel">
      <div className="hero-copy">
        <span className="eyebrow">Law made simple</span>
        <h1>Accessible legal guidance for every Ugandan.</h1>
        <p>
          Magezi ga Lawyer helps you find trusted legal information, build easy
          document templates, and track your case status in a calm, readable
          interface.
        </p>
        <div className="hero-actions">
          <a className="hero-button" href="#library">
            Explore the library
          </a>
          <a className="hero-secondary" href="#templates">
            Build a document
          </a>
        </div>
      </div>
      <div className="hero-panel-card">
        <p className="card-label">{translate('legalLibrary')}</p>
        <h2>Quick legal reference for everyday issues</h2>
        <p>
          Find clear summaries of common topics like land rights, contracts,
          family law, and business guidance.
        </p>
      </div>
    </section>
  )
}

export default HeroSection
