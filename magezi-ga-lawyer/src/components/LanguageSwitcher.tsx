import { useLanguage } from '../contexts/LanguageContext'

function LanguageSwitcher() {
  const { language, toggleLanguage } = useLanguage()

  return (
    <button type="button" className="language-switcher" onClick={toggleLanguage} aria-label="Switch language">
      {language === 'en' ? 'English' : 'Luganda'}
    </button>
  )
}

export default LanguageSwitcher
