describe('Panel de administración', () => {
  beforeEach(() => {
    cy.loginAsAdmin()
  })

  it('muestra el dashboard con enlaces de admin', () => {
    cy.visit('/dashboard')
    cy.contains('Productos').should('be.visible')
    cy.contains('Usuarios').should('be.visible')
    cy.contains('Ventas').should('be.visible')
    cy.contains('Pagos').should('be.visible')
  })

  it('lista productos del seeder', () => {
    cy.visit('/products')
    cy.contains('Productos').should('be.visible')
    cy.contains('Hosting Web Básico', { timeout: 10000 }).should('be.visible')
    cy.contains('Desarrollo Web').should('be.visible')
  })

  it('crea un producto nuevo', () => {
    cy.visit('/products')
    cy.intercept('POST', '/products').as('createProduct')
    cy.contains('Nuevo producto').click()
    cy.get('#modal_data').should('be.visible')
    cy.get('#registration-form [name="name"]').invoke('val', 'Producto Cypress').trigger('input')
    cy.get('#registration-form [name="description"]').invoke('val', 'Creado por test E2E').trigger('input')
    cy.get('#registration-form [name="price"]').invoke('val', '999.99').trigger('input')
    cy.get('#registration-form [name="stock"]').invoke('val', '5').trigger('input')
    cy.get('#registration-form [name="status"]').select('active')
    cy.get('#registration-form').submit()
    cy.wait('@createProduct').then((interception) => {
      expect(interception.response.statusCode).to.eq(200)
      expect(interception.response.body.data.name).to.eq('Producto Cypress')
    })
  })

  it('lista usuarios registrados', () => {
    cy.visit('/users')
    cy.contains('Usuarios').should('be.visible')
    cy.get('table#data tbody').contains('admin@infrasoft.com.ar', { timeout: 10000 }).should('exist')
    cy.get('table#data tbody').contains('user@example.com').should('exist')
  })
})

describe('Restricciones de rol', () => {
  beforeEach(() => {
    cy.loginAsUser()
  })

  it('bloquea acceso a productos para usuarios no admin', () => {
    cy.visit('/products', { failOnStatusCode: false })
    cy.contains('403').should('be.visible')
  })

  it('bloquea acceso a usuarios para no admin', () => {
    cy.visit('/users', { failOnStatusCode: false })
    cy.contains('403').should('be.visible')
  })
})
