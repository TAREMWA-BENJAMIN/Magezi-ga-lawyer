import { useState, useEffect, useRef, useCallback } from 'react'
import { Link } from 'react-router-dom'

import slide1 from '../assets/hero_slide_1.png'
import slide2 from '../assets/hero_slide_2.png'
import slide3 from '../assets/hero_slide_3.png'
import slide4 from '../assets/hero_slide_4.png'
import slide5 from '../assets/hero_slide_5.png'
import slide6 from '../assets/hero_slide_6.png'
import slide7 from '../assets/hero_slide_7.png'
import slide8 from '../assets/hero.png'

interface Slide { id: number; src: string; alt: string }

const FALLBACK_SLIDES: Slide[] = [
  { id: 1, src: slide1, alt: 'Ugandan lawyer reviewing legal documents in a modern office' },
  { id: 2, src: slide2, alt: 'Couple consulting a legal advisor' },
  { id: 3, src: slide3, alt: 'Woman signing an important legal document' },
  { id: 4, src: slide4, alt: 'Justice scales and gavel on a polished desk' },
  { id: 5, src: slide5, alt: 'Man accessing legal services on a smartphone' },
  { id: 6, src: slide6, alt: 'Ugandan courtroom interior' },
  { id: 7, src: slide7, alt: 'Legal professionals collaborating in a conference room' },
  { id: 8, src: slide8, alt: 'Legal agreement handshake' },
]

const API_BASE = (import.meta.env.VITE_API_URL as string | undefined) ?? 'http://localhost:8000'
const SLIDES_API = `${API_BASE}/api/public/hero-slides`
const AUTO_PLAY_MS = 4000

/* ── Hero Image Carousel ── */
function HeroCarousel() {
  const [slides, setSlides] = useState<Slide[]>(FALLBACK_SLIDES)
  const [current, setCurrent] = useState(0)
  const [animating, setAnimating] = useState(false)
  const [isHovered, setIsHovered] = useState(false)

  // Load slides from backend; silently fall back to bundled images if unavailable
  useEffect(() => {
    fetch(SLIDES_API)
      .then((res) => { if (!res.ok) throw new Error('not ok'); return res.json() })
      .then((json) => {
        const remote: Slide[] = (json.data ?? []).map((s: { id: number; image_url: string; alt: string }) => ({
          id: s.id, src: s.image_url, alt: s.alt,
        }))
        if (remote.length > 0) setSlides(remote)
      })
      .catch(() => { /* backend offline — use fallback */ })
  }, [])

  const goTo = useCallback((index: number) => {
    if (animating) return
    setAnimating(true)
    setTimeout(() => {
      setCurrent(index)
      setAnimating(false)
    }, 50)
  }, [animating])

  const next = useCallback(() => {
    goTo((current + 1) % slides.length)
  }, [current, slides.length, goTo])

  const prev = useCallback(() => {
    goTo((current - 1 + slides.length) % slides.length)
  }, [current, slides.length, goTo])

  useEffect(() => {
    if (isHovered) return
    const t = setInterval(next, AUTO_PLAY_MS)
    return () => clearInterval(t)
  }, [isHovered, next])

  return (
    <div
      className="hero-carousel"
      onMouseEnter={() => setIsHovered(true)}
      onMouseLeave={() => setIsHovered(false)}
      aria-label="Legal services image slideshow"
    >
      {/* Slides */}
      <div className="carousel-track">
        {slides.map((img, idx) => (
          <div
            key={img.id}
            className={`carousel-slide-item ${idx === current ? 'active' : ''}`}
            aria-hidden={idx !== current}
          >
            <img
              src={img.src}
              alt={img.alt}
              className="carousel-img"
              loading={idx === 0 ? 'eager' : 'lazy'}
              draggable={false}
            />
            <span className="slide-counter">{idx + 1} / {slides.length}</span>
          </div>
        ))}
      </div>

      {/* Arrows */}
      <button className="carousel-arrow prev" onClick={prev} aria-label="Previous image" type="button">‹</button>
      <button className="carousel-arrow next" onClick={next} aria-label="Next image" type="button">›</button>

      {/* Dots */}
      <div className="carousel-dots" role="tablist">
        {slides.map((_, idx) => (
          <button
            key={idx}
            role="tab"
            aria-selected={idx === current}
            aria-label={`Go to slide ${idx + 1}`}
            className={`dot ${idx === current ? 'active' : ''}`}
            onClick={() => goTo(idx)}
            type="button"
          />
        ))}
      </div>

      {/* Progress bar */}
      <div className="carousel-progress">
        <div
          className={`carousel-progress-bar ${isHovered ? 'paused' : ''}`}
          key={`${current}-${isHovered}`}
          style={{ animationDuration: `${AUTO_PLAY_MS}ms` }}
        />
      </div>
    </div>
  )
}

