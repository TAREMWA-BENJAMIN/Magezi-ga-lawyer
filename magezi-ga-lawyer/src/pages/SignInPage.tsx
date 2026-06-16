import { useState } from 'react'
import { Link, useNavigate } from 'react-router-dom'
import authBg from '../assets/auth_legal_bg.png'

function SignInPage() {
  const navigate = useNavigate()
  const [form, setForm] = useState({ email: '', password: '' })
  const [status, setStatus] = useState<'idle' | 'loading' | 'error'>('idle')

  const handleChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    setForm({ ...form, [e.target.name]: e.target.value })
  }

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault()
    setStatus('loading')
    // Simulate auth — replace with real API call when backend is ready
    await new Promise((res) => setTimeout(res, 1000))
    // For now, demo redirect
    if (form.email && form.password) {
      navigate('/acts')
    } else {
      setStatus('error')
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

          <h1 className="auth-title">Welcome back</h1>
          <p className="auth-subtitle">Sign in to access your case files, documents, and messages.</p>

          {/* Google sign-in button placeholder */}
          <button type="button" className="google-auth-btn">
            <svg className="google-icon" viewBox="0 0 24 24" width="16" height="16">
              <path fill="#4285F4" d="M23.745 12.27c0-.7-.06-1.4-.19-2.07H12v3.92h6.69a5.74 5.74 0 0 1-2.48 3.77v3.12h4.02c2.34-2.16 3.69-5.32 3.69-8.74z"/>
              <path fill="#34A853" d="M12 24c3.24 0 5.97-1.08 7.96-2.91l-4.02-3.12c-1.12.75-2.54 1.19-3.94 1.19-3.04 0-5.61-2.05-6.53-4.82H1.33v3.2A11.98 11.98 0 0 0 12 24z"/>
              <path fill="#FBBC05" d="M5.47 14.34a7.16 7.16 0 0 1 0-4.68V6.46H1.33a11.98 11.98 0 0 0 0 11.08l4.14-3.2z"/>
              <path fill="#EA4335" d="M12 4.75c1.77 0 3.35.61 4.6 1.8l3.43-3.43A11.93 11.93 0 0 0 12 0 11.98 11.98 0 0 0 1.33 6.46l4.14 3.2c.92-2.77 3.49-4.82 6.53-4.82z"/>
            </svg>
            <span>Sign in with Google</span>
          </button>

          <div className="auth-divider"><span>or</span></div>

          {status === 'error' && (
            <div className="auth-error" role="alert">
              <span aria-hidden="true">⚠️</span> Invalid email or password. Please try again.
            </div>
          )}

          <form className="auth-form" onSubmit={handleSubmit} noValidate>
            <div className="form-group">
              <label htmlFor="signin-email">Email Address</label>
              <input
                id="signin-email"
                name="email"
                type="email"
                required
                autoComplete="email"
                placeholder="Enter your email address"
                value={form.email}
                onChange={handleChange}
              />
            </div>

            <div className="form-group">
              <div className="auth-label-row">
                <label htmlFor="signin-password">Password</label>
                <Link to="/about" className="auth-forgot">Forgot password?</Link>
              </div>
              <input
                id="signin-password"
                name="password"
                type="password"
                required
                autoComplete="current-password"
                placeholder="••••••••"
                value={form.password}
                onChange={handleChange}
              />
            </div>

            <button
              id="signin-submit"
              type="submit"
              className="auth-submit-btn"
              disabled={status === 'loading'}
            >
              {status === 'loading' ? 'Signing in…' : 'Sign In →'}
            </button>
          </form>

          <p className="auth-switch">
            Don't have an account?{' '}
            <Link to="/get-started" className="auth-switch-link">Get Started — it's free</Link>
          </p>
        </div>
      </div>
    </div>
  )
}

export default SignInPage

