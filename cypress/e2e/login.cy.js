describe('Pengujian Fitur Login Website Informasi', () => {
  
  const loginUrl = 'http://127.0.0.1:8000/login'; 

  const validEmail = 'admin@example.com';
  const validPassword = 'admin123';       
  
  beforeEach(() => {
    // Langkah ini dijalankan sebelum setiap test case
    cy.visit(loginUrl);
  });

  // ==========================================
  // TEST CASE 1: MEMUAT HALAMAN LOGIN DENGAN BENAR
  // ==========================================
  it('1. Memastikan halaman login memuat elemen dengan benar', () => {
    cy.contains('Masuk ke Akun Anda').should('be.visible');
    cy.get('input[name="email"]').should('be.visible');
    cy.get('input[name="password"]').should('be.visible');
    cy.get('button[type="submit"]').should('exist');
  });

  // ==========================================
  // TEST CASE 2: LOGIN GAGAL - MENAMPILKAN PESAN ERROR
  // ==========================================
  it('2. Login Gagal - Menampilkan pesan error', () => {
    cy.get('input[name="email"]').type('emailsalah@test.com');
    cy.get('input[name="password"]').type('passwordsalah');
    
    cy.contains('button', 'Masuk').click();

    cy.url().should('include', '/login');

    cy.get('.text-red-500').should('be.visible');
  });

  // ==========================================
  // TEST CASE 3: LOGIN BERHASIL - REDIRECT KE DASHBOARD
  // ==========================================
  it('3. Login Berhasil - Redirect ke Dashboard', () => {

    cy.get('input[name="email"]').type(validEmail);
    

    cy.get('input[name="password"]').type(validPassword);
    

    cy.contains('button', 'Masuk').click();

    cy.url().should('not.include', '/dasboard');

  });

});