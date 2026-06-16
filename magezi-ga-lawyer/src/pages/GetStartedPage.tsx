import { useState, useEffect } from 'react'
import { Link, useNavigate } from 'react-router-dom'
import { api } from '../services/api'

const defaultSteps = [
  { id: 1, title: 'Create your account', desc: 'Fill in your personal details to open your free client account.' },
  { id: 2, title: 'Describe your matter', desc: 'Tell us briefly about the legal issue you need help with.' },
  { id: 3, title: 'Get matched', desc: "We'll connect you with the right specialist from our team." },
  { id: 4, title: 'Free consultation', desc: 'Speak with your assigned lawyer at no charge to get started.' },
]

type Step = 1 | 2

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
  const [steps, setSteps] = useState(defaultSteps)

  useEffect(() => {
    api.getSiteSettings()
      .then(settings => {
        if (settings.get_started_steps) {
          try {
            setSteps(JSON.parse(settings.get_started_steps))
          } catch (e) {
            console.error('Failed to parse get_started_steps', e)
          }
        }
      })
      .catch(console.error)
  }, [])

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
    <div className="auth-page auth-page--get-started">
      {/* ── Left Panel ── */}
      <aside className="auth-panel" aria-hidden="true">
        <div className="auth-panel-content">
          <h2>Start your legal journey in 4 simple steps</h2>
          <ol className="gs-steps">
            {steps.map((s) => (
              <li
                key={s.id}
                className={`gs-step ${s.id <= currentStep ? 'gs-step--active' : ''}`}
              >
                <span className="gs-step-num">{s.id}</span>
                <div>
                  <strong>{s.title}</strong>
                  <p>{s.desc}</p>
                </div>
              </li>
            ))}
          </ol>
          <p className="auth-panel-note">✓ No commitment required · Free initial consultation</p>
        </div>
      </aside>

      {/* ── Form Card ── */}
      <div className="auth-card">
        <div className="auth-brand">
          <span className="auth-brand-mark">M</span>
          <div>
            <p className="auth-brand-name">Magezi ga Lawyer</p>
            <p className="auth-brand-sub">New Client Registration</p>
          </div>
        </div>

        {/* Progress bar */}
        <div className="gs-progress" aria-label={`Step ${currentStep} of 2`}>
          <div className="gs-progress-track">
            <div
              className="gs-progress-fill"
              style={{ width: currentStep === 1 ? '50%' : '100%' }}
            />
          </div>
          <span className="gs-progress-label">Step {currentStep} of 2</span>
        </div>

        {error && (
          <div className="auth-error" role="alert">
            <span aria-hidden="true">⚠️</span> {error}
          </div>
        )}

        {/* ── Step 1: Personal Details ── */}
        {currentStep === 1 && (
          <>
            <h1 className="auth-title">Create your account</h1>
            <p className="auth-subtitle">Your personal details are kept strictly confidential.</p>
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
                  placeholder="you@example.com"
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
            <p className="auth-subtitle">This helps us match you with the right specialist.</p>
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
                  rows={5}
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
                  {submitting ? 'Submitting…' : 'Submit & Get Matched'}
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
  )
}

export default GetStartedPage
