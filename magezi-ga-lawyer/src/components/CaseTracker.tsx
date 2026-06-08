import { useState } from 'react'
import { useCaseContext } from '../contexts/CaseContext'

function CaseTracker() {
  const { cases, addCase, updateStatus } = useCaseContext()
  const [title, setTitle] = useState('')
  const [notes, setNotes] = useState('')

  return (
    <section className="case-section" id="cases">
      <div className="section-header">
        <div>
          <p className="eyebrow">Case tracking</p>
          <h2>Keep case details local and easy to review.</h2>
        </div>
      </div>
      <div className="case-grid">
        <div className="case-form-card">
          <h3>Add a new case note</h3>
          <form
            onSubmit={(event) => {
              event.preventDefault()
              if (!title.trim()) return
              addCase(title, notes)
              setTitle('')
              setNotes('')
            }}
          >
            <label>
              Case title
              <input
                type="text"
                value={title}
                onChange={(event) => setTitle(event.target.value)}
                placeholder="e.g. Land dispute with buyer"
              />
            </label>
            <label>
              Notes
              <textarea
                value={notes}
                onChange={(event) => setNotes(event.target.value)}
                placeholder="Add important details here"
              />
            </label>
            <button type="submit" className="document-submit">
              Save note locally
            </button>
          </form>
        </div>
        <div className="case-list-card">
          <h3>Recent case items</h3>
          {cases.length === 0 ? (
            <p className="muted">No case notes yet. Add one to begin tracking.</p>
          ) : (
            <ul className="case-list">
              {cases.map((caseItem) => (
                <li key={caseItem.id} className="case-item">
                  <div>
                    <strong>{caseItem.title}</strong>
                    <p>{caseItem.notes}</p>
                  </div>
                  <div className="case-meta">
                    <span>{caseItem.status}</span>
                    <select
                      value={caseItem.status}
                      onChange={(event) => updateStatus(caseItem.id, event.target.value as any)}
                      aria-label={`Update status for ${caseItem.title}`}
                    >
                      <option value="Open">Open</option>
                      <option value="In review">In review</option>
                      <option value="Resolved">Resolved</option>
                    </select>
                  </div>
                </li>
              ))}
            </ul>
          )}
        </div>
      </div>
    </section>
  )
}

export default CaseTracker
