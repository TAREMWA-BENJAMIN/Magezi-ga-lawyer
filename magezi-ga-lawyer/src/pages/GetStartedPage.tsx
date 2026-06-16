import { useState } from 'react'
import { Link, useNavigate } from 'react-router-dom'
import { api } from '../services/api'
import authBg from '../assets/auth_legal_bg.png'

type Step = 1 | 2 | 3 | 4

interface PersonalForm {
  firstName: string
  lastName: string
  email: string
  phone: string
  password: string
  confirm: string
}

interface MatterForm {
  area: string
  description: string
  urgency: string
}

function GetStartedPage() {
  const navigate = useNavigate()
  const [currentStep, setCurrentStep] = useState<Step>(1)
  const [personal, setPersonal] = useState<PersonalForm>({
    firstName: '', lastName: '', email: '', phone: '', password: '', confirm: '',
  })
  const [matter, setMatter] = useState<MatterForm>({
    area: '', description: '', urgency: 'standard',
  })
  const [submitting, setSubmitting] = useState(false)
  const [error, setError] = useState('')

  const handlePersonalChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    setPersonal({ ...personal, [e.target.name]: e.target.value })
  }

  const handleMatterChange = (e: React.ChangeEvent<HTMLSelectElement | HTMLTextAreaElement | HTMLInputElement>) => {
    setMatter({ ...matter, [e.target.name]: e.target.value })
  }

  const handleStep1 = (e: React.FormEvent) => {
    e.preventDefault()
    if (personal.password !== personal.confirm) {
      setError('Passwords do not match.')
      return
    }
    setError('')
    setCurrentStep(2)
    window.scrollTo({ top: 0, behavior: 'smooth' })
  }

  const handleStep2 = async (e: React.FormEvent) => {
    e.preventDefault()
    setSubmitting(true)
    setError('')
    try {
      await api.register({
        firstName: personal.firstName,
        lastName: personal.lastName,
        email: personal.email,
        phone: personal.phone,
        password: personal.password,
        area: matter.area,
        description: matter.description,
        urgency: matter.urgency
      })
      setSubmitting(false)
      navigate('/signin')
    } catch (err: any) {
      setSubmitting(false)
      setError(err.message || 'Failed to register. Please try again.')
    }
  }

  return (
    <div className="auth-page">
      <div className="auth-container">
        {/* ── Left Decorative Panel ── */}
        <aside className="auth-panel" aria-hidden="true">
          <div className="auth-panel-header">
            <h2 className="auth-panel-title">Start Your Legal Journey</h2>
            <p className="auth-panel-subtitle">World-class professional legal services & counseling.</p>
          </div>

          <ul className="auth-panel-benefits">
            <li>
              <span className="benefit-icon">✓</span>
              <span>Secure client portal & documents</span>
            </li>
            <li>
              <span className="benefit-icon">✓</span>
              <span>Real-time case updates & tracking</span>
            </li>
            <li>
              <span className="benefit-icon">✓</span>
              <span>Direct matching with specialized lawyers</span>
            </li>
          </ul>

          <div className="auth-panel-footer">
            <p className="auth-panel-brand">Magezi ga Lawyer - Professional Legal Services</p>
            <p className="auth-panel-tagline">Join thousands of clients who have resolved their legal challenges with us.</p>
          </div>

          <img src={authBg} className="auth-panel-illustration" alt="Office desk illustration" />
        </aside>

        {/* ── Form Card ── */}
        <div className="auth-card">
          {/* ── Circular Brand logo ── */}
          <div className="auth-brand-circular">
            <div className="auth-brand-circle">
              <span className="auth-brand-circle-m">M</span>
            </div>
            <div className="auth-brand-text">
              <p className="auth-brand-title">Magezi ga Lawyer</p>
              <p className="auth-brand-subtitle">Accessible legal support for Uganda</p>
            </div>
          </div>

          {/* Progress dots */}
          <div className="auth-step-indicators">
            <div className={`step-dot ${currentStep === 1 ? 'active' : ''} ${currentStep > 1 ? 'completed' : ''}`}>1</div>
            <div className={`step-dot ${currentStep === 2 ? 'active' : ''} ${currentStep > 2 ? 'completed' : ''}`}>2</div>
            <div className={`step-dot ${currentStep === 3 ? 'active' : ''} ${currentStep > 3 ? 'completed' : ''}`}>3</div>
            <div className={`step-dot ${currentStep === 4 ? 'active' : ''}`}>4</div>
          </div>

          {error && (
            <div className="auth-error" role="alert">
              <span aria-hidden="true">⚠️</span> {error}
            </div>
          )}

          {/* ── Step 1: Personal Details ── */}
          {currentStep === 1 && (
            <>
              <h1 className="auth-title">Welcome to Magezi ga Lawyer!</h1>
              <p className="auth-subtitle">Let's set up your account</p>

              {/* Google sign-up button placeholder */}
              <button type="button" className="google-auth-btn">
                <svg className="google-icon" viewBox="0 0 24 24" width="16" height="16">
                  <path fill="#4285F4" d="M23.745 12.27c0-.7-.06-1.4-.19-2.07H12v3.92h6.69a5.74 5.74 0 0 1-2.48 3.77v3.12h4.02c2.34-2.16 3.69-5.32 3.69-8.74z"/>
                  <path fill="#34A853" d="M12 24c3.24 0 5.97-1.08 7.96-2.91l-4.02-3.12c-1.12.75-2.54 1.19-3.94 1.19-3.04 0-5.61-2.05-6.53-4.82H1.33v3.2A11.98 11.98 0 0 0 12 24z"/>
                  <path fill="#FBBC05" d="M5.47 14.34a7.16 7.16 0 0 1 0-4.68V6.46H1.33a11.98 11.98 0 0 0 0 11.08l4.14-3.2z"/>
                  <path fill="#EA4335" d="M12 4.75c1.77 0 3.35.61 4.6 1.8l3.43-3.43A11.93 11.93 0 0 0 12 0 11.98 11.98 0 0 0 1.33 6.46l4.14 3.2c.92-2.77 3.49-4.82 6.53-4.82z"/>
                </svg>
                <span>Sign up with Google</span>
              </button>

              <div className="auth-divider"><span>or</span></div>

              <form className="auth-form" onSubmit={handleStep1} noValidate>
                <div className="form-row">
                  <div className="form-group">
                    <label htmlFor="gs-firstName">First Name *</label>
                    <input
                      id="gs-firstName"
                      name="firstName"
                      type="text"
                      required
                      placeholder="e.g. Nakato"
                      value={personal.firstName}
                      onChange={handlePersonalChange}
                    />
                  </div>
                  <div className="form-group">
                    <label htmlFor="gs-lastName">Last Name *</label>
                    <input
                      id="gs-lastName"
                      name="lastName"
                      type="text"
                      required
                      placeholder="e.g. Aisha"
                      value={personal.lastName}
                      onChange={handlePersonalChange}
                    />
                  </div>
                </div>
                <div className="form-group">
                  <label htmlFor="gs-email">Email Address *</label>
                  <input
                    id="gs-email"
                    name="email"
                    type="email"
                    required
                    placeholder="Enter your email address"
                    value={personal.email}
                    onChange={handlePersonalChange}
                  />
                </div>
                <div className="form-group">
                  <label htmlFor="gs-phone">Phone Number</label>
                  <input
                    id="gs-phone"
                    name="phone"
                    type="tel"
                    placeholder="+256 7XX XXX XXX"
                    value={personal.phone}
                    onChange={handlePersonalChange}
                  />
                </div>
                <div className="form-row">
                  <div className="form-group">
                    <label htmlFor="gs-password">Password *</label>
                    <input
                      id="gs-password"
                      name="password"
                      type="password"
                      required
                      placeholder="Min. 8 characters"
                      value={personal.password}
                      onChange={handlePersonalChange}
                    />
                  </div>
                  <div className="form-group">
                    <label htmlFor="gs-confirm">Confirm Password *</label>
                    <input
                      id="gs-confirm"
                      name="confirm"
                      type="password"
                      required
                      placeholder="Repeat password"
                      value={personal.confirm}
                      onChange={handlePersonalChange}
                    />
                  </div>
                </div>
                <button id="gs-next" type="submit" className="auth-submit-btn">
                  Continue <span aria-hidden="true">→</span>
                </button>
              </form>
            </>
          )}

          {/* ── Step 2: Legal Matter ── */}
          {currentStep === 2 && (
            <>
              <h1 className="auth-title">Tell us about your matter</h1>
              <p className="auth-subtitle">This helps us match you with the right specialist</p>
              <form className="auth-form" onSubmit={handleStep2} noValidate>
                <div className="form-group">
                  <label htmlFor="gs-area">Practice Area *</label>
                  <select
                    id="gs-area"
                    name="area"
                    required
                    value={matter.area}
                    onChange={handleMatterChange}
                  >
                    <option value="">Select an area…</option>
                    <option>Property &amp; Land Law</option>
                    <option>Family Law</option>
                    <option>Criminal Law</option>
                    <option>Employment Law</option>
                    <option>Commercial Law</option>
                    <option>Not sure / General advice</option>
                  </select>
                </div>
                <div className="form-group">
                  <label htmlFor="gs-description">Brief Description *</label>
                  <textarea
                    id="gs-description"
                    name="description"
                    required
                    rows={4}
                    placeholder="Describe your situation in a few sentences…"
                    value={matter.description}
                    onChange={handleMatterChange}
                  />
                </div>
                <div className="form-group">
                  <label>Urgency Level</label>
                  <div className="urgency-options">
                    {[
                      { value: 'urgent', label: '🔴 Urgent (within 24 hours)' },
                      { value: 'soon', label: '🟡 Soon (within a week)' },
                      { value: 'standard', label: '🟢 Standard (flexible)' },
                    ].map((opt) => (
                      <label key={opt.value} className="urgency-option">
                        <input
                          type="radio"
                          name="urgency"
                          value={opt.value}
                          checked={matter.urgency === opt.value}
                          onChange={handleMatterChange}
                        />
                        <span>{opt.label}</span>
                      </label>
                    ))}
                  </div>
                </div>
                <div className="auth-form-actions">
                  <button
                    type="button"
                    className="auth-back-btn"
                    onClick={() => setCurrentStep(1)}
                  >
                    ← Back
                  </button>
                  <button
                    id="gs-submit"
                    type="submit"
                    className="auth-submit-btn"
                    disabled={submitting}
                  >
                    {submitting ? 'Submitting…' : 'Submit & Match →'}
                  </button>
                </div>
              </form>
            </>
          )}

          <p className="auth-switch">
            Already have an account?{' '}
            <Link to="/signin" className="auth-switch-link">Sign In</Link>
          </p>
        </div>
      </div>
    </div>
  )
}

export default GetStartedPage

