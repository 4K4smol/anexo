import './App.css'

const navLinks = [
  { label: 'Inicio', href: '#home' },
  { label: 'Cómo funciona', href: '#how-it-works' },
  { label: 'Sobre', href: '#about' },
  { label: 'Casos de uso', href: '#use-cases' }
]

const valueProps = [
  { icon: '🗂️', title: 'Organiza', text: 'Centraliza ideas, propuestas y recursos en una sola vista clara.' },
  { icon: '🤝', title: 'Conecta', text: 'Suma a personas y organizaciones con objetivos compatibles.' },
  { icon: '🚀', title: 'Ejecuta', text: 'Coordina tareas, responsables y tiempos sin fricción.' },
  { icon: '📊', title: 'Evalúa', text: 'Monitorea avances, resultados y aprendizajes compartidos.' }
]

const howItWorksSteps = [
  { title: 'Entra', description: 'Regístrate o entra con tu cuenta para explorar la comunidad.' },
  { title: 'Crea o únete', description: 'Inicia una idea o súmate a proyectos activos que necesiten tu perfil.' },
  { title: 'Colabora', description: 'Comparte tareas, archivos y conversaciones en un mismo flujo.' },
  { title: 'Resultados', description: 'Publica avances, mide impacto y comparte aprendizajes.' }
]

const useCases = [
  { title: 'Estudiantes', description: 'Organiza equipos para tesis, hackatones o proyectos de impacto social.' },
  { title: 'Asociaciones', description: 'Coordina voluntarios, eventos y campañas con claridad y seguimiento.' },
  { title: 'Comunidad', description: 'Lanza iniciativas barriales y conecta con vecinos y aliados.' },
  { title: 'Individual', description: 'Lleva tus ideas personales a acción con colaboración transparente.' }
]

const featuredItems = [
  { title: 'Mapa de reciclaje local', tag: 'Proyecto activo', cta: 'Ver más' },
  { title: 'Banco de horas solidarias', tag: 'Idea en validación', cta: 'Ver más' },
  { title: 'Festival estudiantil 2025', tag: 'Coordinación', cta: 'Ver más' },
  { title: 'Mentorías tech', tag: 'Abierto a voluntarios', cta: 'Ver más' }
]

const trustMetrics = [
  { value: '1,200+', label: 'Propuestas impulsadas' },
  { value: '320', label: 'Proyectos activos' },
  { value: '48h', label: 'Tiempo medio de publicación' },
  { value: 'Comunidad segura', label: 'Moderación y trazabilidad' }
]

const faqs = [
  { question: '¿Qué es Anexo?', answer: 'Una plataforma colaborativa para impulsar proyectos y conectar personas que quieren hacerlos realidad.' },
  { question: '¿Quién puede participar?', answer: 'Estudiantes, organizaciones, comunidades o individuos con ideas o ganas de apoyar.' },
  { question: '¿Cómo se modera el contenido?', answer: 'Con revisiones comunitarias, reportes rápidos y guías claras de participación.' },
  { question: '¿Es gratis?', answer: 'Sí, puedes explorar, crear y colaborar sin costo. Pronto habrá planes avanzados para equipos.' },
  { question: '¿Puedo migrar mi proyecto actual?', answer: 'Sí, importa tareas y miembros o comparte un enlace de invitación para arrancar.' }
]

function PublicLayout({ children }) {
  return (
    <div className="layout">
      <Header />
      <main id="home" className="main-content">{children}</main>
      <Footer />
    </div>
  )
}

function Header() {
  return (
    <header className="header">
      <div className="container header-inner">
        <div className="logo">Anexo</div>
        <nav className="nav">
          {navLinks.map((link) => (
            <a key={link.href} href={link.href} className="nav-link">
              {link.label}
            </a>
          ))}
        </nav>
        <div className="header-actions">
          <a className="secondary-btn" href="#how-it-works">
            Ver cómo funciona
          </a>
          <a className="primary-btn" href="#about">
            Entrar / Registrarse
          </a>
        </div>
      </div>
    </header>
  )
}

function HeroSection() {
  return (
    <section className="section hero">
      <div className="container hero-grid">
        <div className="hero-copy">
          <p className="eyebrow">Plataforma colaborativa</p>
          <h1>La forma más sencilla de impulsar proyectos en comunidad</h1>
          <p className="subtitle">
            Anexo conecta personas, ideas y recursos para que puedas organizar, coordinar y mostrar avances en un solo lugar.
          </p>
          <div className="cta-row">
            <a className="primary-btn" href="#about">
              Empezar ahora
            </a>
            <a className="ghost-btn" href="#how-it-works">
              Ver cómo funciona
            </a>
          </div>
          <div className="hero-tags">
            <span>Equipos claros</span>
            <span>Enfoque en resultados</span>
            <span>Colaboración segura</span>
          </div>
        </div>
        <div className="hero-visual">
          <div className="mockup">
            <div className="mockup-header">
              <div className="dot" />
              <div className="dot" />
              <div className="dot" />
              <span className="mockup-title">Panel de proyectos</span>
            </div>
            <div className="mockup-body">
              {featuredItems.slice(0, 3).map((item) => (
                <div key={item.title} className="mockup-card">
                  <div>
                    <p className="mockup-card-title">{item.title}</p>
                    <p className="mockup-card-tag">{item.tag}</p>
                  </div>
                  <span className="status-dot" />
                </div>
              ))}
              <div className="mockup-footer">Colabora en tiempo real y comparte avances.</div>
            </div>
          </div>
        </div>
      </div>
    </section>
  )
}

