import { useState } from 'react'
import { Link } from 'react-router-dom'

interface Template {
  id: string
  title: string
  description: string
  category: string
  pages: number
  format: string
  content: string
}

const templates: Template[] = [
  {
    id: 'tpl-001',
    title: 'Simple Tenancy Agreement',
    description:
      'A straightforward residential rental agreement suitable for monthly or annual tenancies. Covers rent, deposit, maintenance obligations, and notice periods under the Landlord and Tenant Act 2022.',
    category: 'Property & Land',
    pages: 3,
    format: 'DOCX',
    content: `TENANCY AGREEMENT

This Tenancy Agreement is entered into on _____________ between:

LANDLORD: _____________________________ (hereinafter "the Landlord")
Address: _____________________________

TENANT: _____________________________ (hereinafter "the Tenant")
National ID / Passport No.: _____________

PROPERTY: The Landlord agrees to let and the Tenant agrees to rent the property situated at:
_______________________________________________

TERM: From _____________ to _____________ (unless terminated earlier in accordance with this Agreement).

RENT: UGX _____________ per month, payable in advance on the _____ day of each month.

SECURITY DEPOSIT: UGX _____________ (refundable within 30 days of vacating, subject to deductions for damage).

UTILITIES: [ ] Included in rent   [ ] Payable separately by Tenant

LANDLORD OBLIGATIONS:
1. To maintain the property in good repair.
2. To ensure the property is habitable at the commencement of the tenancy.

TENANT OBLIGATIONS:
1. To pay rent on the agreed date.
2. Not to sublet without the Landlord's written consent.
3. To notify the Landlord of any defects promptly.
4. Not to use the property for illegal purposes.

NOTICE TO VACATE: Either party may terminate this Agreement by giving _____ months' written notice.

Signed by the Landlord: _____________________ Date: _________
Signed by the Tenant: ______________________ Date: _________
Witness: __________________________________ Date: _________

NOTE: This template is for guidance only. For complex tenancies or disputes, consult a qualified lawyer.`,
  },
  {
    id: 'tpl-002',
    title: 'Employment Contract (Standard)',
    description:
      'A standard employment contract for full-time employees, compliant with the Uganda Employment Act 2006. Covers position, salary, leave, termination, and confidentiality.',
    category: 'Employment',
    pages: 4,
    format: 'DOCX',
    content: `EMPLOYMENT CONTRACT

This Contract of Employment is made on _____________ between:

EMPLOYER: _____________________________ (hereinafter "the Company")
Registration No.: _______________________
Address: _____________________________

EMPLOYEE: _____________________________ (hereinafter "the Employee")
National ID: __________________________
Address: _____________________________

1. POSITION
   The Employee is employed as _____________________________ in the _____________________ department.

2. COMMENCEMENT DATE
   Employment commences on _____________.

3. PROBATION
   The Employee shall serve a probationary period of _____ months, during which either party may terminate by giving 2 weeks' notice.

4. REMUNERATION
   Basic Salary: UGX _____________ per month
   Allowances: _____________________________
   Payment Date: The _____ day of each month.

5. WORKING HOURS
   Standard working hours are _____ am to _____ pm, Monday to Friday.

6. ANNUAL LEAVE
   The Employee is entitled to _____ days of paid annual leave per year, in addition to Ugandan public holidays.

7. SICK LEAVE
   Up to _____ days of paid sick leave per year, subject to a valid medical certificate.

8. NOTICE OF TERMINATION
   After probation, either party must give _____ months' written notice of termination.
   The Employer may terminate for gross misconduct without notice following a fair disciplinary hearing.

9. CONFIDENTIALITY
   The Employee shall not disclose any confidential business information during or after employment.

10. GOVERNING LAW
    This contract is governed by the laws of the Republic of Uganda.

Signed by the Employer: _________________ Date: _________
Signed by the Employee: _________________ Date: _________
Witness: ________________________________ Date: _________`,
  },
  {
    id: 'tpl-003',
    title: 'Statutory Declaration',
    description:
      'A general-purpose statutory declaration that can be adapted for various legal purposes such as change of name, lost documents, or confirming facts.',
    category: 'General',
    pages: 1,
    format: 'DOCX',
    content: `STATUTORY DECLARATION

I, _____________________________ of _____________________________ (address),
National ID No. _____________________________,
do hereby solemnly and sincerely declare as follows:

1. _____________________________________________
2. _____________________________________________
3. _____________________________________________

And I make this solemn declaration conscientiously believing the same to be true and by virtue of the provisions of the Oaths Act, Cap. 19 of the Laws of Uganda.

Declared at _____________________________ this _____ day of _____________ 20_____.

Signature of Declarant: _____________________________

Before me:

Signature of Commissioner for Oaths / Magistrate: _____________________________
Name: _____________________________
Stamp: `,
  },
  {
    id: 'tpl-004',
    title: 'Demand Letter (Debt Recovery)',
    description:
      'A formal letter demanding payment of an outstanding debt before initiating court proceedings. Suitable for individuals and businesses owed money.',
    category: 'Commercial',
    pages: 1,
    format: 'DOCX',
    content: `[YOUR NAME / COMPANY NAME]
[Your Address]
[Date]

[DEBTOR'S FULL NAME]
[Debtor's Address]

RE: FORMAL DEMAND FOR PAYMENT OF UGX _____________________________

Dear [Debtor's Name],

I / We write to formally demand immediate payment of the sum of UGX _____________________________ (Uganda Shillings _________________________), which is owed to us in respect of:

[Brief description of the debt, e.g., "goods supplied on credit on _____________ under Invoice No. _____."]

Despite previous requests for payment on _____________ and _____________, this debt remains outstanding.

TAKE NOTICE that unless full payment is received by us within FOURTEEN (14) days of the date of this letter, we shall, without further notice, institute legal proceedings against you for recovery of the said sum, together with accrued interest and costs of the suit.

We urge you to treat this matter with the urgency it deserves to avoid unnecessary legal costs on both sides.

Yours faithfully,

_____________________________
[Your Name / Authorised Signatory]

cc: File`,
  },
  {
    id: 'tpl-005',
    title: 'Board Resolution (Company)',
    description:
      'A standard board resolution template for common company decisions such as opening a bank account, authorising a signatory, or approving a contract.',
    category: 'Commercial',
    pages: 1,
    format: 'DOCX',
    content: `RESOLUTION OF THE BOARD OF DIRECTORS OF
[COMPANY NAME] (Registration No. _________________)

At a meeting of the Board of Directors of _____________________________ held at _____________________________ on _____________ at _____ am / pm, the following resolution was duly passed:

RESOLVED THAT:

1. _____________________________________________

2. _____________________________________________

3. _____________________________________________

AND FURTHER RESOLVED THAT the _____________________________ [position, e.g., Managing Director] be and is hereby authorised to sign all documents and take all actions necessary to give effect to the foregoing resolutions.

Certified as a true copy of the resolution passed at the said meeting.

_____________________________ _____________________________
Chairperson                    Secretary

Date: _____________________________`,
  },
  {
    id: 'tpl-006',
    title: 'Affidavit (General Purpose)',
    description:
      'A general-purpose affidavit for use in court proceedings, administrative matters, or statutory purposes. Must be sworn before a Commissioner for Oaths.',
    category: 'General',
    pages: 1,
    format: 'DOCX',
    content: `IN THE [COURT NAME] AT [LOCATION]

CIVIL SUIT / MISC. APPLICATION NO. __________ OF 20_____

BETWEEN

_____________________________ ................ APPLICANT / PLAINTIFF

AND

_____________________________ ................ RESPONDENT / DEFENDANT

AFFIDAVIT IN SUPPORT

I, _____________________________, of _____________________________, do solemnly make oath and say as follows:

1. That I am the Applicant / Plaintiff in the above-captioned matter and I am duly authorised to swear this affidavit.

2. That the facts deposed to herein are within my own knowledge and are true to the best of my knowledge and belief, save where stated to be on information and belief, in which case I verily believe them to be true.

3. _______________________________________________

4. _______________________________________________

5. WHEREFORE I humbly pray that this Honourable Court grants the orders sought.

Sworn at _____________________________ this _____ day of _____________ 20_____
by the said _____________________________.

_____________________________
DEPONENT

Before me:
_____________________________
COMMISSIONER FOR OATHS`,
  },
]

