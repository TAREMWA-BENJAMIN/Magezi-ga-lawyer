import { useState } from 'react'
import { Link } from 'react-router-dom'
import { api } from '../services/api'

function ContactPage() {
  const [formData, setFormData] = useState({
    name: '',
    email: '',
    phone: '',
    subject: '',
    message: '',
  })
  const [status, setStatus] = useState<'idle' | 'submitting' | 'success' | 'error'>('idle')
  const [responseMsg, setResponseMsg] = useState('')

  const handleChange = (e: React.ChangeEvent<HTMLInputElement | HTMLTextAreaElement>) => {
    setFormData({ ...formData, [e.target.name]: e.target.value })
  }

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault()
    setStatus('submitting')
    try {
      const res = await api.submitContact(formData)
      if (res.success) {
        setStatus('success')
        setResponseMsg(res.message)
        setFormData({ name: '', email: '', phone: '', subject: '', message: '' })
      } else {
        setStatus('error')
        setResponseMsg(res.message || 'Something went wrong. Please try again.')
      }
    } catch (err) {
      setStatus('error')
      setResponseMsg('Failed to connect to the server. Please try again later.')
    }
  }

  return (
    <div className="auth-page">
      <div className="auth-card" style={{ maxWidth: '600px', margin: '40px auto', width: '100%' }}>
        <nav className="breadcrumb" aria-label="Breadcrumb">
          <Link to="/">Home</Link>
          <span aria-hidden="true">›</span>
          <span aria-current="page">Contact</span>
        </nav>
        
        <h1 className="auth-title">Contact Us</h1>
        <p className="auth-subtitle">We are here to help. Send us a message and we'll respond within 24-48 hours.</p>

        {status === 'success' && (
          <div className="auth-success" style={{ padding: '15px', backgroundColor: '#e6fffa', color: '#2c7a7b', borderRadius: '4px', marginBottom: '20px' }}>
            {responseMsg}
          </div>
        )}
        {status === 'error' && (
          <div className="auth-error" role="alert">
            <span aria-hidden="true">⚠️</span> {responseMsg}
          </div>
        )}

        <form className="auth-form" onSubmit={handleSubmit}>
          <div className="form-group">
            <label htmlFor="name">Full Name *</label>
            <input id="name" name="name" type="text" required value={formData.name} onChange={handleChange} />
          </div>
          <div className="form-row">
            <div className="form-group">
              <label htmlFor="email">Email Address *</label>
              <input id="email" name="email" type="email" required value={formData.email} onChange={handleChange} />
            </div>
            <div className="form-group">
              <label htmlFor="phone">Phone Number</label>
              <input id="phone" name="phone" type="tel" value={formData.phone} onChange={handleChange} />
            </div>
          </div>
          <div className="form-group">
            <label htmlFor="subject">Subject *</label>
            <input id="subject" name="subject" type="text" required value={formData.subject} onChange={handleChange} />
          </div>
          <div className="form-group">
            <label htmlFor="message">Message *</label>
            <textarea id="message" name="message" required rows={5} value={formData.message} onChange={handleChange} />
          </div>
          <button type="submit" className="auth-submit-btn" disabled={status === 'submitting'}>
            {status === 'submitting' ? 'Sending...' : 'Send Message'}
          </button>
        </form>
      </div>
    </div>
  )
}

export default ContactPage