function ValuePropsSection() {
  return (
    <section className="section" id="value-props">
      <div className="container">
        <div className="section-header">
          <p className="eyebrow">Beneficios clave</p>
          <h2>Diseñada para actuar rápido</h2>
          <p className="section-subtitle">Cada bloque responde a un paso claro: organizar, conectar, ejecutar y evaluar.</p>
        </div>
        <div className="grid cols-4">
          {valueProps.map((item) => (
            <div key={item.title} className="card value-card">
              <div className="icon-circle">{item.icon}</div>
              <h3>{item.title}</h3>
              <p>{item.text}</p>
            </div>
          ))}
        </div>
      </div>
    </section>
  )
}

function HowItWorksSection() {
  return (
    <section className="section muted" id="how-it-works">
      <div className="container">
        <div className="section-header">
          <p className="eyebrow">Cómo funciona</p>
          <h2>De la idea al resultado en cuatro pasos</h2>
          <p className="section-subtitle">Pensado para reducir fricción y mantener a todos alineados.</p>
        </div>
        <div className="grid cols-4 steps-grid">
          {howItWorksSteps.map((step, index) => (
            <div key={step.title} className="card step-card">
              <div className="step-number">{index + 1}</div>
              <div>
                <h3>{step.title}</h3>
                <p>{step.description}</p>
              </div>
            </div>
          ))}
        </div>
      </div>
    </section>
  )
}

function UseCasesSection() {
  return (
    <section className="section" id="use-cases">
      <div className="container">
        <div className="section-header">
          <p className="eyebrow">Casos de uso</p>
          <h2>Escenarios listos para empezar</h2>
          <p className="section-subtitle">Selecciona un caso y adapta tus flujos con plantillas rápidas.</p>
        </div>
        <div className="grid cols-4">
          {useCases.map((item) => (
            <div key={item.title} className="card use-case-card">
              <div className="card-heading">
                <span className="pill">{item.title}</span>
              </div>
              <p>{item.description}</p>
              <a className="link" href="#about">
                Empezar con {item.title}
              </a>
            </div>
          ))}
        </div>
      </div>
    </section>
  )
}

function FeaturedSection() {
  return (
    <section className="section muted" id="featured">
      <div className="container">
        <div className="section-header">
          <p className="eyebrow">Contenido vivo</p>
          <h2>Actividad reciente en Anexo</h2>
          <p className="section-subtitle">Explora ideas y proyectos destacados para inspirarte.</p>
        </div>
        <div className="grid cols-3">
          {featuredItems.map((item) => (
            <div key={item.title} className="card featured-card">
              <div>
                <h3>{item.title}</h3>
                <p className="pill subtle">{item.tag}</p>
              </div>
              <button className="ghost-btn small">{item.cta}</button>
            </div>
          ))}
        </div>
      </div>
    </section>
  )
}

function TrustSection() {
  return (
    <section className="section" id="about">
      <div className="container">
        <div className="section-header">
          <p className="eyebrow">Confianza</p>
          <h2>Métricas y promesas claras</h2>
          <p className="section-subtitle">Anexo se construye con transparencia, seguridad y seguimiento real.</p>
        </div>
        <div className="grid cols-4 trust-grid">
          {trustMetrics.map((metric) => (
            <div key={metric.label} className="card trust-card">
              <h3>{metric.value}</h3>
              <p>{metric.label}</p>
            </div>
          ))}
        </div>
      </div>
    </section>
  )
}

function FaqSection() {
  return (
    <section className="section muted" id="faq">
      <div className="container">
        <div className="section-header">
          <p className="eyebrow">FAQ</p>
          <h2>Preguntas frecuentes</h2>
          <p className="section-subtitle">Resolvemos las dudas más comunes para que decidas rápido.</p>
        </div>
        <div className="faq-grid">
          {faqs.map((item) => (
            <details key={item.question} className="faq-item" open>
              <summary>{item.question}</summary>
              <p>{item.answer}</p>
            </details>
          ))}
        </div>
      </div>
    </section>
  )
}

function FinalCtaSection() {
  return (
    <section className="section final-cta" id="final-cta">
      <div className="container final-cta-inner">
        <div>
          <p className="eyebrow">¿Listo para sumarte?</p>
          <h2>Activa tu siguiente proyecto en Anexo</h2>
          <p className="section-subtitle">Crea un espacio, invita a tu equipo y comparte avances en minutos.</p>
        </div>
        <a className="primary-btn large" href="#about">
          Entrar / Registrarse
        </a>
      </div>
    </section>
  )
}

function Footer() {
  return (
    <footer className="footer" id="footer">
      <div className="container footer-inner">
        <div>
          <div className="logo">Anexo</div>
          <p className="footer-text">Impulsando colaboración segura y transparente.</p>
        </div>
        <div className="footer-links">
          <a href="#about">Sobre</a>
          <a href="#faq">FAQ</a>
          <a href="#">Términos</a>
          <a href="#">Privacidad</a>
          <a href="#">Contacto</a>
        </div>
      </div>
    </footer>
  )
}

function App() {
  return (
    <PublicLayout>
      <HeroSection />
      <ValuePropsSection />
      <HowItWorksSection />
      <UseCasesSection />
      <FeaturedSection />
      <TrustSection />
      <FaqSection />
      <FinalCtaSection />
    </PublicLayout>
  )
}

export default App
