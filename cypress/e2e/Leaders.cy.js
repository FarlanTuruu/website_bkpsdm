describe('Pengujian Manajemen Pimpinan (Leaders)', () => {

  const loginUrl = 'http://127.0.0.1:8000/login';
  const leadersIndexUrl = 'http://127.0.0.1:8000/admin/leaders';

  const validEmail = 'admin@example.com';
  const validPassword = 'admin123';

  // Data Dummy Test
  const leaderName = 'Dr. Leader Test ' + Date.now();
  const leaderPosition = 'Direktur Utama';
  const newLeaderName = 'Prof. Leader Edit ' + Date.now(); // Nama setelah diedit
  const birthPlace = 'Jakarta';
  const birthDate = '1980-05-20'; // Format YYYY-MM-DD untuk input type="date"

  // ==========================================
  // LOGIN SEBELUM TEST
  // ==========================================
  beforeEach(() => {
    cy.visit(loginUrl);
    cy.get('input[name="email"]').type(validEmail);
    cy.get('input[name="password"]').type(validPassword);
    
    cy.contains('button', 'Masuk').click(); 

    // Validasi login sukses
    cy.url().should('not.include', '/login');

    // Masuk ke halaman index Leaders
    cy.visit(leadersIndexUrl);
  });

  // ==========================================
  // TEST CASE 1: CREATE (TAMBAH PIMPINAN)
  // ==========================================
  it('1. Berhasil Menambah Pimpinan Baru', () => {
    // Klik tombol Tambah
    cy.contains('Tambah Pimpinan').click();
    
    // Validasi URL
    cy.url().should('include', '/leaders/create');

    // Isi Form Data Diri
    cy.get('input[name="name"]').type(leaderName);
    cy.get('input[name="position"]').type(leaderPosition);
    cy.get('input[name="birth_place"]').type(birthPlace);
    cy.get('input[name="birth_date"]').type(birthDate);

    cy.get('input[name="photo"]').selectFile('cypress/fixtures/test-image.jpg');

    // Isi Textarea (Pendidikan, Karir, Prestasi)
    cy.get('textarea[name="education"]').type('S1 Teknik Informatika - UMM');
    cy.get('textarea[name="career"]').type('2010-2015: Manager IT');
    cy.get('textarea[name="achievements"]').type('Pegawai Teladan 2012');

    // Simpan
    cy.contains('button', 'Simpan Pimpinan').click();

    // Validasi Redirect ke Index
    cy.url().should('include', '/leaders');
    
    // Validasi Data Muncul di Tabel
    cy.contains(leaderName).should('be.visible');
    cy.contains(leaderPosition).should('be.visible');
  });

  // ==========================================
  // TEST CASE 2: EDIT (UBAH DATA PIMPINAN)
  // ==========================================
  it('2. Berhasil Mengedit Data Pimpinan', () => {
    // Cari baris yang berisi nama leader yang baru dibuat, lalu klik tombol edit (kuning)
    cy.contains(leaderName).parents('tr').find('a.bg-yellow-200').click();

    // Validasi URL Edit
    cy.url().should('include', '/edit');

    // Ubah Nama & Jabatan
    cy.get('input[name="name"]').clear().type(newLeaderName);
    cy.get('input[name="position"]').clear().type('Wakil Direktur');

    // Ubah data textarea sedikit
    cy.get('textarea[name="education"]').clear().type('S2 Manajemen Bisnis');

    // Klik tombol Update
    cy.contains('button', 'Perbarui Pimpinan').click();

    // Validasi Redirect & Data Berubah
    cy.url().should('include', '/leaders');
    cy.contains(newLeaderName).should('be.visible'); // Nama baru harus ada
    cy.contains(leaderName).should('not.exist');     // Nama lama harus hilang
  });

  // ==========================================
  // TEST CASE 3: DELETE (HAPUS PIMPINAN)
  // ==========================================
  it('3. Berhasil Menghapus Pimpinan', () => {
    // Klik tombol hapus (merah)
    cy.contains(newLeaderName).parents('tr').find('button.bg-red-200').click();

    // Handle Confirm Browser
    cy.on('window:confirm', () => true);

    // Validasi Data Hilang dari Tabel
    cy.contains(newLeaderName).should('not.exist');
  });

});