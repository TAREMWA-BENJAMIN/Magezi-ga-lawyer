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

import { api } from '../services/api'

const AUTO_PLAY_MS = 4000

/* ── Hero Image Carousel ── */
function HeroCarousel() {
  const [slides, setSlides] = useState<Slide[]>(FALLBACK_SLIDES)
  const [current, setCurrent] = useState(0)
  const [animating, setAnimating] = useState(false)
  const [isHovered, setIsHovered] = useState(false)

  // Load slides from backend; silently fall back to bundled images if unavailable
  useEffect(() => {
    api.getHeroSlides()
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



interface PracticeArea {
  id: number;
  title: string;
  slug: string;
  short_description: string;
  emoji_icon: string;
}

const FALLBACK_PRACTICE_AREAS: PracticeArea[] = [
  {
    id: 1,
    emoji_icon: '🏠',
    title: 'Property & Land Law',
    slug: 'property-law',
    short_description: 'Navigate land ownership, transactions, boundary disputes, and tenant rights under the Uganda Land Act.',
  },
  {
    id: 2,
    emoji_icon: '👨‍👩‍👧‍👦',
    title: 'Family Law',
    slug: 'family-law',
    short_description: 'Expert guidance on marriage, divorce, child custody, adoption, and inheritance matters across all Ugandan cultures.',
  },
  {
    id: 3,
    emoji_icon: '⚖️',
    title: 'Criminal Law',
    slug: 'criminal-law',
    short_description: 'Understand your rights if accused or arrested. We provide robust defence and representation in criminal proceedings.',
  },
  {
    id: 4,
    emoji_icon: '💼',
    title: 'Employment Law',
    slug: 'employment-law',
    short_description: 'Protect your workplace rights — unfair dismissal, wage disputes, contracts, and occupational safety compliance.',
  },
  {
    id: 5,
    emoji_icon: '🏢',
    title: 'Commercial Law',
    slug: 'commercial-law',
    short_description: 'Company registration, contract drafting, trade disputes, and regulatory compliance for Ugandan businesses.',
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



/* ─── Home Page ─── */
function HomePage() {
  const [practiceAreas, setPracticeAreas] = useState<PracticeArea[]>(FALLBACK_PRACTICE_AREAS)
  const [siteSettings, setSiteSettings] = useState<any>({})

  useEffect(() => {
    api.getPracticeAreas()
      .then(data => {
        if (data && data.length > 0) {
          setPracticeAreas(data)
        }
      })
      .catch(() => { /* use fallback */ })

    api.getSiteSettings()
      .then(data => setSiteSettings(data))
      .catch(console.error)
  }, [])

  return (
    <div className="home-page">
      {/* ── Hero Section ── */}
      <section className="hero-panel" aria-label="Welcome to Magezi ga Lawyer">
        <div className="hero-copy">
          <span className="eyebrow">Law made simple</span>
          <h1>{siteSettings.home_hero_title || 'Accessible Legal Guidance for Every Ugandan'}</h1>
          <p>
            {siteSettings.home_hero_subtitle || 'Magezi ga Lawyer helps you find trusted legal information, build easy document templates, and connect with experienced lawyers — all in a calm, readable interface designed for clarity.'}
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
            <article className="practice-card" key={area.id || area.title}>
              <span className="practice-icon" aria-hidden="true">{area.emoji_icon}</span>
              <h3>{area.title}</h3>
              <p>{area.short_description}</p>
              <Link to="/practice-areas" className="card-link">
                Learn More →
              </Link>
            </article>
          ))}
        </div>
      </section>

     
      
    </div>
  )
}

export default HomePage
