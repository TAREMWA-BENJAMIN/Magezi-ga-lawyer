import './App.css'
import { CaseProvider } from './contexts/CaseContext'
import { LanguageProvider } from './contexts/LanguageContext'
import Navigation from './components/Navigation'
import HeroSection from './components/HeroSection'
import LegalLibrary from './components/LegalLibrary'
import TemplateFormBuilder from './components/TemplateFormBuilder'
import CaseTracker from './components/CaseTracker'

function App() {
  return (
    <LanguageProvider>
      <CaseProvider>
        <div className="app-shell">
          <Navigation />
          <main>
            <HeroSection />
            <LegalLibrary />
            <TemplateFormBuilder />
            <CaseTracker />
            <section className="contact-section" id="contact">
              <div>
                <p className="eyebrow">Support with confidence</p>
                <h2>Stay grounded with a trusted path to legal help.</h2>
                <p>
                  Magezi ga Lawyer is built for clarity and ease. If you need
                  more help, use the Emergency Help button or contact a local
                  lawyer for advice.
                </p>
              </div>
              <div className="contact-card">
                <p>Emergency support line</p>
                <strong>+256 700 123 456</strong>
                <a className="hero-button" href="tel:+256700123456">
                  Call now
                </a>
              </div>
            </section>
          </main>
        </div>
      </CaseProvider>
    </LanguageProvider>
  )
}

export default App
