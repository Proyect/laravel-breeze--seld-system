describe('Sitio público', () => {
  it('carga la página principal', () => {
    cy.visit('/')
    cy.contains(/infrasoft/i).should('be.visible')
    cy.title().should('match', /infrasoft/i)
  })

  it('carga la página de servicios', () => {
    cy.visit('/servicios')
    cy.contains('Nuestros Servicios').should('be.visible')
    cy.contains('Data Science').should('be.visible')
  })

  it('carga el detalle de un servicio', () => {
    cy.visit('/servicios/desarrollo-software')
    cy.url().should('include', '/servicios/desarrollo-software')
    cy.contains('Desarrollo de Software').should('be.visible')
  })

  it('muestra la página de login', () => {
    cy.visit('/login')
    cy.get('#email').should('be.visible')
    cy.get('#password').should('be.visible')
    cy.get('button[type="submit"]').should('be.visible')
  })

  it('carga un artículo del blog', () => {
    cy.visit('/blog/laravel-proximo-proyecto-web')
    cy.contains('Por qué elegir Laravel').should('be.visible')
    cy.contains('Volver al blog').should('be.visible')
  })

  it('carga el listado del blog', () => {
    cy.visit('/blog')
    cy.contains('Últimas publicaciones').should('be.visible')
  })
})