const categories = ['All', ...Array.from(new Set(templates.map((t) => t.category)))]

function DocumentTemplatesPage() {
  const [activeCategory, setActiveCategory] = useState('All')
  const [previewId, setPreviewId] = useState<string | null>(null)

  const filtered = activeCategory === 'All' ? templates : templates.filter((t) => t.category === activeCategory)
  const previewing = templates.find((t) => t.id === previewId)

  const downloadTemplate = (template: Template) => {
    const blob = new Blob([template.content], { type: 'text/plain;charset=utf-8' })
    const url = URL.createObjectURL(blob)
    const a = document.createElement('a')
    a.href = url
    a.download = `${template.title.replace(/\s+/g, '_')}_MageziLaw.txt`
    a.click()
    URL.revokeObjectURL(url)
  }

  return (
    <div className="templates-page">
      {/* ── Page Header ── */}
      <section className="page-header">
        <nav className="breadcrumb" aria-label="Breadcrumb">
          <Link to="/">Home</Link>
          <span aria-hidden="true">›</span>
          <span aria-current="page">Document Templates</span>
        </nav>
        <h1>Legal Document Templates</h1>
        <p>
          Free, professionally drafted legal document templates for common Ugandan legal matters.
          Download and adapt them to your situation — or contact us for a bespoke document.
        </p>
      </section>

      {/* ── Disclaimer ── */}
      <aside className="template-disclaimer" role="note">
        <span aria-hidden="true">⚠️</span>
        <p>
          <strong>Important:</strong> These templates are provided for general guidance only and do not
          constitute legal advice. For complex matters, always consult a qualified lawyer before using
          any legal document.
        </p>
      </aside>

      {/* ── Category Filter ── */}
      <section className="faq-filters" aria-label="Filter templates by category">
        <div className="filter-tabs" role="tablist">
          {categories.map((cat) => (
            <button
              key={cat}
              role="tab"
              aria-selected={activeCategory === cat}
              className={`filter-tab ${activeCategory === cat ? 'filter-tab--active' : ''}`}
              onClick={() => setActiveCategory(cat)}
            >
              {cat}
            </button>
          ))}
        </div>
      </section>

      {/* ── Templates Grid ── */}
      <section className="templates-grid" aria-label="Document templates">
        {filtered.map((template) => (
          <article className="template-card" key={template.id}>
            <div className="template-card-header">
              <span className="template-format-badge">{template.format}</span>
              <span className="template-pages">{template.pages} page{template.pages !== 1 ? 's' : ''}</span>
            </div>
            <h2>{template.title}</h2>
            <span className="template-category-tag">{template.category}</span>
            <p>{template.description}</p>
            <div className="template-actions">
              <button
                className="template-preview-btn"
                onClick={() => setPreviewId(previewId === template.id ? null : template.id)}
                aria-expanded={previewId === template.id}
              >
                {previewId === template.id ? 'Hide Preview' : 'Preview'}
              </button>
              <button
                className="hero-button"
                onClick={() => downloadTemplate(template)}
                aria-label={`Download ${template.title}`}
              >
                ⬇ Download
              </button>
            </div>
            {previewId === template.id && (
              <pre className="template-preview-content">{template.content}</pre>
            )}
          </article>
        ))}
      </section>

      {/* ── Preview Modal (large screen) ── */}
      {previewing && (
        <div
          className="template-modal-overlay"
          role="dialog"
          aria-modal="true"
          aria-label={`Preview: ${previewing.title}`}
          onClick={(e) => { if (e.target === e.currentTarget) setPreviewId(null) }}
        >
          <div className="template-modal">
            <div className="template-modal-header">
              <h2>{previewing.title}</h2>
              <button className="modal-close-btn" onClick={() => setPreviewId(null)} aria-label="Close preview">✕</button>
            </div>
            <pre className="template-modal-content">{previewing.content}</pre>
            <button className="hero-button" onClick={() => downloadTemplate(previewing)}>
              ⬇ Download Template
            </button>
          </div>
        </div>
      )}

      {/* ── CTA ── */}
      <section className="cta-section">
        <div className="cta-content">
          <h2>Need a Custom Document?</h2>
          <p>
            Our lawyers can draft bespoke legal documents tailored to your specific situation,
            ensuring they are legally sound and enforceable in Uganda.
          </p>
          <Link className="hero-button" to="/contact">Request a Custom Draft</Link>
        </div>
      </section>
    </div>
  )
}

export default DocumentTemplatesPage
