<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Company::create([
            'director_name'         => 'Muhammad Azmi, SE., M.Si',
            'name'                  => 'AmperaKoding',
            'short_description'     => 'Kami merupakan perusahaan yang menyediakan jasa rental mobil dengan layanan terbaik dan harga yang terjangkau di kota Palembang.',
            'description'           => '<h2>Sejarah Singkat</h2>
                <p>PT Rental Kendaraan Indonesia didirikan pada tahun 2010 dengan tujuan menyediakan solusi transportasi yang andal dan fleksibel bagi masyarakat Indonesia. Berawal dari beberapa unit mobil, kini perusahaan telah berkembang menjadi salah satu penyedia layanan rental kendaraan terbesar di Indonesia dengan jaringan yang tersebar di berbagai kota besar. Kami melayani berbagai kebutuhan pelanggan, mulai dari rental harian, mingguan, hingga jangka panjang untuk individu, perusahaan, dan wisatawan.</p>
                
                <h2>Visi</h2>
                <p>Menjadi penyedia layanan rental kendaraan terdepan di Indonesia yang memberikan kenyamanan, kepercayaan, dan solusi transportasi terbaik bagi semua pelanggan.</p>

                <h2>Misi</h2>
                <ul>
                    <li>Menyediakan berbagai jenis kendaraan yang aman, terawat, dan siap pakai sesuai kebutuhan pelanggan.</li>
                    <li>Memberikan pelayanan prima dan responsif kepada pelanggan, baik perorangan maupun korporasi.</li>
                    <li>Menerapkan inovasi teknologi terbaru untuk mempermudah proses rental kendaraan.</li>
                    <li>Membangun kemitraan strategis dengan perusahaan otomotif dan sektor pariwisata untuk mendukung perkembangan industri transportasi di Indonesia.</li>
                    <li>Mengedepankan standar keselamatan dan kualitas layanan untuk memenuhi ekspektasi pelanggan.</li>
                </ul>

                <h2>Layanan Kami</h2>
                <ul>
                    <li>Rental mobil harian, mingguan, dan bulanan.</li>
                    <li>Rental kendaraan untuk perusahaan dan instansi.</li>
                    <li>Layanan antar jemput bandara.</li>
                    <li>Paket rental kendaraan dengan sopir.</li>
                    <li>Layanan pemeliharaan kendaraan.</li>
                </ul>

                <h2>Nilai-Nilai Perusahaan</h2>
                <ul>
                    <li><strong>Integritas</strong>: Kami selalu berpegang pada komitmen untuk memberikan layanan yang jujur dan transparan kepada setiap pelanggan.</li>
                    <li><strong>Profesionalisme</strong>: Seluruh tim kami berdedikasi untuk memberikan pelayanan terbaik dengan standar tinggi.</li>
                    <li><strong>Inovasi</strong>: Kami terus berinovasi untuk memberikan layanan yang lebih baik melalui teknologi dan sistem yang memudahkan pelanggan.</li>
                    <li><strong>Keselamatan</strong>: Kami mengutamakan keselamatan pengguna dengan memastikan seluruh kendaraan dalam kondisi prima dan layak jalan.</li>
                </ul>
            ',
            'email'                 => 'mail@amperakoding.com',
            'phone'                 => '087749585200',
            'address'               => 'Jl. Kopral Anwar Komplek Hayyun Nasyim No. 9, Palembang, Indonesia',
            'facebook_link'         => 'https://facebook.com/amperakoding',
            'instagram_link'        => 'https://instagram.com/amperakoding',
            'twitter_link'          => null,
            'gmap_link'             => 'https://maps.app.goo.gl/E7fM3dDYhExt1N8p6',
            'gmap_location'         => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d365.09204337083014!2d104.77778135650247!3d-2.922659292038685!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e3b7791f3284acf%3A0x68816c9e3cfaae47!2sAmperaKoding!5e0!3m2!1sid!2sid!4v1708129801660!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
            'tax_name'              => 'PPN',
            'tax_value'             => 11,
            'tax_status'            => 0,
            'driver_price_daily'    => '500000',
            'logo'                  => 'company-logo.png',
            'logo_thumbnail'        => 'company-logo-thumbnail.png',
            'favicon'               => 'favicon.png',
        ]);
    }
}
