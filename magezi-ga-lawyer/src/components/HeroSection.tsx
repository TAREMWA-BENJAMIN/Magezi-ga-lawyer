import { useState } from 'react'

const heroImages = [
  {
    id: 1,
    alt: 'Ugandan woman reviewing legal documents',
    color: '#D8EAF6',
  },
  {
    id: 2,
    alt: 'Diverse professionals discussing legal matters',
    color: '#C0E2FF',
  },
  {
    id: 3,
    alt: 'Person using Magezi ga Lawyer on mobile',
    color: '#A8D8FF',
  },
]

function HeroSection() {
  const [currentImageIndex, setCurrentImageIndex] = useState(0)

  const nextImage = () => {
    setCurrentImageIndex((prev) => (prev + 1) % heroImages.length)
  }

  const prevImage = () => {
    setCurrentImageIndex((prev) => (prev - 1 + heroImages.length) % heroImages.length)
  }

  const goToImage = (index: number) => {
    setCurrentImageIndex(index)
  }

  return (
    <section className="hero-panel">
      <div className="hero-copy">
        <span className="eyebrow">Law made simple</span>
        <h1>Accessible legal guidance for every Ugandan.</h1>
        <p>
          Magezi ga Lawyer helps you find trusted legal information, build easy
          document templates, and track your case status in a calm, readable
          interface.
        </p>
        <div className="hero-actions">
          <a className="hero-button" href="#library">
            Explore the library
          </a>
        </div>
      </div>
      <div className="hero-carousel">
        <button
          className="carousel-arrow prev"
          onClick={prevImage}
          aria-label="Previous image"
        >
          ‹
        </button>
        <div className="carousel-container">
          <div className="carousel-slide" style={{ backgroundColor: heroImages[currentImageIndex].color }}>
            <span className="image-placeholder">
              {heroImages[currentImageIndex].alt}
            </span>
          </div>
        </div>
        <button
          className="carousel-arrow next"
          onClick={nextImage}
          aria-label="Next image"
        >
          ›
        </button>
        <div className="carousel-dots">
          {heroImages.map((_, index) => (
            <button
              key={index}
              className={`dot ${index === currentImageIndex ? 'active' : ''}`}
              onClick={() => goToImage(index)}
              aria-label={`Go to image ${index + 1}`}
            />
          ))}
        </div>
      </div>
    </section>
  )
}

export default HeroSection
