describe('Pengujian Fitur Register Website Informasi', () => {
  
  const registerUrl = 'http://127.0.0.1:8000/register'; 

  beforeEach(() => {
    cy.visit(registerUrl);
  });

  // ==========================================
  // TEST CASE 1: Memastikan halaman register memuat elemen dengan benar
  // ==========================================
  it('1. Memastikan halaman register memuat elemen dengan benar', () => {
    // Cek Judul Halaman
    cy.contains('Daftar Akun Baru').should('be.visible');
    
    // Cek Inputan tersedia
    cy.get('input[name="name"]').should('be.visible');
    cy.get('input[name="email"]').should('be.visible');
    cy.get('input[name="password"]').should('be.visible');
    cy.get('input[name="password_confirmation"]').should('be.visible');
    
    // Cek Tombol Daftar tersedia
    cy.contains('button', 'Daftar').should('be.visible');
  });

  // ==========================================
  // TEST CASE 2: Gagal Daftar - Password dan Konfirmasi tidak sama
  // ==========================================
  it('2. Gagal Daftar - Password dan Konfirmasi tidak sama', () => {
    // Isi Nama
    cy.get('input[name="name"]').type('User Test Gagal');
    
    // Isi Email
    cy.get('input[name="email"]').type('testgagal@example.com');
    
    // Isi Password
    cy.get('input[name="password"]').type('password123');
    
    // Isi Konfirmasi Password (DIBUAT BEDA)
    cy.get('input[name="password_confirmation"]').type('passwordbeda456');

    // Klik tombol Daftar
    cy.contains('button', 'Daftar').click();

    // Validasi: Seharusnya masih di halaman register
    cy.url().should('include', '/register');
    
    // Validasi: Pesan error muncul (text-red-500)
    // Biasanya errornya: "The password confirmation does not match."
    cy.get('.text-red-500').should('be.visible');
  });

  // ==========================================
  // TEST CASE 3: Berhasil Daftar - Redirect ke Dashboard/Home
  // ==========================================
  it('3. Berhasil Daftar - Redirect ke Dashboard/Home', () => {
    // TRIK KHUSUS: Membuat email unik otomatis agar tidak error "Email already taken"
    const randomEmail = `user${Date.now()}@example.com`;

    // Isi Nama
    cy.get('input[name="name"]').type('User Baru Cypress');
    
    // Isi Email Unik
    cy.get('input[name="email"]').type(randomEmail);
    
    // Isi Password
    cy.get('input[name="password"]').type('password123');
    
    // Isi Konfirmasi Password (SAMA)
    cy.get('input[name="password_confirmation"]').type('password123');

    // Klik tombol Daftar
    cy.contains('button', 'Daftar').click();

    // Validasi: URL berubah (Masuk ke dashboard/home)
    cy.url().should('not.include', '/register');

  });

});