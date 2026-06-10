const API_BASE = '/api/public';

export const api = {
  async getTeam() {
    const res = await fetch(`${API_BASE}/team`);
    return res.json();
  },
  async getPracticeAreas() {
    const res = await fetch(`${API_BASE}/practice-areas`);
    return res.json();
  },
  async getStats() {
    const res = await fetch(`${API_BASE}/stats`);
    return res.json();
  },
  async getFAQ() {
    const res = await fetch(`${API_BASE}/faq`);
    return res.json();
  },
  async getLibrary() {
    const res = await fetch(`${API_BASE}/library`);
    return res.json();
  },
  async submitContact(data: { name: string; email: string; phone: string; subject: string; message: string }) {
    const res = await fetch(`${API_BASE}/contact`, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(data),
    });
    return res.json();
  },
};
