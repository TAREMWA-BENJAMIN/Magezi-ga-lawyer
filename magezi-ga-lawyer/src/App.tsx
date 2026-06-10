import './App.css'
import { Routes, Route } from 'react-router-dom'
import { LanguageProvider } from './contexts/LanguageContext'
import Navigation from './components/Navigation'
import Footer from './components/Footer'
import HomePage from './pages/HomePage'
import PracticeAreasPage from './pages/PracticeAreasPage'
import AboutPage from './pages/AboutPage'
import DocumentTemplatesPage from './pages/DocumentTemplatesPage'
import SignInPage from './pages/SignInPage'
import GetStartedPage from './pages/GetStartedPage'

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
            <Route path="/templates" element={<DocumentTemplatesPage />} />
            <Route path="/signin" element={<SignInPage />} />
            <Route path="/get-started" element={<GetStartedPage />} />
          </Routes>
        </main>
        <Footer />
      </div>
    </LanguageProvider>
  )
}

export default App
