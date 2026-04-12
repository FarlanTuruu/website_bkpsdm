describe('Pengujian Manajemen Pengumuman (CRUD)', () => {

  // URL Halaman
  const loginUrl = 'http://127.0.0.1:8000/login';
  const announcementIndexUrl = 'http://127.0.0.1:8000/admin/announcements';
  const announcementCreateUrl = 'http://127.0.0.1:8000/admin/announcements/create';

  // Data Login Admin
  const validEmail = 'admin@example.com';
  const validPassword = 'admin123';

  // Data Dummy untuk Test
  const newTitle = 'Pengumuman Penting Cypress ' + Date.now();
  const editTitle = 'Pengumuman Ini Sudah Diedit ' + Date.now();
  // Format tanggal harus DD-MM-YYYY
  // Kita ambil tanggal besok agar lolos validasi "tidak boleh masa lalu"
  const tomorrow = new Date();
  tomorrow.setDate(tomorrow.getDate() + 1);
  const validDate = tomorrow.toLocaleDateString('id-ID', { day: '2-digit', month: '2-digit', year: 'numeric' }).replace(/\//g, '-');


  beforeEach(() => {

    cy.visit(loginUrl);
    
    // 2. Login proses
    cy.get('input[name="email"]').type(validEmail);
    cy.get('input[name="password"]').type(validPassword);
    cy.contains('button', 'Masuk').click();

    cy.url().should('not.include', '/login');

    cy.visit(announcementIndexUrl);
  });

  it('1. Berhasil Menambah Pengumuman Baru', () => {
    // Klik tombol tambah
    cy.contains('Tambah Pengumuman').click();
    cy.url().should('include', '/create');

    // Isi Judul
    cy.get('input[name="title"]').type(newTitle);

    // Isi Konten (Handling CKEditor)
    // Cypress tidak bisa ketik langsung ke textarea yang tersembunyi.
    // Kita gunakan window.CKEDITOR object untuk set data.
    cy.window().then((win) => {
      win.CKEDITOR.instances['content'].setData('<p>Ini adalah konten pengumuman yang dibuat otomatis oleh Cypress.</p>');
    });

    // Isi Tanggal (Manual Input Format DD-MM-YYYY)
    cy.get('input[name="publish_date"]').type(validDate);

    // Pilih Status
    cy.get('select[name="status"]').select('published');

    // Upload Gambar (Opsional - Pastikan ada file cypress/fixtures/test-image.jpg)
    // Jika tidak punya file gambar di fixtures, comment baris di bawah ini
    // cy.get('input[name="image"]').selectFile('cypress/fixtures/test-image.jpg');

    // Simpan
    cy.contains('button', 'Simpan Pengumuman').click();

    // Validasi Redirect ke Index
    cy.url().should('include', '/announcements');
    
    // Validasi Data Muncul di Tabel
    cy.contains(newTitle).should('be.visible');
  });


  it('2. Gagal Tambah - Format Tanggal Salah / Masa Lalu', () => {
    cy.visit(announcementCreateUrl);

    // Isi data lain dengan benar dulu
    cy.get('input[name="title"]').type('Tes Validasi Tanggal');
    cy.window().then((win) => {
        win.CKEDITOR.instances['content'].setData('Konten tes validasi.');
    });
    cy.get('select[name="status"]').select('draft');

    // SKENARIO A: Format Salah (YYYY-MM-DD)
    cy.get('input[name="publish_date"]').type('2023-10-25');
    cy.contains('button', 'Simpan Pengumuman').click();

    // Harapkan Alert Browser Muncul (Cypress auto-accept alert, tapi kita bisa tangkap pesannya)
    cy.on('window:alert', (text) => {
      expect(text).to.contains('Format tanggal tidak valid');
    });

    // SKENARIO B: Tanggal Masa Lalu (misal 01-01-2020)
    cy.get('input[name="publish_date"]').clear().type('01-01-2020');
    cy.contains('button', 'Simpan Pengumuman').click();

    cy.on('window:alert', (text) => {
        expect(text).to.contains('masa lalu');
    });

    cy.url().should('include', '/create');
  });


  it('3. Berhasil Mengedit Pengumuman', () => {
    // Cari pengumuman yang baru dibuat
    cy.contains(newTitle).parents('tr').find('a.bg-yellow-200').click();

    // Validasi masuk halaman edit
    cy.url().should('include', '/edit');

    // Ubah Judul
    cy.get('input[name="title"]').clear().type(editTitle);

    // Ubah Konten via CKEditor
    cy.window().then((win) => {
        win.CKEDITOR.instances['content'].setData('<p>Konten ini sudah diedit oleh Cypress.</p>');
    });

    // Simpan Perubahan
    cy.contains('button', 'Perbarui Pengumuman').click();

    // Handle Konfirmasi "Apakah Anda yakin ingin memperbarui..." (Script JS Anda)
    cy.on('window:confirm', () => true); // Klik OK otomatis

    // Validasi Redirect & Data Berubah
    cy.url().should('include', '/announcements');
    cy.contains(editTitle).should('be.visible');
  });


  it('4. Berhasil Menghapus Pengumuman', () => {
    // Cari pengumuman yang sudah diedit
    // Klik tombol hapus (ikon tong sampah/merah)
    cy.contains(editTitle).parents('tr').find('button.bg-red-200').click();

    cy.on('window:confirm', () => true);

    // Validasi Data Hilang
    cy.contains(editTitle).should('not.exist');
  });

});