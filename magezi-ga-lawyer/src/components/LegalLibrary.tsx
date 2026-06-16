import { useEffect, useState } from 'react'
import SearchBar, { type SearchItem } from './SearchBar'
import { api } from '../services/api'

// Define the extended item type based on the backend response
interface ExtendedSearchItem extends SearchItem {
  content?: string
  relatedLinks?: { title: string; url: string }[]
}

const FALLBACK_ITEMS: ExtendedSearchItem[] = [
  {
    id: 'land-rights',
    title: 'Land Ownership Rights',
    category: 'Property',
    summary: 'Understand how land ownership works and what documentation you need.',
  },
  {
    id: 'family-law',
    title: 'Family Law Basics',
    category: 'Family',
    summary: 'Learn about marriage, divorce, child custody, and inheritance law.',
  },
  {
    id: 'contracts',
    title: 'Contract Essentials',
    category: 'Business',
    summary: 'See the simple structure of a reliable agreement for services or sales.',
  },
  {
    id: 'employment',
    title: 'Worker Rights & Contracts',
    category: 'Work',
    summary: 'Get clear guidance about employment agreements, pay, and notice periods.',
  },
]

function LegalLibrary() {
  const [items, setItems] = useState<ExtendedSearchItem[]>(FALLBACK_ITEMS)
  const [results, setResults] = useState<ExtendedSearchItem[]>(FALLBACK_ITEMS)
  const [selectedId, setSelectedId] = useState<string | null>(FALLBACK_ITEMS[0]?.id ?? null)

  useEffect(() => {
    api.getLibrary()
      .then((data) => {
        if (data && data.length > 0) {
          const mappedData = data.map((item: any) => ({
            ...item,
            id: String(item.id),
          }))
          setItems(mappedData)
          setResults(mappedData)
          setSelectedId(String(mappedData[0].id))
        }
      })
      .catch(() => { /* use fallback */ })
  }, [])

  useEffect(() => {
    if (results.length === 0) {
      setSelectedId(null)
      return
    }

    if (selectedId === null || !results.some((item) => item.id === selectedId)) {
      setSelectedId(results[0].id)
    }
  }, [results, selectedId])

  const selected = results.find((item) => item.id === selectedId) ?? null

  return (
    <section className="library-section" id="library">
      <div className="section-header">
        <div>
          <p className="eyebrow">Legal Information Library</p>
          <h2>Search easy legal guidance for common situations</h2>
        </div>
      </div>
      <SearchBar items={items} onResults={setResults as (results: SearchItem[]) => void} />
      <div className="library-grid">
        <div className="library-list" role="list">
          {results.map((item) => (
            <button
              type="button"
              key={item.id}
              className={item.id === selected?.id ? 'library-item active' : 'library-item'}
              onClick={() => setSelectedId(item.id)}
            >
              <strong>{item.title}</strong>
              <span>{item.category}</span>
            </button>
          ))}
          {results.length === 0 && (
            <p className="muted">No results found. Try a simpler search term.</p>
          )}
        </div>
        <div className="library-detail">
          {selected ? (
            <>
              <h3>{selected.title}</h3>
              <p>{selected.content || selected.summary}</p>
              {selected.relatedLinks && selected.relatedLinks.length > 0 && (
                <div style={{ marginTop: '20px' }}>
                  <h4>Related Links</h4>
                  <ul>
                    {selected.relatedLinks.map((link, idx) => (
                      <li key={idx}>
                        <a href={link.url} target="_blank" rel="noreferrer">
                          {link.title}
                        </a>
                      </li>
                    ))}
                  </ul>
                </div>
              )}
            </>
          ) : (
            <p className="muted">Search for a topic to see readable legal guidance.</p>
          )}
          <p className="detail-note">
            This library is designed to give fast, readable answers to questions
            without legal jargon.
          </p>
        </div>
      </div>
    </section>
  )
}

export default LegalLibrary
