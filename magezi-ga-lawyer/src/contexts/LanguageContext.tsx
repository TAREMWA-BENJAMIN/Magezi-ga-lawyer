import { createContext, useContext, useMemo, useState, type ReactNode } from 'react'

type Language = 'en' | 'lg'

interface LanguageContextValue {
  language: Language
  toggleLanguage: () => void
  translate: (key: string) => string
}

const translations: Record<string, Record<Language, string>> = {
  brand: {
    en: 'Magezi ga Lawyer',
    lg: 'Magezi ga Lawyer',
  },
  quickExit: {
    en: 'Quick Exit',
    lg: 'Yimirira',
  },
  emergencyHelp: {
    en: 'Emergency Help',
    lg: 'Obuyambi',
  },
  searchPlaceholder: {
    en: 'Search legal guides, templates, and cases',
    lg: 'Londa ebyo ku mateeka, essomero ne nsonga',
  },
  legalLibrary: {
    en: 'Legal Information Library',
    lg: 'Ekitongole ky Amateeka',
  },
  documentTemplates: {
    en: 'Legal Document Templates',
    lg: 'Enkyusa za Katonda',
  },
  caseTracking: {
    en: 'Case Tracking',
    lg: 'Okukwatagana n ebyo',
  },
  addCase: {
    en: 'Add case note',
    lg: 'Yongera okusinziira ku kooti',
  },
}

const LanguageContext = createContext<LanguageContextValue | undefined>(undefined)

export function LanguageProvider({ children }: { children: ReactNode }) {
  const [language, setLanguage] = useState<Language>('en')

  const value = useMemo(
    () => ({
      language,
      toggleLanguage: () => setLanguage((current) => (current === 'en' ? 'lg' : 'en')),
      translate: (key: string) => translations[key]?.[language] ?? key,
    }),
    [language],
  )

  return <LanguageContext.Provider value={value}>{children}</LanguageContext.Provider>
}

export function useLanguage() {
  const context = useContext(LanguageContext)
  if (!context) {
    throw new Error('useLanguage must be used within LanguageProvider')
  }
  return context
}
