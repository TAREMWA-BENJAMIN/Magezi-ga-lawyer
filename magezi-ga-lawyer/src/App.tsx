import './App.css'
import { Routes, Route } from 'react-router-dom'
import { LanguageProvider } from './contexts/LanguageContext'
import Navigation from './components/Navigation'
import Footer from './components/Footer'
import HomePage from './pages/HomePage'
import PracticeAreasPage from './pages/PracticeAreasPage'
import AboutPage from './pages/AboutPage'
import SignInPage from './pages/SignInPage'
import GetStartedPage from './pages/GetStartedPage'
import LibraryPage from './pages/LibraryPage'
import ContactPage from './pages/ContactPage'
import FAQPage from './pages/FAQPage'

function App() {
  return (
    <LanguageProvider>
      <div className="app-shell">
        <Navigation />
        <main>
          <Routes>
            <Route path="/" element={<HomePage />} />
            <Route path="/practice-areas" element={<PracticeAreasPage />} />
            <Route path="/about" element={<AboutPage />} />
            <Route path="/signin" element={<SignInPage />} />
            <Route path="/get-started" element={<GetStartedPage />} />
            <Route path="/library" element={<LibraryPage />} />
            <Route path="/contact" element={<ContactPage />} />
            <Route path="/faq" element={<FAQPage />} />
          </Routes>
        </main>
        <Footer />
      </div>
    </LanguageProvider>
  )
}

export default App
