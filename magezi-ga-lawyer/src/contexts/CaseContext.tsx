import { createContext, useContext, useEffect, useMemo, useState, type ReactNode } from 'react'

export interface CaseItem {
  id: string
  title: string
  status: 'Open' | 'In review' | 'Resolved'
  notes: string
  lastUpdated: string
}

interface CaseContextValue {
  cases: CaseItem[]
  addCase: (title: string, notes: string) => void
  updateStatus: (id: string, status: CaseItem['status']) => void
}

const CaseContext = createContext<CaseContextValue | undefined>(undefined)

const STORAGE_KEY = 'magezi-ga-lawyer-cases'

export function CaseProvider({ children }: { children: ReactNode }) {
  const [cases, setCases] = useState<CaseItem[]>(() => {
    if (typeof window === 'undefined') {
      return []
    }
    try {
      const stored = window.localStorage.getItem(STORAGE_KEY)
      return stored ? (JSON.parse(stored) as CaseItem[]) : []
    } catch {
      return []
    }
  })

  useEffect(() => {
    window.localStorage.setItem(STORAGE_KEY, JSON.stringify(cases))
  }, [cases])

  const value = useMemo(
    () => ({
      cases,
      addCase: (title: string, notes: string) => {
        const nextCase: CaseItem = {
          id: crypto.randomUUID(),
          title,
          status: 'Open',
          notes,
          lastUpdated: new Date().toISOString(),
        }
        setCases((current) => [nextCase, ...current])
      },
      updateStatus: (id: string, status: CaseItem['status']) => {
        setCases((current) =>
          current.map((caseItem) =>
            caseItem.id === id
              ? { ...caseItem, status, lastUpdated: new Date().toISOString() }
              : caseItem,
          ),
        )
      },
    }),
    [cases],
  )

  return <CaseContext.Provider value={value}>{children}</CaseContext.Provider>
}

export function useCaseContext() {
  const context = useContext(CaseContext)
  if (!context) {
    throw new Error('useCaseContext must be used within CaseProvider')
  }
  return context
}
