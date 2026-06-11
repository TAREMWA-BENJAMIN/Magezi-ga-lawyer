import { useState, useEffect, useCallback } from 'react'

import slide1 from '../assets/hero_slide_1.png'
import slide2 from '../assets/hero_slide_2.png'
import slide3 from '../assets/hero_slide_3.png'
import slide4 from '../assets/hero_slide_4.png'
import slide5 from '../assets/hero_slide_5.png'
import slide6 from '../assets/hero_slide_6.png'
import slide7 from '../assets/hero_slide_7.png'
import slide8 from '../assets/hero.png'

const heroImages = [
  { id: 1, src: slide1, alt: 'Ugandan lawyer reviewing legal documents in a modern office' },
  { id: 2, src: slide2, alt: 'Ugandan couple consulting with a legal advisor' },
  { id: 3, src: slide3, alt: 'Woman signing an important legal document' },
  { id: 4, src: slide4, alt: 'Justice scales and gavel on a polished wooden desk' },
  { id: 5, src: slide5, alt: 'Man accessing legal services on a smartphone' },
  { id: 6, src: slide6, alt: 'Ugandan courtroom interior' },
  { id: 7, src: slide7, alt: 'Legal professionals collaborating in a conference room' },
  { id: 8, src: slide8, alt: 'Legal handshake and agreement' },
]

const AUTO_PLAY_INTERVAL = 4000

function HeroSection() {
  const [current, setCurrent] = useState(0)
  const [isHovered, setIsHovered] = useState(false)
  const [direction, setDirection] = useState<'next' | 'prev'>('next')
  const [animating, setAnimating] = useState(false)

  const goTo = useCallback(
    (index: number, dir: 'next' | 'prev' = 'next') => {
      if (animating) return
      setDirection(dir)
      setAnimating(true)
      setTimeout(() => {
        setCurrent(index)
        setAnimating(false)
      }, 400)
    },
    [animating]
  )

  const next = useCallback(() => {
    goTo((current + 1) % heroImages.length, 'next')
  }, [current, goTo])

  const prev = useCallback(() => {
    goTo((current - 1 + heroImages.length) % heroImages.length, 'prev')
  }, [current, goTo])

  // Auto-play
  useEffect(() => {
    if (isHovered) return
    const timer = setInterval(next, AUTO_PLAY_INTERVAL)
    return () => clearInterval(timer)
  }, [isHovered, next])

  return (
    <section className="hero-panel">
      <div className="hero-copy">
        <span className="eyebrow">Law made simple</span>
        <h1>Accessible Legal Guidance for Every Ugandan</h1>
        <p>
          Magezi ga Lawyer helps you find trusted legal information, build easy
          document templates, and connect with experienced lawyers — all in a calm,
          readable interface designed for clarity.
        </p>
        <div className="hero-actions">
          <a className="hero-button" href="#library">
            Explore the Library
          </a>
          <a className="hero-button hero-button--outline" href="/get-started">
            Get a Consultation
          </a>
        </div>
      </div>

      {/* ── Image Carousel ── */}
      <div
        className="hero-carousel"
        onMouseEnter={() => setIsHovered(true)}
        onMouseLeave={() => setIsHovered(false)}
        aria-label="Legal services image carousel"
        aria-roledescription="carousel"
      >
        {/* Slide track */}
        <div className="carousel-track">
          {heroImages.map((img, idx) => (
            <div
              key={img.id}
              className={`carousel-slide-item ${
                idx === current ? 'active' : ''
              } ${animating && idx === current ? `slide-${direction}` : ''}`}
              aria-hidden={idx !== current}
            >
              <img
                src={img.src}
                alt={img.alt}
                className="carousel-img"
                loading={idx === 0 ? 'eager' : 'lazy'}
                draggable={false}
              />
              {/* Slide counter badge */}
              <span className="slide-counter">
                {idx + 1} / {heroImages.length}
              </span>
            </div>
          ))}
        </div>

        {/* Arrow controls */}
        <button
          className="carousel-arrow prev"
          onClick={prev}
          aria-label="Previous image"
          type="button"
        >
          ‹
        </button>
        <button
          className="carousel-arrow next"
          onClick={next}
          aria-label="Next image"
          type="button"
        >
          ›
        </button>

        {/* Dot indicators */}
        <div className="carousel-dots" role="tablist" aria-label="Slide navigation">
          {heroImages.map((_, idx) => (
            <button
              key={idx}
              role="tab"
              aria-selected={idx === current}
              aria-label={`Go to slide ${idx + 1}`}
              className={`dot ${idx === current ? 'active' : ''}`}
              onClick={() => goTo(idx, idx > current ? 'next' : 'prev')}
              type="button"
            />
          ))}
        </div>

        {/* Progress bar */}
        <div className="carousel-progress">
          <div
            className={`carousel-progress-bar ${isHovered ? 'paused' : ''}`}
            key={`${current}-${isHovered}`}
            style={{ animationDuration: `${AUTO_PLAY_INTERVAL}ms` }}
          />
        </div>
      </div>
    </section>
  )
}

export default HeroSection
