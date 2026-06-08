import { useEffect, useState } from 'react'
import SearchBar, { type SearchItem } from './SearchBar'

const libraryItems: SearchItem[] = [
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
  const [results, setResults] = useState<SearchItem[]>(libraryItems)
  const [selectedId, setSelectedId] = useState<string | null>(libraryItems[0]?.id ?? null)

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
      <SearchBar items={libraryItems} onResults={setResults} />
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
              <p>{selected.summary}</p>
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
