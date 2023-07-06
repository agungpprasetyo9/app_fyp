<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Tryout;
use App\Models\Value;
use App\Models\Major;
use App\Models\Recommendation;
use App\Models\Room;
use App\Models\Student;
use App\Models\Subject;
use App\Models\University;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(13)->create();
        
        User::create([
            
            'email' => "agung@gmail.com",
            'password' => bcrypt('agungpass'),
        ]);
        User::create([
            
            'email' => "adminagung@gmail.com",
            'is_admin' => true,
            'password' => bcrypt('agungpass'),
        ]);
        User::create([ 
            'email' => "muridbaru@gmail.com",
            'is_admin' => false,
            'password' => bcrypt('agungpass'),
        ]);

        Room::factory(7)->create();

        // $userscount = User::count();
        // Student::factory($userscount)->create();

        Tryout::factory(5)->create();
       

        $faker = Faker::create();
        $dataSekolah = [
            'SMA Negeri 1 Jakarta',
            'SMA Negeri 2 Surabaya',
            'SMA Negeri 3 Bandung',
            'SMA Negeri 4 Yogyakarta',
            'SMA Negeri 5 Semarang',
            'SMA Negeri 6 Medan',
            'SMA Negeri 7 Makassar',
            'SMA Negeri 8 Palembang',
            'SMK Negeri 1 Jakarta',
            'SMK Negeri 2 Surabaya',
            'SMK Negeri 3 Bandung',
            'SMK Negeri 4 Yogyakarta',
            'SMK Negeri 5 Semarang',
            'SMK Negeri 6 Medan',
            'SMK Negeri 7 Makassar',
            'SMK Negeri 8 Palembang',
        ];
        
       // Mendapatkan daftar user_id yang tersedia 
        $users = User::where('is_admin', false)->pluck('id')->toArray();
        // dd($users);

         // Menambahkan data student dengan user_id acak
         foreach ($users as $userId ) {
             Student::create([
                'user_id' => $userId,
                'room_id' => $faker->numberBetween(1,5),
                'name' => $faker->name(),
                'school_name' => $faker->randomElement($dataSekolah),
                'telp' => $faker->phoneNumber(),
                'created_at' => now(),
                'updated_at' => now(),
                 // Kolom-kolom lainnya
             ]);
         } 



        //data jurusan / majors
        $majors = [
            ['id' => 355001, 'major_name' => 'KESEHATAN MASYARAKAT', 'tightness' => 51.0471],
            ['id' => 355002, 'major_name' => 'KEDOKTERAN', 'tightness' => 29.0604],
            ['id' => 355003, 'major_name' => 'KEPERAWATAN', 'tightness' => 37.1839],
            ['id' => 355004, 'major_name' => 'GIZI', 'tightness' => 34.1074],
            ['id' => 355005, 'major_name' => 'MATEMATIKA', 'tightness' => 0.1339],
            ['id' => 355006, 'major_name' => 'BIOLOGI', 'tightness' => 0.144],
            ['id' => 355007, 'major_name' => 'KIMIA', 'tightness' => 0.1755],
            ['id' => 355008, 'major_name' => 'FISIKA', 'tightness' => 0.44],
            ['id' => 355009, 'major_name' => 'STATISTIKA', 'tightness' => 61.6071],
            ['id' => 355010, 'major_name' => 'INFORMATIKA', 'tightness' => 33.1992],
            ['id' => 355011, 'major_name' => 'MANAJEMEN SUMBERDAYA PERAIRAN', 'tightness' => 0.1661],
            ['id' => 355012, 'major_name' => 'AKUAKULTUR', 'tightness' => 0.275],
            ['id' => 355013, 'major_name' => 'PERIKANAN TANGKAP', 'tightness' => 0.2517],
            ['id' => 355014, 'major_name' => 'ILMU KELAUTAN', 'tightness' => 0.179],
            ['id' => 355015, 'major_name' => 'OCEANOGRAFI', 'tightness' => 0.1667],
            ['id' => 355016, 'major_name' => 'TEKNOLOGI HASIL PERIKANAN', 'tightness' => 0.1718],
            ['id' => 355017, 'major_name' => 'TEKNIK SIPIL', 'tightness' => 53.4188],
            ['id' => 355018, 'major_name' => 'ARSITEKTUR', 'tightness' => 56.1798],
            ['id' => 355019, 'major_name' => 'TEKNIK MESIN', 'tightness' => 0.087],
            ['id' => 355020, 'major_name' => 'TEKNIK KIMIA', 'tightness' => 0.1108],
            ['id' => 355021, 'major_name' => 'TEKNIK ELEKTRO', 'tightness' => 0.095],
            ['id' => 355022, 'major_name' => 'PERENCANAAN WILAYAH DAN KOTA', 'tightness' => 55.1559],
            ['id' => 355023, 'major_name' => 'TEKNIK INDUSTRI', 'tightness' => 43.6893],
            ['id' => 355024, 'major_name' => 'TEKNIK LINGKUNGAN', 'tightness' => 0.0747],
            ['id' => 355025, 'major_name' => 'TEKNIK PERKAPALAN', 'tightness' => 0.1712],
            ['id' => 355026, 'major_name' => 'TEKNIK GEOLOGI', 'tightness' => 0.0929],
            ['id' => 355027, 'major_name' => 'TEKNIK GEODESI', 'tightness' => 0.1067],
            ['id' => 355028, 'major_name' => 'TEKNIK KOMPUTER', 'tightness' => 0.0639],
            ['id' => 355029, 'major_name' => 'PETERNAKAN', 'tightness' => 0.1255],
            ['id' => 355030, 'major_name' => 'TEKNOLOGI PANGAN', 'tightness' => 55.5088],
            ['id' => 355031, 'major_name' => 'AGROEKOTEKNOLOGI', 'tightness' => 0.1268],
            ['id' => 355032, 'major_name' => 'AGRIBISNIS', 'tightness' => 0.074],
            ['id' => 355033, 'major_name' => 'KEDOKTERAN GIGI', 'tightness' => 0.015],
            ['id' => 355034, 'major_name' => 'FARMASI', 'tightness' => 20.6084],
            ['id' => 355035, 'major_name' => 'BIOTEKNOLOGI', 'tightness' => 0.0716],
            ['id' => 355036, 'major_name' => 'SASTRA INDONESIA', 'tightness' => 0.1087],
            ['id' => 355037, 'major_name' => 'SASTRA INGGRIS', 'tightness' => 56.5134],
            ['id' => 355038, 'major_name' => 'SEJARAH', 'tightness' => 0.1371],
            ['id' => 355039, 'major_name' => 'ILMU PERPUSTAKAAN', 'tightness' => 0.0719],
            ['id' => 355040, 'major_name' => 'HUKUM', 'tightness' => 63.5866],
            ['id' => 355041, 'major_name' => 'MANAJEMEN', 'tightness' => 34.8399],
            ['id' => 355042, 'major_name' => 'EKONOMI', 'tightness' => 0.0989],
            ['id' => 355043, 'major_name' => 'AKUNTANSI', 'tightness' => 61.804],
            ['id' => 355044, 'major_name' => 'ADMINISTRASI PUBLIK', 'tightness' => 70.6575],
            ['id' => 355045, 'major_name' => 'ADMINISTRASI BISNIS', 'tightness' => 49.4505],
            ['id' => 355046, 'major_name' => 'ILMU PEMERINTAHAN', 'tightness' => 64.632],
            ['id' => 355047, 'major_name' => 'ILMU KOMUNIKASI', 'tightness' => 28.7196],
            ['id' => 355048, 'major_name' => 'PSIKOLOGI', 'tightness' => 30.7652],
            ['id' => 355049, 'major_name' => 'BAHASA DAN KEBUDAYAAN JEPANG', 'tightness' => 0.1134],
            ['id' => 355050, 'major_name' => 'HUBUNGAN INTERNASIONAL', 'tightness' => 46.9565],
            ['id' => 355051, 'major_name' => 'ANTROPOLOGI SOSIAL', 'tightness' => 0.1142],
            ['id' => 355052, 'major_name' => 'EKONOMI ISLAM', 'tightness' => 0.0958],
            ['id' => 355053, 'major_name' => 'ADMINISTRASI PUBLIK KAMPUS REMBANG', 'tightness' => 0.2216],
        ];
        DB::table('majors')->insert($majors);
        // foreach ($majors as $major) {
        //     Major::create($major);
        // }


        //subject
        $subjects = [
            ['subject_name' => 'Penalaran Umum'],
            ['subject_name' => 'Pemahaman Bacaan dan Menulis'],
            ['subject_name' => 'Pengetahuan dan Pemahaman Umum'],
            ['subject_name' => 'Pengetahuan Kuantitatif'],
            ['subject_name' => 'Literasi Bahasa Inggris'],
            ['subject_name' => 'Literasi Bahasa Indonesia'],
        ];
        DB::table('subjects')->insert($subjects);

        //tambah data Value
        $studentCount=Student::count();
        Value::factory($studentCount*5)->create();

        //universities
        $universities = [
            ['id' => 111, 'university_name' => 'UNIVERSITAS SYIAH KUALA', 'tightness' => 0.1402],
            ['id' => 112, 'university_name' => 'UNIVERSITAS MALIKUSSALEH', 'tightness' => 0.3315],
            ['id' => 113, 'university_name' => 'UNIVERSITAS TEUKU UMAR', 'tightness' => 0.4658],
            ['id' => 114, 'university_name' => 'UNIVERSITAS SAMUDRA', 'tightness' => 0.3783],
            ['id' => 115, 'university_name' => 'UNIVERSITAS ISLAM INDONESIA', 'tightness' => 0.3783],
            ['id' => 116, 'university_name' => 'UNIVERSITAS ISLAM NEGERI AR-RANIRY', 'tightness' => 0.8096],
            ['id' => 117, 'university_name' => 'UNIVERSITAS SUMATERA UTARA', 'tightness' => 0.0645],
            ['id' => 118, 'university_name' => 'UNIVERSITAS NEGERI MEDAN', 'tightness' => 0.1659],
            ['id' => 119, 'university_name' => 'UNIVERSITAS ISLAM NEGERI SUMATERA UTARA', 'tightness' => 0.3319],
            ['id' => 120, 'university_name' => 'UNIVERSITAS RIAU', 'tightness' => 0.0977],
            ['id' => 121, 'university_name' => 'UNIVERSITAS MARITIM RAJA ALI HAJI', 'tightness' => 0.7358],
            ['id' => 122, 'university_name' => 'UNIVERSITAS ANDALAS', 'tightness' => 0.0837],
            ['id' => 123, 'university_name' => 'UNIVERSITAS JAMBI', 'tightness' => 0.2224],
            ['id' => 124, 'university_name' => 'UNIVERSITAS BENGKULU', 'tightness' => 0.1885],
            ['id' => 125, 'university_name' => 'UNIVERSITAS SRIWIJAYA', 'tightness' => 0.1216],
            ['id' => 126, 'university_name' => 'UNIVERSITAS ISLAM NEGERI RADEN FATAH', 'tightness' => 0.7367],
            ['id' => 127, 'university_name' => 'UNIVERSITAS BANGKA BELITUNG', 'tightness' => 0.3487],
            ['id' => 128, 'university_name' => 'UNIVERSITAS LAMPUNG', 'tightness' => 0.1742],
            ['id' => 129, 'university_name' => 'INSTITUT TEKNOLOGI SUMATERA', 'tightness' => 0.1946],
            ['id' => 130, 'university_name' => 'UNIVERSITAS SULTAN AGENG TIRTAYASA', 'tightness' => 0.1875],
            ['id' => 131, 'university_name' => 'UNIVERSITAS INDONESIA', 'tightness' => 0.0724],
            ['id' => 132, 'university_name' => 'UNIVERSITAS ISLAM NEGERI JAKARTA', 'tightness' => 0.0863],
            ['id' => 133, 'university_name' => 'UNIVERSITAS NEGERI JAKARTA', 'tightness' => 0.0675],
            ['id' => 134, 'university_name' => 'UPN "VETERAN" JAKARTA', 'tightness' => 0.0646],
            ['id' => 135, 'university_name' => 'UNIVERSITAS SINGAPERBANGSA KARAWANG', 'tightness' => 0.1039],
            ['id' => 136, 'university_name' => 'INSTITUT TEKNOLOGI BANDUNG', 'tightness' => 0.08],
            ['id' => 137, 'university_name' => 'UNIVERSITAS PADJADJARAN', 'tightness' => 0.0526],
            ['id' => 138, 'university_name' => 'UNIVERSITAS PENDIDIKAN INDONESIA', 'tightness' => 0.0971],
            ['id' => 139, 'university_name' => 'UNIVERSITAS ISLAM NEGERI SUNAN GUNUNG DJATI', 'tightness' => 0.1351],
            ['id' => 140, 'university_name' => 'INSTITUT PERTANIAN BOGOR', 'tightness' => 0.1257],
            ['id' => 141, 'university_name' => 'UNIVERSITAS SILIWANGI', 'tightness' => 0.1725],
            ['id' => 142, 'university_name' => 'UNIVERSITAS JENDERAL SOEDIRMAN', 'tightness' => 0.0846],
            ['id' => 143, 'university_name' => 'UNIVERSITAS TIDAR', 'tightness' => 0.1983],
            ['id' => 144, 'university_name' => 'UNIVERSITAS SEBELAS MARET', 'tightness' => 0.0673],
            ['id' => 145, 'university_name' => 'UNIVERSITAS DIPONEGORO', 'tightness' => 0.0747],
            ['id' => 146, 'university_name' => 'UNIVERSITAS NEGERI SEMARANG', 'tightness' => 0.0806],
            ['id' => 147, 'university_name' => 'UNIVERSITAS ISLAM NEGERI WALISONGO', 'tightness' => 0.2537],
            ['id' => 148, 'university_name' => 'UNIVERSITAS GADJAH MADA', 'tightness' => 0.0477],
            ['id' => 149, 'university_name' => 'UNIVERSITAS NEGERI YOGYAKARTA', 'tightness' => 0.0478],
            ['id' => 150, 'university_name' => 'UNIVERSITAS ISLAM NEGERI SUNAN KALIJAGA', 'tightness' => 0.1694],
            ['id' => 151, 'university_name' => 'UNIVERSITAS JEMBER', 'tightness' => 0.1306],
            ['id' => 152, 'university_name' => 'UNIVERSITAS BRAWIJAYA', 'tightness' => 0.0889],
            ['id' => 153, 'university_name' => 'UNIVERSITAS NEGERI MALANG', 'tightness' => 0.0835],
            ['id' => 154, 'university_name' => 'UNIVERSITAS ISLAM NEGERI MALANG', 'tightness' => 0.2014],
            ['id' => 155, 'university_name' => 'UNIVERSITAS AIRLANGGA', 'tightness' => 0.085],
            ['id' => 156, 'university_name' => 'INSTITUT TEKNOLOGI SEPULUH NOPEMBER', 'tightness' => 0.0978],
            ['id' => 157, 'university_name' => 'UNIVERSITAS NEGERI SURABAYA', 'tightness' => 0.2029],
            ['id' => 158, 'university_name' => 'UNIVERSITAS TRUNOJOYO MADURA', 'tightness' => 0.3242],
            ['id' => 159, 'university_name' => 'UPN "VETERAN" JAWA TIMUR', 'tightness' => 0.1165],
            ['id' => 160, 'university_name' => 'UNIVERSITAS ISLAM NEGERI SUNAN AMPEL SURABAYA', 'tightness' => 0.2207],
            ['id' => 161, 'university_name' => 'UNIVERSITAS TANJUNGPURA', 'tightness' => 0.0321],
            ['id' => 162, 'university_name' => 'UNIVERSITAS PALANGKARAYA', 'tightness' => 0.2455],
            ['id' => 163, 'university_name' => 'UNIVERSITAS LAMBUNG MANGKURAT', 'tightness' => 0.1795],
            ['id' => 164, 'university_name' => 'UNIVERSITAS MULAWARMAN', 'tightness' => 0.1387],
            ['id' => 165, 'university_name' => 'INSTITUT TEKNOLOGI KALIMANTAN', 'tightness' => 0.3515],
            ['id' => 166, 'university_name' => 'UNIVERSITAS BORNEO TARAKAN', 'tightness' => 0.2854],
            ['id' => 167, 'university_name' => 'UNIVERSITAS UDAYANA', 'tightness' => 0.1104],
            ['id' => 168, 'university_name' => 'UNIVERSITAS MATARAM', 'tightness' => 0.1658],
            ['id' => 169, 'university_name' => 'UNIVERSITAS NUSA CENDANA', 'tightness' => 0.1523],
            ['id' => 170, 'university_name' => 'UNIVERSITAS TIMOR', 'tightness' => 0.3261],
            ['id' => 171, 'university_name' => 'UNIVERSITAS HASANUDDIN', 'tightness' => 0.1523],
        ];
        // foreach($universities as $university){
        //     University::create($university);
        // }
        DB::table('universities')->insert($universities);
        

        $alumni = [
            [
                'id' => 21523225, 'name' => 'Zahwa Almira Kayla', 'school' => 'SMA 1 Bekasi', 'telp' => '62812852', 'acceptance' => 'Tidak lulus', 'universities' => null
            ],
            [
                'id' => 21523456, 'name' => 'Ratih Sekar Wulan', 'school' => 'SMA Al-Azhar', 'telp' => '62814875', 'acceptance' => 'Lulus', 'universities' => 'Universitas Udayana'
            ],
            [
                'id' => 21524882, 'name' => 'Agung Prasetyo Abdjul', 'school' => 'SMA 1 Timika', 'telp' => '62812852', 'acceptance' => 'Tidak lulus', 'universities' => null
            ],
            [
                'id' => 21625252, 'name' => 'Nur Latif Muhammad', 'school' => 'SMA 3 Tangerang', 'telp' => '62814875', 'acceptance' => 'Lulus', 'universities' => 'Universitas Padjadjaran'
            ],
            [
                'id' => 21523224, 'name' => 'Maretta Endah Prameswari', 'school' => 'SMA 4 Kudus', 'telp' => '62812852', 'acceptance' => 'Lulus', 'universities' => 'Universitas Pendidikan Indonesia'
            ],
            [
                'id' => 21827278, 'name' => 'Dzikri Muhammad', 'school' => 'SMA 2 Balikpapan', 'telp' => '62814875', 'acceptance' => 'Lulus', 'universities' => 'Universitas Negeri Jakarta'
            ],
            [
                'id' => 26118192, 'name' => 'Asyla', 'school' => 'SMA 5 Kalimantan Tengah', 'telp' => '62812852', 'acceptance' => 'Lulus', 'universities' => 'Universitas Indonesia'
            ],
            [
                'id' => 27291018, 'name' => 'Mutiara Irdina', 'school' => 'SMA 3 Bandung', 'telp' => '62174875', 'acceptance' => 'Lulus', 'universities' => 'Institut Teknologi Sumatera'
            ],
            [
                'id' => 27189187, 'name' => 'Reza Dwi Puspita', 'school' => 'SMA 12 Boyolali', 'telp' => '62812852', 'acceptance' => 'Tidak lulus', 'universities' => null
            ],
            [
                'id' => 27191771, 'name' => 'Galuh Ihsan Nur Kholis', 'school' => 'SMA 11 Klaten', 'telp' => '62414875', 'acceptance' => 'Lulus', 'universities' => 'UniversitasAirlangga'
            ]
        ];
        //
        DB::table('alumnis')->insert($alumni);

        Recommendation::factory(7)->create();
    }
}
