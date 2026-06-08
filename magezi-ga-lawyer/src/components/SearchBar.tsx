import { useMemo, useState } from 'react'

export interface SearchItem {
  id: string
  title: string
  category: string
  summary: string
}

interface SearchBarProps {
  items: SearchItem[]
  onResults: (results: SearchItem[]) => void
}

function SearchBar({ items, onResults }: SearchBarProps) {
  const [query, setQuery] = useState('')

  const results = useMemo(() => {
    const normalized = query.trim().toLowerCase()
    if (!normalized) {
      return items
    }

    return items.filter((item) => {
      return (
        item.title.toLowerCase().includes(normalized) ||
        item.summary.toLowerCase().includes(normalized) ||
        item.category.toLowerCase().includes(normalized)
      )
    })
  }, [items, query])

  return (
    <div className="search-block">
      <label htmlFor="legal-search" className="visually-hidden">
        Search legal library
      </label>
      <input
        id="legal-search"
        type="search"
        value={query}
        onChange={(event) => setQuery(event.target.value)}
        placeholder="Search guides, templates, and cases"
        className="search-input"
        aria-label="Search legal information library"
      />
      <button
        type="button"
        className="search-button"
        onClick={() => onResults(results)}
      >
        Search
      </button>
    </div>
  )
}

export default SearchBar