/* ─── Animated Counter Hook ─── */
function useCountUp(target: number, duration = 2000) {
  const [count, setCount] = useState(0)
  const ref = useRef<HTMLDivElement>(null)
  const started = useRef(false)

  useEffect(() => {
    const observer = new IntersectionObserver(
      ([entry]) => {
        if (entry.isIntersecting && !started.current) {
          started.current = true
          const startTime = performance.now()
          const step = (now: number) => {
            const elapsed = now - startTime
            const progress = Math.min(elapsed / duration, 1)
            setCount(Math.floor(progress * target))
            if (progress < 1) requestAnimationFrame(step)
          }
          requestAnimationFrame(step)
        }
      },
      { threshold: 0.3 }
    )
    if (ref.current) observer.observe(ref.current)
    return () => observer.disconnect()
  }, [target, duration])

  return { count, ref }
}

/* ─── Data ─── */
const features = [
  {
    icon: '📚',
    title: 'Free Legal Information',
    description: 'Access a comprehensive library of legal guides written in plain language, covering Ugandan laws on property, family, employment, and more.',
  },
  {
    icon: '📄',
    title: 'Document Templates',
    description: 'Generate common legal documents like agreements, powers of attorney, and affidavits using our step-by-step template builder.',
  },
  {
    icon: '📋',
    title: 'Case Tracking',
    description: 'Keep organised notes about your legal matter with our simple case tracking tool — accessible any time from your device.',
  },
  {
    icon: '🌍',
    title: 'Multilingual Support',
    description: 'Use Magezi ga Lawyer in English or Luganda. We are working to add Runyankole, Ateso, and other Ugandan languages soon.',
  },
  {
    icon: '🚨',
    title: 'Emergency Help Line',
    description: 'In urgent situations — domestic violence, unlawful detention, or land disputes — reach our 24/7 emergency line immediately.',
  },
  {
    icon: '👨‍⚖️',
    title: 'Expert Consultations',
    description: 'Connect with experienced Ugandan lawyers for personalised advice. Book a consultation online or visit our Kampala office.',
  },
]

const practiceAreas = [
  {
    icon: '🏠',
    title: 'Property & Land Law',
    description: 'Navigate land ownership, transactions, boundary disputes, and tenant rights under the Uganda Land Act.',
  },
  {
    icon: '👨‍👩‍👧‍👦',
    title: 'Family Law',
    description: 'Expert guidance on marriage, divorce, child custody, adoption, and inheritance matters across all Ugandan cultures.',
  },
  {
    icon: '⚖️',
    title: 'Criminal Law',
    description: 'Understand your rights if accused or arrested. We provide robust defence and representation in criminal proceedings.',
  },
  {
    icon: '💼',
    title: 'Employment Law',
    description: 'Protect your workplace rights — unfair dismissal, wage disputes, contracts, and occupational safety compliance.',
  },
  {
    icon: '🏢',
    title: 'Commercial Law',
    description: 'Company registration, contract drafting, trade disputes, and regulatory compliance for Ugandan businesses.',
  },
]

const testimonials = [
  {
    name: 'Nalubega Sarah',
    location: 'Kampala',
    quote: 'Magezi ga Lawyer helped me understand my land title documents in plain language. I was able to resolve a boundary dispute with my neighbour without going to court. The guides are clear and truly accessible.',
  },
  {
    name: 'Okello David',
    location: 'Gulu',
    quote: 'When I was wrongfully dismissed from my job, I found the employment law guides on this site. They helped me understand my rights and prepare for my labour tribunal hearing. I won my case.',
  },
  {
    name: 'Ainembabazi Grace',
    location: 'Mbarara',
    quote: 'As a single mother, understanding custody law was overwhelming. The family law section gave me confidence and clarity. The lawyers here genuinely care about helping ordinary Ugandans.',
  },
]

/* ─── Stat Counter Item ─── */
function StatItem({ target, suffix, label }: { target: number; suffix: string; label: string }) {
  const { count, ref } = useCountUp(target)
  return (
    <div className="stat-item" ref={ref}>
      <span className="stat-number">{count.toLocaleString()}{suffix}</span>
      <span className="stat-label">{label}</span>
    </div>
  )
}

