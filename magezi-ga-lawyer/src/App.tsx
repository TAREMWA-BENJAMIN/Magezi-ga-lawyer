import './App.css'
import { Routes, Route, useLocation } from 'react-router-dom'
import { LanguageProvider } from './contexts/LanguageContext'
import Navigation from './components/Navigation'
import Footer from './components/Footer'
import HomePage from './pages/HomePage'
import PracticeAreasPage from './pages/PracticeAreasPage'
import AboutPage from './pages/AboutPage'
import SignInPage from './pages/SignInPage'
import GetStartedPage from './pages/GetStartedPage'
import ContactPage from './pages/ContactPage'
import FAQPage from './pages/FAQPage'
import ActsPage from './pages/ActsPage'

function App() {
  const location = useLocation()
  const hideHeaderFooter = ['/signin', '/get-started'].includes(location.pathname)

  return (
    <LanguageProvider>
      <div className="app-shell">
        {!hideHeaderFooter && <Navigation />}
        <main>
          <Routes>
            <Route path="/" element={<HomePage />} />
            <Route path="/practice-areas" element={<PracticeAreasPage />} />
            <Route path="/about" element={<AboutPage />} />
            <Route path="/signin" element={<SignInPage />} />
            <Route path="/get-started" element={<GetStartedPage />} />
            <Route path="/acts" element={<ActsPage />} />
            <Route path="/contact" element={<ContactPage />} />
            <Route path="/faq" element={<FAQPage />} />
          </Routes>
        </main>
        {!hideHeaderFooter && <Footer />}
      </div>
    </LanguageProvider>
  )
}

export default App

