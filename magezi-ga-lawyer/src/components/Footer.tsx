import { useState, useEffect } from 'react'
import { Link } from 'react-router-dom'
import { api } from '../services/api'

function Footer() {
  const [settings, setSettings] = useState<any>({})

  useEffect(() => {
    api.getSiteSettings()
      .then(data => setSettings(data || {}))
      .catch(console.error)
  }, [])
  return (
    <footer className="site-footer" role="contentinfo">
      <div className="footer-content">
        <div className="footer-section footer-brand">
          <div className="footer-logo">
            <span className="brand-mark">M</span>
            <div>
              <h3>Magezi ga Lawyer</h3>
              <p>Accessible legal guidance for every Ugandan</p>
            </div>
          </div>
          <p className="footer-tagline">
            {settings.footer_tagline || 'Bridging the gap between Ugandan citizens and the legal system since 2009. We believe that understanding your rights should never be complicated.'}
          </p>
        </div>

        <div className="footer-section footer-links">
          <h4>Quick Links</h4>
          <nav aria-label="Footer navigation">
            <ul>
              <li><Link to="/">Home</Link></li>
              <li><Link to="/practice-areas">Practice Areas</Link></li>
              <li><Link to="/about">About Us</Link></li>
              <li><Link to="/faq">FAQ</Link></li>
            </ul>
          </nav>
        </div>

        <div className="footer-section footer-contact">
          <h4>Contact Us</h4>
          <div className="contact-details">
            <div className="contact-detail-item">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" aria-hidden="true">
                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" />
              </svg>
              <a href={`tel:${settings.footer_phone?.replace(/\s/g, '') || '+256791862269'}`}>{settings.footer_phone || '+256 791 862 269'}</a>
            </div>
            <div className="contact-detail-item">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" aria-hidden="true">
                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                <polyline points="22,6 12,13 2,6" />
              </svg>
              <a href={`mailto:${settings.footer_email || 'info@magezi.ug'}`}>{settings.footer_email || 'info@magezi.ug'}</a>
            </div>
            <div className="contact-detail-item">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" aria-hidden="true">
                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
                <circle cx="12" cy="10" r="3" />
              </svg>
              <span>{settings.footer_address || 'Plot 15, Kampala Road, Kampala, Uganda'}</span>
            </div>
          </div>
        </div>

        <div className="footer-section footer-social">
          <h4>Follow Us</h4>
          <div className="social-links">
            <a href={settings.footer_facebook || 'https://facebook.com'} target="_blank" rel="noopener noreferrer" aria-label="Visit our Facebook page">
              <svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z" />
              </svg>
            </a>
            <a href={settings.footer_twitter || 'https://twitter.com'} target="_blank" rel="noopener noreferrer" aria-label="Visit our Twitter page">
              <svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                <path d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z" />
              </svg>
            </a>
            <a href={settings.footer_linkedin || 'https://linkedin.com'} target="_blank" rel="noopener noreferrer" aria-label="Visit our LinkedIn page">
              <svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z" />
                <rect x="2" y="9" width="4" height="12" />
                <circle cx="4" cy="4" r="2" />
              </svg>
            </a>
          </div>
        </div>
      </div>


      <div className="footer-bottom">
        <p>&copy; {new Date().getFullYear()} Magezi ga Lawyer. All rights reserved.</p>
        <p>{settings.footer_bottom_text || 'Empowering Ugandans with accessible legal knowledge.'}</p>
      </div>
    </footer>
  )
}

export default Footer