/* ─── Home Page ─── */
function HomePage() {
  return (
    <div className="home-page">
      {/* ── Hero Section ── */}
      <section className="hero-panel" aria-label="Welcome to Magezi ga Lawyer">
        <div className="hero-copy">
          <span className="eyebrow">Law made simple</span>
          <h1>Accessible Legal Guidance for Every Ugandan</h1>
          <p>
            Magezi ga Lawyer helps you find trusted legal information, build easy
            document templates, and connect with experienced lawyers — all in a
            calm, readable interface designed for clarity.
          </p>
          <div className="hero-actions">
            <Link className="hero-button" to="/library">
              Explore the Library
            </Link>
            <Link className="hero-button hero-button-outline" to="/contact">
              Get a Consultation
            </Link>
          </div>
        </div>
        <HeroCarousel />
      </section>

      {/* ── Features Section ── */}
      <section className="features-section" aria-label="Our key features">
        <div className="section-header">
          <span className="eyebrow">What we offer</span>
          <h2>Everything You Need to Understand Your Legal Rights</h2>
          <p>
            From free information guides to expert consultations, we provide the tools
            and support to help you navigate Uganda's legal system with confidence.
          </p>
        </div>
        <div className="features-grid">
          {features.map((feature) => (
            <article className="feature-card" key={feature.title}>
              <span className="feature-icon" aria-hidden="true">{feature.icon}</span>
              <h3>{feature.title}</h3>
              <p>{feature.description}</p>
            </article>
          ))}
        </div>
      </section>

      {/* ── Statistics Section ── */}
      <section className="stats-section" aria-label="Our track record">
        <div className="section-header">
          <span className="eyebrow">Our impact</span>
          <h2>Making Justice Accessible Across Uganda</h2>
        </div>
        <div className="stats-grid">
          <StatItem target={1200} suffix="+" label="Cases Resolved" />
          <StatItem target={15} suffix="+" label="Years Experience" />
          <StatItem target={98} suffix="%" label="Client Satisfaction" />
          <StatItem target={6} suffix="" label="Expert Lawyers" />
        </div>
      </section>

      {/* ── Practice Areas Preview ── */}
      <section className="practice-preview" aria-label="Our practice areas">
        <div className="section-header">
          <span className="eyebrow">Practice Areas</span>
          <h2>Comprehensive Legal Expertise</h2>
          <p>
            Our team covers the areas of law most important to everyday Ugandans —
            from property and family matters to criminal defence and business law.
          </p>
        </div>
        <div className="practice-grid">
          {practiceAreas.map((area) => (
            <article className="practice-card" key={area.title}>
              <span className="practice-icon" aria-hidden="true">{area.icon}</span>
              <h3>{area.title}</h3>
              <p>{area.description}</p>
              <Link to="/practice-areas" className="card-link">
                Learn More →
              </Link>
            </article>
          ))}
        </div>
      </section>

      {/* ── Testimonials Section ── */}
      <section className="testimonials-section" aria-label="Client testimonials">
        <div className="section-header">
          <span className="eyebrow">Client Stories</span>
          <h2>Trusted by Ugandans Across the Country</h2>
        </div>
        <div className="testimonials-grid">
          {testimonials.map((t) => (
            <article className="testimonial-card" key={t.name}>
              <blockquote>
                <p>"{t.quote}"</p>
              </blockquote>
              <footer>
                <strong>{t.name}</strong>
                <span>{t.location}</span>
              </footer>
            </article>
          ))}
        </div>
      </section>

      {/* ── CTA Section ── */}
      <section className="cta-section" aria-label="Get started">
        <div className="cta-content">
          <h2>Need Legal Help Today?</h2>
          <p>
            Whether you need to understand a land title, resolve a family dispute, or
            defend your rights in court — we are here to help. Start with our free
            resources or speak directly with a lawyer.
          </p>
          <div className="cta-actions">
            <Link className="hero-button" to="/library">
              Browse Legal Library
            </Link>
            <Link className="hero-button hero-button-outline" to="/contact">
              Contact a Lawyer
            </Link>
            <a className="hero-button hero-button-emergency" href="tel:+256791862269">
              🚨 Emergency: +256 791 862 269
            </a>
          </div>
        </div>
      </section>
    </div>
  )
}

export default HomePage
