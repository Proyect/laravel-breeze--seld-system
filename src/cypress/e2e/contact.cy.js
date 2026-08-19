describe('Formulario de contacto', () => {
  it('envía una consulta desde la página principal', () => {
    cy.visit('/')
    cy.get('form[action*="contacto"]').within(() => {
      cy.get('input[name="name"]').invoke('val', 'Test Cypress').trigger('input')
      cy.get('input[name="email"]').invoke('val', 'cypress@test.com').trigger('input')
      cy.get('textarea[name="message"]').invoke('val', 'Mensaje de prueba E2E').trigger('input')
      cy.root().submit()
    })
    cy.url().should('eq', Cypress.config().baseUrl + '/')
  })
})
