import { Link } from 'react-router-dom'
import { useState, useEffect } from 'react'
import { api } from '../services/api'
import './ActsPage.css'

interface Act {
  id: number;
  title: string;
  description: string;
  year: string;
  file_path: string;
  file_size: string;
}

function ActsPage() {
  const [acts, setActs] = useState<Act[]>([]);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    api.getActs()
      .then(data => {
        setActs(data);
        setLoading(false);
      })
      .catch(err => {
        console.error(err);
        setLoading(false);
      });
  }, []);

  const openPdf = (path: string) => {
    // Assuming Vite proxies API requests, we can just use the path or construct full url.
    // Assuming backend is at VITE_API_URL or defaults to localhost:8000
    const API_URL = import.meta.env.VITE_API_URL || 'http://localhost:8000';
    window.open(`${API_URL}/storage/${path}`, '_blank');
  };

  return (
    <div className="acts-page">
      <section className="page-header">
        <nav className="breadcrumb" aria-label="Breadcrumb">
          <Link to="/">Home</Link>
          <span aria-hidden="true">›</span>
          <span aria-current="page">Client Portal</span>
        </nav>
        <h1>Legal Acts & Documents</h1>
        <p>
          Welcome to your client portal. Here you can securely access, read, and download important legal acts and case documents.
        </p>
      </section>

      <section className="acts-section">
        {loading ? (
          <p>Loading acts...</p>
        ) : acts.length === 0 ? (
          <p>No documents available yet.</p>
        ) : (
          <div className="acts-grid">
            {acts.map((act) => (
              <div key={act.id} className="act-card">
                <div className="act-card-header">
                  <div className="act-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round">
                      <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                      <polyline points="14 2 14 8 20 8"></polyline>
                      <line x1="16" y1="13" x2="8" y2="13"></line>
                      <line x1="16" y1="17" x2="8" y2="17"></line>
                      <polyline points="10 9 9 9 8 9"></polyline>
                    </svg>
                  </div>
                  <span className="act-year">{act.year}</span>
                </div>
                <h3 className="act-title">{act.title}</h3>
                <p className="act-description">{act.description}</p>
                <div className="act-actions">
                  <button className="btn-read" onClick={() => openPdf(act.file_path)}>
                    Read PDF
                  </button>
                  <span className="act-size">{act.file_size}</span>
                </div>
              </div>
            ))}
          </div>
        )}
      </section>
    </div>
  )
}

export default ActsPage
