import { useLanguage } from '../contexts/LanguageContext'
import LanguageSwitcher from './LanguageSwitcher'

function Navigation() {
  const { translate } = useLanguage()

  return (
    <header className="app-nav" role="banner">
      <div className="nav-content">
        <div className="brand">
          <span className="brand-mark">M</span>
          <div>
            <p className="brand-label">{translate('brand')}</p>
            <p className="brand-subtitle">Accessible legal support for Uganda</p>
          </div>
        </div>

        <nav aria-label="Primary navigation">
          <a href="#library">{translate('legalLibrary')}</a>
          <a href="#contact">Contact</a>
        </nav>

        <div className="nav-actions">
          <LanguageSwitcher />
          <a
            className="quick-exit"
            href=""
            target="_blank"
            rel="noreferrer noopener"
          >
            {translate('quickExit')}
          </a>
        </div>
      </div>
    </header>
  )
}

export default Navigation
