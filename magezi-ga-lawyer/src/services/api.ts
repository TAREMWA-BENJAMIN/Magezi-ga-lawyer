const API_BASE = (import.meta.env.VITE_API_URL as string | undefined) 
  ? `${import.meta.env.VITE_API_URL}/api/public`
  : '/api/public';

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
  async getHeroSlides() {
    const res = await fetch(`${API_BASE}/hero-slides`);
    return res.json();
  },
  async getMilestones() {
    const res = await fetch(`${API_BASE}/milestones`)
    if (!res.ok) throw new Error('Failed to fetch milestones')
    return res.json()
  },

  async getCoreValues() {
    const res = await fetch(`${API_BASE}/core-values`)
    if (!res.ok) throw new Error('Failed to fetch core values')
    return res.json()
  },

  async getTestimonials() {
    const res = await fetch(`${API_BASE}/testimonials`)
    if (!res.ok) throw new Error('Failed to fetch testimonials')
    return res.json()
  },

  async getSiteSettings() {
    const res = await fetch(`${API_BASE}/site-settings`)
    if (!res.ok) throw new Error('Failed to fetch site settings')
    return res.json()
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
