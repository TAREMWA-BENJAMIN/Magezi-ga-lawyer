import { useMemo, useState } from 'react'

interface TemplateField {
  key: string
  label: string
  placeholder: string
  type: 'text' | 'date' | 'textarea'
}

interface TemplateDefinition {
  id: string
  title: string
  description: string
  fields: TemplateField[]
}

const templates: TemplateDefinition[] = [
  {
    id: 'simple-agreement',
    title: 'Simple Agreement',
    description: 'Create a short agreement that is easy to customize and sign.',
    fields: [
      { key: 'partyA', label: 'Your name', placeholder: 'e.g. John Doe', type: 'text' },
      { key: 'partyB', label: 'Other party', placeholder: 'e.g. Jane Akello', type: 'text' },
      { key: 'startDate', label: 'Start date', placeholder: 'YYYY-MM-DD', type: 'date' },
      { key: 'purpose', label: 'Purpose', placeholder: 'What is the agreement for?', type: 'textarea' },
    ],
  },
  {
    id: 'power-of-attorney',
    title: 'Power of Attorney',
    description: 'Draft a clear authorization letter for a trusted representative.',
    fields: [
      { key: 'principal', label: 'Principal name', placeholder: 'Your full name', type: 'text' },
      { key: 'agent', label: 'Agent name', placeholder: 'Representative name', type: 'text' },
      { key: 'scope', label: 'Scope of power', placeholder: 'What can they do?', type: 'textarea' },
      { key: 'expiryDate', label: 'Expiry date', placeholder: 'YYYY-MM-DD', type: 'date' },
    ],
  },
]

function TemplateFormBuilder() {
  const [selectedTemplateId, setSelectedTemplateId] = useState(templates[0].id)
  const template = templates.find((item) => item.id === selectedTemplateId) ?? templates[0]
  const [formState, setFormState] = useState<Record<string, string>>({})

  const preview = useMemo(() => {
    const values = (template.fields || []).reduce((acc, field) => {
      acc[field.key] = formState[field.key] || `(${field.label})`
      return acc
    }, {} as Record<string, string>)

    if (template.id === 'simple-agreement') {
      return `This agreement is made on ${values.startDate} between ${values.partyA} and ${values.partyB}. The parties agree that ${values.purpose}.`
    }

    if (template.id === 'power-of-attorney') {
      return `I, ${values.principal}, appoint ${values.agent} to act on my behalf for ${values.scope} until ${values.expiryDate}.`
    }

    return ''
  }, [formState, template])

  return (
    <section className="templates-section" id="templates">
      <div className="section-header">
        <div>
          <p className="eyebrow">Document templates</p>
          <h2>Build legal documents .</h2>
        </div>
      </div>
      <div className="template-layout">
        <aside className="template-sidebar">
          {templates.map((item) => (
            <button
              key={item.id}
              type="button"
              className={item.id === selectedTemplateId ? 'template-card selected' : 'template-card'}
              onClick={() => setSelectedTemplateId(item.id)}
            >
              <strong>{item.title}</strong>
              <span>{item.description}</span>
            </button>
          ))}
        </aside>
        <div className="template-builder">
          <form className="document-form" onSubmit={(event) => event.preventDefault()}>
            {template.fields.map((field) => (
              <label key={field.key} className="field-row">
                <span>{field.label}</span>
                {field.type === 'textarea' ? (
                  <textarea
                    value={formState[field.key] ?? ''}
                    placeholder={field.placeholder}
                    onChange={(event) =>
                      setFormState((current) => ({ ...current, [field.key]: event.target.value }))
                    }
                  />
                ) : (
                  <input
                    type={field.type}
                    value={formState[field.key] ?? ''}
                    placeholder={field.placeholder}
                    onChange={(event) =>
                      setFormState((current) => ({ ...current, [field.key]: event.target.value }))
                    }
                  />
                )}
              </label>
            ))}
            <button className="document-submit" type="button">
              Preview document
            </button>
          </form>
          <div className="document-preview">
            <p className="preview-label">Document preview</p>
            <p>{preview}</p>
          </div>
        </div>
      </div>
    </section>
  )
}

export default TemplateFormBuilder
