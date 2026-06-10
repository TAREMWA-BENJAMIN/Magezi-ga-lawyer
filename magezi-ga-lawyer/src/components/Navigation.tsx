import { useState } from 'react'
import { Link, useLocation } from 'react-router-dom'
import { useLanguage } from '../contexts/LanguageContext'
import LanguageSwitcher from './LanguageSwitcher'

const navItems = [
  { path: '/', label: 'Home' },
  { path: '/practice-areas', label: 'Practice Areas' },
  { path: '/about', label: 'About' },
  { path: '/templates', label: 'Document Templates' },
]

function Navigation() {
  const { translate } = useLanguage()
  const location = useLocation()
  const [mobileOpen, setMobileOpen] = useState(false)

  const isActive = (path: string) => {
    if (path === '/') return location.pathname === '/'
    return location.pathname.startsWith(path)
  }

  return (
    <header className="app-nav" role="banner">
      <div className="nav-content">
        <Link to="/" className="brand" aria-label="Magezi ga Lawyer — Home">
          <span className="brand-mark">M</span>
          <div>
            <p className="brand-label">{translate('brand')}</p>
            <p className="brand-subtitle">Accessible legal support for Uganda</p>
          </div>
        </Link>

        <button
          type="button"
          className={`mobile-toggle ${mobileOpen ? 'open' : ''}`}
          onClick={() => setMobileOpen(!mobileOpen)}
          aria-label={mobileOpen ? 'Close navigation menu' : 'Open navigation menu'}
          aria-expanded={mobileOpen}
        >
          <span className="hamburger-line" />
          <span className="hamburger-line" />
          <span className="hamburger-line" />
        </button>

        <nav
          className={`nav-links ${mobileOpen ? 'open' : ''}`}
          aria-label="Primary navigation"
        >
          {navItems.map((item) => (
            <Link
              key={item.path}
              to={item.path}
              className={`nav-link ${isActive(item.path) ? 'active' : ''}`}
              onClick={() => setMobileOpen(false)}
              aria-current={isActive(item.path) ? 'page' : undefined}
            >
              {item.label}
            </Link>
          ))}
        </nav>

        <div className="nav-actions">
          <LanguageSwitcher />
          <Link
            to="/signin"
            id="nav-signin"
            className="nav-signin-link"
            aria-label="Sign in to your account"
            onClick={() => setMobileOpen(false)}
          >
            Sign In
          </Link>
          <Link
            to="/get-started"
            id="nav-get-started"
            className="nav-get-started"
            aria-label="Get started with Magezi ga Lawyer"
            onClick={() => setMobileOpen(false)}
          >
            Get Started <span aria-hidden="true">→</span>
          </Link>
        </div>
      </div>
    </header>
  )
}

export default Navigation
