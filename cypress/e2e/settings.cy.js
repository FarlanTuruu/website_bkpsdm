describe('Pengujian Halaman Pengaturan Website', () => {

  const loginUrl = 'http://127.0.0.1:8000/login';
  const settingsUrl = 'http://127.0.0.1:8000/admin/settings';

  const validEmail = 'admin@example.com';
  const validPassword = 'admin123';

  // DATA DUMMY TEST
  const newWebName = 'BKPSDM Update Cypress ' + Date.now();
  const newPhone = '081234567890';
  const newEmail = 'kontak@bkpsdm.test';
  const newAddress = 'Jl. Testing Otomatis No. 1';
  const newVisi = 'Menjadi Instansi Terdepan dalam Teknologi';
  
  // ==========================================
  // LOGIN SEBELUM TEST
  // ==========================================
  beforeEach(() => {
    cy.visit(loginUrl);
    cy.get('input[name="email"]').type(validEmail);
    cy.get('input[name="password"]').type(validPassword);
    cy.contains('button', 'Masuk').click(); // Sesuaikan teks tombol login
    cy.url().should('not.include', '/login');
    
    // Pergi ke halaman Settings
    cy.visit(settingsUrl);
  });

  // ==========================================
  // TEST CASE 1: UPDATE INFORMASI KONTAK & PROFIL
  // ==========================================
  it('1. Berhasil Memperbarui Informasi Kontak & Profil Teks', () => {
    // 1. Ubah Informasi Kontak
    cy.get('input[name="website_name"]').clear().type(newWebName);
    cy.get('input[name="phone"]').clear().type(newPhone);
    cy.get('input[name="email"]').clear().type(newEmail);
    cy.get('textarea[name="address"]').clear().type(newAddress);

    // 2. Ubah Profil BKPSDM
    cy.get('textarea[name="profile_bkpsdm"]').clear().type('Profil ini diupdate otomatis oleh robot Cypress.');
    cy.get('input[name="visi"]').clear().type(newVisi);
    cy.get('textarea[name="misi"]').clear().type('Misi 1: Testing\nMisi 2: Debugging');
    cy.get('textarea[name="tugas_fungsi"]').clear().type('Tugas: Mengelola Kepegawaian');

    // 3. Simpan Perubahan
    cy.contains('button', 'Perbarui Pengaturan').click();

    // 4. Validasi Redirect & Data Tersimpan
    cy.url().should('include', '/settings');
    
    // Pastikan nilai input berubah sesuai yang kita ketik
    cy.get('input[name="website_name"]').should('have.value', newWebName);
    cy.get('input[name="phone"]').should('have.value', newPhone);
    cy.get('input[name="visi"]').should('have.value', newVisi);
  });

  // ==========================================
  // TEST CASE 2: UPLOAD GAMBAR (HERO & PROFIL)
  // ==========================================
  it('2. Berhasil Mengunggah Gambar Hero & Profil', () => {
    // Pastikan file dummy ada di folder cypress/fixtures/
    const imageFile = 'test-image.jpg'; 

    // 1. Upload Hero Background (Multiple)
    // Jika Anda ingin test multiple, bisa pass array: .selectFile([file1, file2])
    // Di sini kita coba upload 1 file dulu untuk hero
    cy.get('input[name="hero_background_images[]"]').selectFile('cypress/fixtures/' + imageFile);

    // 2. Upload Profile Image
    cy.get('input[name="profile_image"]').selectFile('cypress/fixtures/' + imageFile);

    // 3. Upload Org Structure Image
    cy.get('input[name="org_structure_image"]').selectFile('cypress/fixtures/' + imageFile);

    // 4. Simpan
    cy.contains('button', 'Perbarui Pengaturan').click();

    // 5. Validasi
    cy.url().should('include', '/settings');
    
    // Cek apakah ada indikasi gambar berhasil diupload
    // Di blade Anda, ada tombol "Hapus gambar ini" jika gambar ada.
    // Kita cek keberadaan checkbox hapus tersebut.
    cy.get('input[name="remove_profile_image"]').should('exist');
    cy.get('input[name="remove_org_structure_image"]').should('exist');
  });

  // ==========================================
  // TEST CASE 3: HAPUS GAMBAR
  // ==========================================
  it('3. Berhasil Menghapus Gambar Profil', () => {
    // Asumsi: Gambar sudah ada dari Test Case 2
    
    // 1. Centang checkbox hapus gambar profil
    // Di blade: name="remove_profile_image"
    // Perlu scroll atau find element
    cy.get('input[name="remove_profile_image"]').check({force: true}); 
    // {force: true} digunakan karena kadang styling custom (label) menutupi checkbox asli

    // 2. Simpan
    cy.contains('button', 'Perbarui Pengaturan').click();

    // 3. Validasi
    // Seharusnya checkbox hapus hilang karena gambarnya sudah tidak ada
    cy.get('input[name="remove_profile_image"]').should('not.exist');
  });

});