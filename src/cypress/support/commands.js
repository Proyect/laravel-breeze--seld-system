Cypress.Commands.add('login', (email = 'admin@infrasoft.com.ar', password = 'password') => {
  cy.session([email, password], () => {
    cy.visit('/login')
    cy.get('#email').clear().type(email)
    cy.get('#password').clear().type(password)
    cy.get('button[type="submit"]').contains(/log in|iniciar/i).click()
    cy.url().should('include', '/dashboard')
  })
})

Cypress.Commands.add('loginAsAdmin', () => {
  cy.login('admin@infrasoft.com.ar', 'password')
})

Cypress.Commands.add('loginAsUser', () => {
  cy.login('user@example.com', 'password')
})
