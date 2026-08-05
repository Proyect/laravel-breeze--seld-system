describe('Autenticación', () => {
  it('permite iniciar sesión como admin', () => {
    cy.visit('/login')
    cy.get('#email').type('admin@infrasoft.com.ar')
    cy.get('#password').type('password')
    cy.get('button[type="submit"]').click()
    cy.url().should('include', '/dashboard')
    cy.contains(/panel de control|dashboard/i).should('be.visible')
  })

  it('permite iniciar sesión como usuario regular', () => {
    cy.visit('/login')
    cy.get('#email').type('user@example.com')
    cy.get('#password').type('password')
    cy.get('button[type="submit"]').click()
    cy.url().should('include', '/dashboard')
  })

  it('rechaza credenciales inválidas', () => {
    cy.visit('/login')
    cy.get('#email').type('wrong@example.com')
    cy.get('#password').type('wrongpassword')
    cy.get('button[type="submit"]').click()
    cy.url().should('include', '/login')
  })

  it('permite cerrar sesión', () => {
    cy.loginAsAdmin()
    cy.visit('/dashboard')
    cy.get('nav button').first().click()
    cy.contains('Log Out').click({ force: true })
    cy.url().should('not.include', '/dashboard')
  })

  it('redirige al login al acceder al dashboard sin autenticación', () => {
    cy.visit('/dashboard')
    cy.url().should('include', '/login')
  })
})
