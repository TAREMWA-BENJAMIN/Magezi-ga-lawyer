import { useState } from 'react'
import { Link, useNavigate } from 'react-router-dom'

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
      navigate('/')
    } else {
      setStatus('error')
    }
  }

  return (
    <div className="auth-page">
      <div className="auth-card">
        {/* ── Brand ── */}
        <div className="auth-brand">
          <span className="auth-brand-mark">M</span>
          <div>
            <p className="auth-brand-name">Magezi ga Lawyer</p>
            <p className="auth-brand-sub">Client Portal</p>
          </div>
        </div>

        <h1 className="auth-title">Welcome back</h1>
        <p className="auth-subtitle">Sign in to access your case files, documents, and messages.</p>

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
              placeholder="you@example.com"
              value={form.email}
              onChange={handleChange}
            />
          </div>

          <div className="form-group">
            <div className="auth-label-row">
              <label htmlFor="signin-password">Password</label>
              <Link to="/forgot-password" className="auth-forgot">Forgot password?</Link>
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
            {status === 'loading' ? 'Signing in…' : 'Sign In'}
          </button>
        </form>

        <div className="auth-divider"><span>or</span></div>

        <p className="auth-switch">
          Don't have an account?{' '}
          <Link to="/get-started" className="auth-switch-link">Get Started — it's free</Link>
        </p>

        <p className="auth-legal">
          By signing in you agree to our{' '}
          <Link to="/about">Terms of Service</Link> and{' '}
          <Link to="/about">Privacy Policy</Link>.
        </p>
      </div>

      {/* ── Decorative side panel ── */}
      <aside className="auth-panel" aria-hidden="true">
        <div className="auth-panel-content">
          <blockquote>
            "Justice delayed is justice denied. We ensure your legal matters are handled swiftly and effectively."
          </blockquote>
          <cite>— Babirye Catherine Magezi, Managing Partner</cite>
          <ul className="auth-panel-features">
            <li>✓ Secure client portal</li>
            <li>✓ Real-time case updates</li>
            <li>✓ Direct lawyer messaging</li>
            <li>✓ Document uploads & storage</li>
          </ul>
        </div>
      </aside>
    </div>
  )
}

export default SignInPage
