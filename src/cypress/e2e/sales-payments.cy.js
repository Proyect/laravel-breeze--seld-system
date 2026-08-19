describe('Ventas y pagos', () => {
  beforeEach(() => {
    cy.loginAsUser()
  })

  it('muestra la página de ventas', () => {
    cy.visit('/sales')
    cy.contains('Ventas').should('be.visible')
  })

  it('muestra la página de pagos', () => {
    cy.visit('/payments')
    cy.contains('Pagos').should('be.visible')
    cy.contains('Nuevo pago').should('be.visible')
  })

  it('muestra el formulario de nuevo pago', () => {
    cy.visit('/payments')
    cy.get('input[name="amount"]').should('be.visible')
    cy.get('select[name="currency"]').should('be.visible')
    cy.get('button[type="submit"]').contains(/iniciar pago/i).should('be.visible')
  })
})

describe('Pagos - admin', () => {
  beforeEach(() => {
    cy.loginAsAdmin()
  })

  it('accede a rutas de éxito y cancelación de pago', () => {
    cy.visit('/payments/success')
    cy.contains('Pago exitoso').should('be.visible')
    cy.visit('/payments/cancel')
    cy.contains('Pago cancelado').should('be.visible')
  })
})
