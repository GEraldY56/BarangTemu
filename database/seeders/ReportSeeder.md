<?php

namespace Database\Seeders;

use App\Models\Report;
use App\Models\User;
use Illuminate\Database\Seeder;

class ReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::where('role', 'user')->get();

        // Report 1: Barang Temuan - Kalkulator
        Report::create([
            'user_id' => $users->where('name', 'Rian Pratama')->first()->id,
            'title' => 'Kalkulator Casio fx-991EX',
            'category' => 'Elektronik & Gadget',
            'type' => 'Barang Temuan',
            'location' => 'Lab Komputer 2 Lt. 2',
            'report_date' => now()->subDays(2),
            'report_time' => '14:30:00',
            'status' => 'Sudah Ditemukan',
            'description' => 'Kalkulator saintifik warna hitam, ada stiker karakter Luffy di tutup geser, baterai masih aktif. Ditemukan di meja no. 5 setelah praktikum.',
            'reporter_name' => 'Rian Pratama',
            'reporter_class' => 'XI MIPA 2',
            'reporter_contact' => '081298765432',
            'image_path' => null,
        ]);

        // Report 2: Barang Hilang - Jaket
        Report::create([
            'user_id' => $users->where('name', 'Bima Arya')->first()->id,
            'title' => 'Jaket Almamater OSIS Navy (Size L)',
            'category' => 'Pakaian & Jaket',
            'type' => 'Barang Hilang',
            'location' => 'Tribun Lapangan Basket',
            'report_date' => now()->subDays(1),
            'report_time' => '17:00:00',
            'status' => 'Belum Ditemukan',
            'description' => 'Jaket almamater biru navy bertuliskan "SMA Teladan 2024" di dada kiri. Tertinggal sehabis latihan ekskul basket sore hari. Ada nama "BIMA" di bagian dalam kerah.',
            'reporter_name' => 'Bima Arya',
            'reporter_class' => 'XII IPS 1',
            'reporter_contact' => '082145678901',
            'image_path' => null,
        ]);

        // Report 3: Barang Temuan - Flashdisk
        Report::create([
            'user_id' => $users->first()->id,
            'title' => 'Flashdisk SanDisk 32GB Merah',
            'category' => 'Elektronik & Gadget',
            'type' => 'Barang Temuan',
            'location' => 'Perpustakaan Meja Baca 4',
            'report_date' => now()->subDays(1),
            'report_time' => '10:15:00',
            'status' => 'Sudah Ditemukan',
            'description' => 'Flashdisk merah terdapat gantungan tali hitam bertuliskan "TUGAS AKHIR TIK". Disimpan sementara di loker piket.',
            'reporter_name' => 'Bu Siti Nurhaliza',
            'reporter_class' => 'Pustakawan',
            'reporter_contact' => '081377889900',
            'image_path' => null,
        ]);

        // Report 4: Barang Hilang - Dompet
        Report::create([
            'user_id' => $users->where('name', 'Nadia Zahra')->first()->id,
            'title' => 'Dompet Siswa Hitam & Kartu Pelajar',
            'category' => 'Identitas & Kartu',
            'type' => 'Barang Hilang',
            'location' => 'Kantin Sekolah Pujasera Barat',
            'report_date' => now()->subDays(5),
            'report_time' => '12:30:00',
            'status' => 'Sudah Dikembalikan',
            'description' => 'Dompet lipat kulit sintetis hitam berisi Kartu Pelajar atas nama Nadia Zahra dan uang saku Rp 50.000. Hilang saat istirahat makan siang.',
            'reporter_name' => 'Nadia Zahra',
            'reporter_class' => 'X-4',
            'reporter_contact' => '085612345678',
            'image_path' => null,
        ]);

        // Report 5: Barang Temuan - Botol Minum
        Report::create([
            'user_id' => $users->first()->id,
            'title' => 'Botol Minum Tupperware Eco 750ml Hijau',
            'category' => 'Lainnya',
            'type' => 'Barang Temuan',
            'location' => 'Lorong Kelas X Gedung C',
            'report_date' => now(),
            'report_time' => '08:00:00',
            'status' => 'Sudah Ditemukan',
            'description' => 'Warna hijau toska dengan stiker nama inisial "F.A" di bagian leher botol. Kondisi bersih, masih ada sisa air di dalamnya.',
            'reporter_name' => 'Pak Mulyadi',
            'reporter_class' => 'Petugas Kebersihan',
            'reporter_contact' => '089876543210',
            'image_path' => null,
        ]);

        // Report 6: Barang Hilang - Tempat Pensil
        Report::create([
            'user_id' => $users->where('name', 'Dinda Kirana')->first()->id,
            'title' => 'Tempat Pensil Faber-Castell Abu-abu',
            'category' => 'Alat Tulis & Buku',
            'type' => 'Barang Hilang',
            'location' => 'Ruang Kelas XI IPA 2',
            'report_date' => now()->subDays(4),
            'report_time' => '13:00:00',
            'status' => 'Belum Ditemukan',
            'description' => 'Kotak pensil kain abu-abu berisi pensil 2B merek Faber-Castell, penghapus hitam, busur derajat metal, dan penggaris 30cm. Hilang setelah jam pelajaran matematika.',
            'reporter_name' => 'Dinda Kirana',
            'reporter_class' => 'XI IPA 2',
            'reporter_contact' => '087711223344',
            'image_path' => null,
        ]);

        // Report 7: Barang Temuan - Kunci Motor
        Report::create([
            'user_id' => $users->first()->id,
            'title' => 'Kunci Motor Honda dengan Gantungan Akrilik',
            'category' => 'Kunci & Aksesoris',
            'type' => 'Barang Temuan',
            'location' => 'Area Parkir Sepeda Motor Barat',
            'report_date' => now(),
            'report_time' => '15:30:00',
            'status' => 'Sudah Ditemukan',
            'description' => 'Anak kunci motor Honda Beat dengan gantungan akrilik anime Gojo Satoru. Diserahkan ke pos satpam gerbang utama untuk penyimpanan sementara.',
            'reporter_name' => 'Pak Slamet',
            'reporter_class' => 'Satpam Utama',
            'reporter_contact' => '081233445566',
            'image_path' => null,
        ]);

        // Report 8: Barang Temuan - Buku Paket
        Report::create([
            'user_id' => $users->where('name', 'Ilham Ramadhan')->first()->id,
            'title' => 'Buku Paket Matematika Peminatan Kelas XII',
            'category' => 'Alat Tulis & Buku',
            'type' => 'Barang Temuan',
            'location' => 'Musholla Sekolah Sisi Belakang',
            'report_date' => now()->subDays(7),
            'report_time' => '12:00:00',
            'status' => 'Sudah Dikembalikan',
            'description' => 'Buku bersampul plastik bening, terdapat paraf guru pengajar di lembar pengesahan awal. Kondisi buku masih bagus dengan sedikit lipatan di sudut halaman.',
            'reporter_name' => 'Ilham Ramadhan',
            'reporter_class' => 'XII MIPA 1',
            'reporter_contact' => '081344556677',
            'image_path' => null,
        ]);
    }
}
