import { getGreeting } from '../support/app.po';

describe('nootz', () => {
  beforeEach(() => cy.visit('/'));

  it('should display welcome message', () => {
    getGreeting().contains('Welcome to nootz!');
  });
});
