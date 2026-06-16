import { useState, useEffect } from 'react'
import { Link } from 'react-router-dom'
import { api } from '../services/api'

interface FAQ {
  id: number
  question: string
  answer: string
}

function FAQPage() {
  const [faqs, setFaqs] = useState<FAQ[]>([])

  useEffect(() => {
    api.getFAQ()
      .then(data => setFaqs(data))
      .catch(console.error)
  }, [])

  return (
    <div className="faq-page">
      <section className="page-header">
        <nav className="breadcrumb" aria-label="Breadcrumb">
          <Link to="/">Home</Link>
          <span aria-hidden="true">›</span>
          <span aria-current="page">FAQ</span>
        </nav>
        <h1>Frequently Asked Questions</h1>
        <p>Common questions about Ugandan law, our services, and legal processes.</p>
      </section>

      <section className="faq-list" style={{ maxWidth: '800px', margin: '40px auto', padding: '0 20px' }}>
        {faqs.map(faq => (
          <article key={faq.id} className="faq-item" style={{ marginBottom: '30px', padding: '20px', background: 'var(--surface)', borderRadius: '8px', boxShadow: '0 2px 4px rgba(0,0,0,0.05)' }}>
            <h3 style={{ color: 'var(--primary)', marginBottom: '10px' }}>{faq.question}</h3>
            <p style={{ lineHeight: '1.6' }}>{faq.answer}</p>
          </article>
        ))}
        {faqs.length === 0 && <p className="muted">Loading FAQs...</p>}
      </section>
    </div>
  )
}

export default FAQPage
