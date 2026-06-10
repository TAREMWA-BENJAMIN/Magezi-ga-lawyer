import { useState } from 'react'

interface FormData {
  name: string
  email: string
  phone: string
  subject: string
  message: string
}

const offices = [
  {
    city: 'Kampala (Head Office)',
    address: '14 Kampala Road, City Square, Kampala',
    phone: '+256 414 123 456',
    email: 'info@magezi.ug',
    hours: 'Mon–Fri: 8:00 am – 5:30 pm',
  },
  {
    city: 'Jinja Office',
    address: '7 Main Street, Jinja',
    phone: '+256 434 987 654',
    email: 'jinja@magezi.ug',
    hours: 'Mon–Fri: 8:30 am – 5:00 pm',
  },
]

function ContactPage() {
  const [form, setForm] = useState<FormData>({
    name: '',
    email: '',
    phone: '',
    subject: '',
    message: '',
  })
  const [status, setStatus] = useState<'idle' | 'sending' | 'success' | 'error'>('idle')

  const handleChange = (e: React.ChangeEvent<HTMLInputElement | HTMLTextAreaElement | HTMLSelectElement>) => {
    setForm({ ...form, [e.target.name]: e.target.value })
  }

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault()
    setStatus('sending')
    // Simulate submission — replace with real API call when backend is ready
    await new Promise((res) => setTimeout(res, 1200))
    setStatus('success')
    setForm({ name: '', email: '', phone: '', subject: '', message: '' })
  }

  return (
    <div className="contact-page">
      {/* ── Page Header ── */}
      <section className="page-header">
        <nav className="breadcrumb" aria-label="Breadcrumb">
          <a href="/">Home</a>
          <span aria-hidden="true">›</span>
          <span aria-current="page">Contact Us</span>
        </nav>
        <h1>Get in Touch</h1>
        <p>
          Whether you have a legal question, need to schedule a consultation, or simply want
          to learn more about our services — we're here to help.
        </p>
      </section>

      <div className="contact-layout">
        {/* ── Contact Form ── */}
        <section className="contact-form-section" aria-label="Contact form">
          <h2>Send Us a Message</h2>
          {status === 'success' ? (
            <div className="contact-success" role="alert">
              <span aria-hidden="true">✅</span>
              <h3>Message Received</h3>
              <p>Thank you for reaching out. One of our team members will contact you within one business day.</p>
              <button className="hero-button" onClick={() => setStatus('idle')}>Send Another Message</button>
            </div>
          ) : (
            <form className="contact-form" onSubmit={handleSubmit} noValidate>
              <div className="form-row">
                <div className="form-group">
                  <label htmlFor="contact-name">Full Name *</label>
                  <input
                    id="contact-name"
                    name="name"
                    type="text"
                    required
                    placeholder="e.g. Nakato Aisha"
                    value={form.name}
                    onChange={handleChange}
                  />
                </div>
                <div className="form-group">
                  <label htmlFor="contact-email">Email Address *</label>
                  <input
                    id="contact-email"
                    name="email"
                    type="email"
                    required
                    placeholder="you@example.com"
                    value={form.email}
                    onChange={handleChange}
                  />
                </div>
              </div>
              <div className="form-row">
                <div className="form-group">
                  <label htmlFor="contact-phone">Phone Number</label>
                  <input
                    id="contact-phone"
                    name="phone"
                    type="tel"
                    placeholder="+256 7XX XXX XXX"
                    value={form.phone}
                    onChange={handleChange}
                  />
                </div>
                <div className="form-group">
                  <label htmlFor="contact-subject">Subject *</label>
                  <select
                    id="contact-subject"
                    name="subject"
                    required
                    value={form.subject}
                    onChange={handleChange}
                  >
                    <option value="">Select a practice area…</option>
                    <option>Property &amp; Land Law</option>
                    <option>Family Law</option>
                    <option>Criminal Law</option>
                    <option>Employment Law</option>
                    <option>Commercial Law</option>
                    <option>General Enquiry</option>
                  </select>
                </div>
              </div>
              <div className="form-group">
                <label htmlFor="contact-message">Your Message *</label>
                <textarea
                  id="contact-message"
                  name="message"
                  required
                  rows={6}
                  placeholder="Please describe your legal matter briefly…"
                  value={form.message}
                  onChange={handleChange}
                />
              </div>
              <p className="form-disclaimer">
                All enquiries are treated in strict confidence. Initial consultations are free of charge.
              </p>
              <button
                id="contact-submit"
                type="submit"
                className="hero-button"
                disabled={status === 'sending'}
              >
                {status === 'sending' ? 'Sending…' : 'Send Message'}
              </button>
            </form>
          )}
        </section>

        {/* ── Office Info ── */}
        <aside className="contact-info-section" aria-label="Office information">
          <h2>Our Offices</h2>
          {offices.map((office) => (
            <address className="office-card" key={office.city}>
              <h3>{office.city}</h3>
              <p>📍 {office.address}</p>
              <p>📞 <a href={`tel:${office.phone.replace(/\s/g, '')}`}>{office.phone}</a></p>
              <p>✉️ <a href={`mailto:${office.email}`}>{office.email}</a></p>
              <p>🕐 {office.hours}</p>
            </address>
          ))}

          <div className="contact-social">
            <h3>Follow Us</h3>
            <div className="social-links">
              <a href="https://facebook.com" target="_blank" rel="noopener noreferrer" aria-label="Facebook">
                <span aria-hidden="true">📘</span> Facebook
              </a>
              <a href="https://twitter.com" target="_blank" rel="noopener noreferrer" aria-label="Twitter/X">
                <span aria-hidden="true">🐦</span> Twitter / X
              </a>
              <a href="https://linkedin.com" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn">
                <span aria-hidden="true">💼</span> LinkedIn
              </a>
            </div>
          </div>
        </aside>
      </div>
    </div>
  )
}

export default ContactPage
