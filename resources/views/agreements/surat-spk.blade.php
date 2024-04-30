<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Perjanjian Kerjasama</title>
    <style>
        body {
            background-image: url('watermark-spk.png');
            background-repeat: no-repeat;
            background-size: 110%;
            background-position: center;
        }
        @page {
            margin: 0;
        }

        .container {
            max-width: 600px;
            margin: auto;
        }
        
        .page-break {
            page-break-after: always;
        }

        h5 {
            text-align: center;
        }

        p,table {
            font-size: 15px;
            text-align: justify;
        }

        table{
            margin-left: -0.5%;
        }

        .text-center {
            text-align: center;
        }

        .text-italic {
            font-style: italic;
        }

        .indent {
            text-indent: 0.53cm; /* Sesuaikan dengan format yang diinginkan */
        }

        .signature {
            width: 50%;
        }

        .jarak{
            margin-top: 150px;
        }

        .footer {
            font-size: 0.8rem;
            text-align: center;
            margin-right: 50px;
            position: fixed;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="jarak">
        <p class="text-center"><strong>PERJANJIAN KERJASAMA</strong></p>
        <p class="text-center" style="text-transform: uppercase;"><strong>PT AFRESTO SISTEM INDONESIA</strong></p>
        <p class="text-center"><strong>DENGAN</strong></p>
        <p class="text-center" style="text-transform: uppercase;"><strong>{{ $agreementData->school->name }}</strong></p>
        <p class="text-center"><strong>TENTANG</strong></p>
        <p class="text-center"><strong>PERANCANGAN DAN PENERAPAN LEARNING MANAGEMENT SYSTEM <br>(E-LEARNING)</strong></p>

        </div>
        
        <p>_________________________________________________________________________________</p>

        <table style="margin-left: 32%; margin-top: 10px; ">
            <tr>
                <td>Nomor</td>
                <td>:</td>
                <td><strong>{{ $agreementData->agreements_number }}</strong></td>
            </tr>
            <tr style="margin-top: 10px;">
                <td>Nomor</td>
                <td>:</td>
                <td><strong>{{ $agreementData->school_letter_number }}</strong></td>
            </tr>

        </table>

        <p>Pada  hari  ini, 
            tanggal {{ ucwords(terbilang(\Carbon\Carbon::parse($agreementData->start_date)->isoFormat('D'))) }} 
            bulan {{ ucwords(terbilang(\Carbon\Carbon::parse($agreementData->start_date)->isoFormat('M'))) }}
            tahun {{ ucwords(terbilang(\Carbon\Carbon::parse($agreementData->start_date)->isoFormat('Y'))) }} 
             yang bertandatangan di bawah ini :</p>
        <table >
            <tr>
                <td style="text-align: center; vertical-align: top;"><strong>I.</strong></td>
                <td><strong>PT Afresto Sistem Indonesia</strong>, suatu badan hukum berbentuk perseroan terbatas yang berkedudukan di Denpasar dan beralamat di Jalan Jayagiri XVIII No.5 Denpasar, didirikan berdasarkan Akta No.01 tanggal 9 Pebruari 2022 dibuat dihadapan Made Jaya Winata, SH., M.Kn., Notaris di kota Denpasar, akta mana telah mendapat pengesahan dari Kementerian Hukum dan Hak Asasi Manusia Republik Indonesia sebagaimana tercantum dalam Surat Keputusan No. AHU-0013970.AH.01.01.TAHUN 2022 tanggal 23 Pebruari 2022., dalam hal ini diwakili oleh Adimas Sulistyadi, S.Pd., selaku Kepala Divisi Marketing perseroan, maka dari dan oleh karenannya sah dan berwenang bertindak untuk dan atas nama  PT Afresto Sistem Indonesia, selanjutnya disebut dengan <strong>PIHAK PERTAMA</strong></td>
            </tr>
            <tr>
                <td style="text-align: center; vertical-align: top;"><strong>II.</strong></td>
                <td><strong>{{ $agreementData->school->name }}</strong>, kepala sekolah <strong>{{ $agreementData->school->headmaster_name }}</strong>, bertindak untuk dan atas nama <strong>{{ $agreementData->school->name }}</strong>, selanjutnya disebut <strong>PIHAK KEDUA</strong></td>
            </tr>
        </table>


        <p><strong>PIHAK PERTAMA</strong> dan <strong>PIHAK KEDUA</strong> secara bersama-sama disebut sebagai <strong>PARA PIHAK</strong>.</p>

        <p><strong>PARA PIHAK</strong> masing-masing bertindak dalam kedudukan sebagaimana tersebut di atas menerangkan terlebih dahulu hal-hal sebagai berikut :</p>
        <table >
            <tr>
                <td style="text-align: center; vertical-align: top;"><strong>1.</strong></td>
                <td>Bahwa <strong>PIHAK PERTAMA</strong> adalah badan hukum yang berbentuk perseroan terbatas yang bergerak dibidang perdagangan, pembuatan sistem informasi, jasa konsultasi sistem informasi dan pelatihan sistem komputer, sebagaimana diatur dalam Undang-Undang Republik Indonesia Nomor 40 Tahun 2007 tentang Perseroan Terbatas.</td>
            </tr>
            <tr>
                <td style="text-align: center; vertical-align: top;"><strong>2.</strong></td>
                <td>Bahwa <strong>PIHAK KEDUA</strong> adalah satuan pendidikan yang berjenjang dan berkesinambungan untuk menyelenggarakan kegiatan belajar mengajar sebagaimana diatur dalam Undang-Undang No.2 tahun 2000 tentang  Sistem Pendidikan Nasional.</td>
            </tr>
        
            <div class="page-break">
                <div class="jarak"><br></div>
            </div>
            <tr>
                <td style="text-align: center; vertical-align: top;"><strong>3.</strong></td>
                <td>Bahwa <strong>PIHAK KEDUA</strong> berkeinginan untuk menggunakan perancangan dan penerapan Learning Management Sistem milik <strong>PIHAK PERTAMA</strong>, sehubungan dengan hal tersebut <strong>PIHAK KEDUA</strong> telah menyampaikan keinginan tersebut kepada <strong>PIHAK PERTAMA</strong>.</td>
            </tr>

            <tr>
                <td style="text-align: center; vertical-align: top;"><strong>4.</strong></td>
                <td>Bahwa berdasarkan uraian pada huruf c tersebut di atas,  <strong>PIHAK PERTAMA</strong> telah menyatakan persetujuannya untuk melakukan kerja sama dengan <strong>PIHAK KEDUA</strong>, dan akan menuangkannya dalam bentuk perjanjian.</td>
            </tr>
        </table>
        <p>Berdasarkan hal-hal tersebut di atas, <strong>PARA PIHAK</strong> sepakat untuk mengikatkan diri ke dalam Perjanjian  ini (“Perjanjian”) dengan syarat-syarat dan ketentuan-ketentuan sebagai berikut:</p>

        <p class="text-center"><strong>PASAL 1</strong><br><strong>Ruang Lingkup Pekerjaan</strong></p>
        <table >
            <tr>
                <td style="text-align: center; vertical-align: top;"><strong>(1)</strong></td>
                <td><strong>PIHAK KEDUA</strong> dalam kedudukan sebagaimana tersebut di atas memberikan pekerjaan kepada <strong>PIHAK PERTAMA</strong> dan selanjutnya <strong>PIHAK PERTAMA</strong> wajib menerima dan melaksanakan pekerjaan untuk perancangan dan penerapan Learning Management Sistem  di Sekolah di bawah naungan <strong>{{ $agreementData->school->name }}</strong>.</td>
            </tr>
            <tr>
                <td style="text-align: center; vertical-align: top;"><strong>(2)</strong></td>
                <td>Penambahan dan/atau pengurangan terhadap lingkup Pekerjaan dapat dilakukan berdasarkan kesepakatan antara Para Pihak secara tertulis dan selanjutnya akan dituangkan dalam suatu addendum/amandemen yang merupakan bagian yang tidak terpisahkan dari Perjanjian ini.</td>
            </tr>
        </table>

        <p class="text-center"><strong>PASAL 2</strong><br><strong>Jangka Waktu Pelaksanaan</strong></p>
        <table >
            <tr>
                <td style="text-align: center; vertical-align: top;"><strong>(1)</strong></td>
                <td>Jangka Waktu Pelaksanaan pekerjaan  adalah 12 bulan terhitung mulai tanggal {{ \Carbon\Carbon::parse($agreementData->start_date)->isoFormat('D'). ' ' . getIndonesianMonth(\Carbon\Carbon::parse($agreementData->start_date)->format('n')) . ' ' . \Carbon\Carbon::parse($agreementData->start_date)->format('Y') }} sampai dengan tanggal {{ \Carbon\Carbon::parse($agreementData->end_date)->isoFormat('D'). ' ' . getIndonesianMonth(\Carbon\Carbon::parse($agreementData->end_date)->format('n')) . ' ' . \Carbon\Carbon::parse($agreementData->end_date)->format('Y') }}.</td>
            </tr>
            <tr>
                <td style="text-align: center; vertical-align: top;"><strong>(2)</strong></td>
                <td>Batas waktu sebagaimana dimaksud dalam ayat (1) Pasal ini dapat diperpanjang dengan adanya persetujuan dari <strong>PARA PIHAK</strong> dan akan diituangkan dalam perjanjian baru atau addendum yang ditandatangani <strong>PARA PIHAK</strong> dan merupakan bagian yang tidak terpisahkan dari Perjanjian ini.</td>
            </tr>
        </table>

        <p class="text-center"><strong>PASAL 3</strong><br><strong>Keamanan Data</strong></p>
        <table >
            <tr>
                <td style="text-align: center; vertical-align: top;"><strong>(1)</strong></td>
                <td><strong>PIHAK PERTAMA</strong> menjamin keamanan data milik <strong>PIHAK KEDUA</strong> dari segala bentuk penyalahgunaan data selain untuk maksud dan tujuan disepakatinya perjanjian ini. </td>
            </tr>
            <tr>
                <td style="text-align: center; vertical-align: top;"><strong>(2)</strong></td>
                <td>Bahwa apabila terjadi suatu insiden atau peristiwa hilangnya data yang menimbulkan kerugian <strong>PIHAK KEDUA</strong> dan dengan bukti yang cukup peristiwa tersebut terjadi karena sistem atau kelalaian <strong>PIHAK PERTAMA</strong>, maka <strong>PIHAK PERTAMA</strong> dengan ini menyatakan bersedia bertanggungjawab sepenuhnya mengganti rugi kerugian <strong>PIHAK KEDUA</strong> yang besar dan bentuknya akan diungkapkan kemudian.</td>
            </tr>
        </table>

        <div class="page-break">
            <div class="jarak">
            <p class="text-center"><strong>PASAL 4</strong><br><strong>Hak dan Kewajiban Pihak Pertama</strong></p>
                <table >
                    <tr>
                        <td style="text-align: center; vertical-align: top;"><strong>(1)</strong></td>
                        <td>Selain hak-hak yang telah ditentukan dalam pasal lain Perjanjian ini, <strong>PIHAK PERTAMA</strong> memiliki hak-hak sebagai berikut :
                            <table>
                            <tr>
                                <td style="text-align: center; vertical-align: top;"><strong>a.</strong></td>
                                <td>Menerima pembayaran dan mengajukan tagihan atas Harga Pekerjaan;</td>
                            </tr>
                            <tr>
                                <td style="text-align: center; vertical-align: top;"><strong>b.</strong></td>
                                <td>Memperoleh pembayaran tepat waktu atas Harga Pekerjaan sebagaimana diatur dalam Perjanjian ini; </td>
                            </tr>
                            <tr>
                                <td style="text-align: center; vertical-align: top;"><strong>c.</strong></td>
                                <td>Memperoleh informasi dan/atau data dari <strong>PIHAK KEDUA</strong> yang diperlukan dalam rangka melaksanakan Pekerjaan. </td>
                            </tr>
                            </table>
                        </td>
                    </tr>

                    <tr>
                        <td style="text-align: center; vertical-align: top;"><strong>(2)</strong></td>
                        <td>Selain kewajiban-kewajiban yang telah ditentukan dalam pasal lain Perjanjian ini, <strong>PIHAK PERTAMA</strong> memiliki kewajiban sebagai berikut :
                            <table>
                            <tr>
                                <td style="text-align: center; vertical-align: top;"><strong>a.</strong></td>
                                <td>Melengkapi fitur-fitur pembelajaran Laerning Management Sistem  yang dibutuhkan <strong>PIHAK KEDUA</strong> sesuai kesepakatan;</td>
                            </tr>
                            <tr>
                                <td style="text-align: center; vertical-align: top;"><strong>b.</strong></td>
                                <td>Memberikan fitur-fitur Learning Management Sistem  yang bisa digunakan oleh <strong>PIHAK KEDUA</strong>, antara lain :
                                    <ul>
                                        <li>Abensi KBM dan Jurnal Mengajar</li>
                                        <li>Video Conferance</li>
                                        <li>Upload Materi</li>
                                        <li>Evaluasi</li>
                                        <li>Penilaian hingga Cetak Raport dan Download Raport Oleh Siswa</li>
                                        <li>Laporan Harian untuk admin dan Kepala Sekolah</li>
                                        <li>Pengumuman Sekolah</li>
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: center; vertical-align: top;"><strong>c.</strong></td>
                                <td>Memastikan koneksi server hosting agar bisa diakses dengan baik; </td>
                            </tr>
                            <tr>
                                <td style="text-align: center; vertical-align: top;"><strong>d.</strong></td>
                                <td>Memastikan agar para Guru dari <strong>PIHAK KEDUA</strong> mendapatkan pelatihan. (import Nilai, cetak Rapor, download Leger, membuat Meteri,  dan Evaluasi pada e-learning);</td>
                            </tr>
                            <tr>
                                <td style="text-align: center; vertical-align: top;"><strong>e.</strong></td>
                                <td>Memastikan agar petugas administrator Sekolah dapat menjalankan dan melakukan perubahan seperlunya pada sistem E-Learning;</td>
                            </tr>
                            <tr>
                                <td style="text-align: center; vertical-align: top;"><strong>f.</strong></td>
                                <td>Bertanggung jawab untuk keamanan data yang ada di dalam sistem E-Learning di Sekolah (<strong>PIHAK KEDUA</strong>);</td>
                            </tr>
                            <tr>
                                <td style="text-align: center; vertical-align: top;"><strong>g.</strong></td>
                                <td>Mengatasi trouble yang terjadi apabila permasalahan disebabkan dari sisi server, sistem aplikasi E-Learning, dan disfungsi fitur yang ada di dalam sistem E-Learning;</td>
                            </tr>
                            <tr>
                                <td style="text-align: center; vertical-align: top;"><strong>h.</strong></td>
                                <td>Melakukan Maintenance server hosting dan domain;</td>
                            </tr>
                            <tr>
                                <td style="text-align: center; vertical-align: top;"><strong>i.</strong></td>
                                <td>Memberikan kontrol sistem dengan melakukan pengecekan oleh petugas (sesuai panggilan SEKOLAH), dan melalui telephone;</td>
                            </tr>
                            <tr>
                                <td style="text-align: center; vertical-align: top;"><strong>j.</strong></td>
                                <td>Memberikan Ilmu yang cukup kepada administrator sehingga administrator sekolah dapat mengatasi seluruh permasalahan yang ada pada sistem  E-learning tersebut.</td>
                            </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="page-break">
            <div class="jarak">
            <p class="text-center"><strong>PASAL 5</strong><br><strong>Hak dan Kewajiban PIHAK KEDUA</strong></p>
            <table>
                <tr>
                    <td style="text-align: center; vertical-align: top;"><strong>(1)</strong></td>
                    <td>Selain hak-hak yang telah ditentukan dalam pasal lain Perjanjian ini, <strong>PIHAK KEDUA</strong> memiliki hak-hak sebagai berikut:
                        <table>
                            <tr>
                                <td style="text-align: center; vertical-align: top;"><strong>a.</strong></td>
                                <td>Memperoleh Hasil Pekerjaan secara lengkap dan sesuai yang disepakati;</td>
                            </tr>
                            <tr>
                                <td style="text-align: center; vertical-align: top;"><strong>b.</strong></td>
                                <td>Menerima laporan-laporan atas pelaksanaan Pekerjaan dari <strong>PIHAK PERTAMA</strong>;</td>
                            </tr>
                            <tr>
                                <td style="text-align: center; vertical-align: top;"><strong>c.</strong></td>
                                <td>Menyerahkan kewenangan untuk melakukan pengawasan dan memberikan arahan pada saat pelaksanaan Perjanjian ini kepada personil <strong>PIHAK KEDUA</strong> yang ditunjuk;</td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <tr>
                    <td style="text-align: center; vertical-align: top;"><strong>(2)</strong></td>
                    <td>Selain kewajiban-kewajiban yang telah ditentukan dalam pasal lain Perjanjian ini, <strong>PIHAK KEDUA</strong> berkewajiban untuk:
                        <table>
                            <tr>
                                <td style="text-align: center; vertical-align: top;"><strong>a.</strong></td>
                                <td>Memastikan seluruh data kelas, guru, siswa, dan pembagian mengajar siswa sudah tepat sebelum diserahkan ke <strong>PIHAK PERTAMA</strong>;</td>
                            </tr>
                            <tr>
                                <td style="text-align: center; vertical-align: top;"><strong>b.</strong></td>
                                <td>Memastikan rumusan penilaian fix (sudah final) sebelum diserahkan ke <strong>PIHAK PERTAMA</strong>;</td>
                            </tr>
                            <tr>
                                <td style="text-align: center; vertical-align: top;"><strong>c.</strong></td>
                                <td>Menghimbau kepada Guru, peserta didik, dan orang tua agar menyimpan kerahasiaan password dan username masing-masing, serta menghimbau agar secara berkala dilakukan penggantian password;</td>
                            </tr>
                            <tr>
                                <td style="text-align: center; vertical-align: top;"><strong>d.</strong></td>
                                <td>Bertanggung jawab terhadap Isi Konten E-Learning;</td>
                            </tr>
                            <tr>
                                <td style="text-align: center; vertical-align: top;"><strong>e.</strong></td>
                                <td>Menyediakan 2 Guru / petugas yang ditunjuk untuk menjadi administrator sistem agar bisa bersama-sama memantau jalannya sistem;</td>
                            </tr>
                            <tr>
                                <td style="text-align: center; vertical-align: top;"><strong>f.</strong></td>
                                <td>Apabila terjadi lupa / kehilangan password, maka administrator sekolah dapat melakukan Reset password;</td>
                            </tr>
                            <tr>
                                <td style="text-align: center; vertical-align: top;"><strong>g.</strong></td>
                                <td>Segera melaporkan keluhan terhadap sistem yang datang dari Guru dan Peserta didik kepada <strong>PIHAK PERTAMA</strong>;</td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>

            <p class="text-center"><strong>PASAL 6</strong><br><strong>Tahapan Sosialisasi Learning Management Sistem</strong></p>
                <table>
                    <tr>
                        <td style="text-align: center; vertical-align: top;"><strong>(1)</strong></td>
                        <td><strong>PIHAK PERTAMA</strong> selaku pengembang sistem informasi komputer memberikan sosialisasi dan pelatihan terhadap guru dan peserta didik sekolah sebelum melakukan penerapan Learning Management Sistem (LMS);</td>
                    </tr>
                    <tr>
                        <td style="text-align: center; vertical-align: top;"><strong>(2)</strong></td>
                        <td>Pada Tahapan Sosialisasi E-Learning, akan ada petugas dari <strong>PIHAK PERTAMA</strong> untuk melakukan cek dan pendampingan dari guru <strong>PIHAK KEDUA</strong> selama masih diperlukan/sesuai panggilan;</td>
                    </tr>
                    <tr>
                        <td style="text-align: center; vertical-align: top;"><strong>(3)</strong></td>
                        <td><strong>PIHAK PERTAMA</strong> menampung fitur & masukan dari <strong>PIHAK KEDUA</strong> sesuai dengan kebutuhan yang ada;</td>
                    </tr>
                    <tr>
                        <td style="text-align: center; vertical-align: top;"><strong>(4)</strong></td>
                        <td>Pelaksanaan Tahapan Sosialisasi E-Learning dapat ditambah sesuai dengan kesepakatan bersama antara <strong>PIHAK PERTAMA</strong> dan <strong>PIHAK KEDUA</strong>.</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="page-break">
            <div class="jarak">
            <p class="text-center"><strong>PASAL 7</strong><br><strong>Tahapan Penerapan Learning Management Sistem</strong></p>
                <table>
                    <tr>
                        <td style="text-align: center; vertical-align: top;"><strong>(1)</strong></td>
                        <td><strong>PIHAK PERTAMA</strong> menindaklanjuti semua fitur & masukan dari <strong>PIHAK KEDUA</strong> pada penerapan sistem E-Learning di sekolah.</td>
                    </tr>
                    <tr>
                        <td style="text-align: center; vertical-align: top;"><strong>(2)</strong></td>
                        <td><strong>PIHAK PERTAMA</strong> bersedia menerima perubahan fitur, atas dasar masukan dari <strong>PIHAK KEDUA</strong> sesuai dengan kebutuhan pada penerapan sistem E-Learning di sekolah.</td>
                    </tr>
                    <tr>
                        <td style="text-align: center; vertical-align: top;"><strong>(3)</strong></td>
                        <td><strong>PIHAK PERTAMA</strong> memberikan pendampingan pada penerapan Sistem E-Learning kepada para guru dan peserta didik dari <strong>PIHAK KEDUA</strong>.</td>
                    </tr>
                    <tr>
                        <td style="text-align: center; vertical-align: top;"><strong>(4)</strong></td>
                        <td><strong>PIHAK PERTAMA</strong> secara rutin memberikan pendampingan kepada administrator sistem untuk dapat melaksanakan sistem E-Learning di sekolah.</td>
                    </tr>
                </table>

                <p class="text-center"><strong>PASAL 8</strong><br><strong>Tahapan Start Semester Baru</strong></p>
                <table>
                    <tr>
                        <td style="text-align: center; vertical-align: top;"><strong>(1)</strong></td>
                        <td><strong>PIHAK KEDUA</strong> mengirimkan data formasi mengajar, data guru, data walikelas, dan data siswa kepada <strong>PIHAK PERTAMA</strong>.</td>
                    </tr>
                    <tr>
                        <td style="text-align: center; vertical-align: top;"><strong>(2)</strong></td>
                        <td><strong>PIHAK PERTAMA</strong> akan mengerjakan seluruh proses input data berdasarkan data yang telah dikirim oleh <strong>PIHAK KEDUA</strong>.</td>
                    </tr>
                    <tr>
                        <td style="text-align: center; vertical-align: top;"><strong>(3)</strong></td>
                        <td>Setelah proses input data selesai oleh <strong>PIHAK PERTAMA</strong>, <strong>PIHAK KEDUA</strong> segera melakukan validasi data yang sudah selesai diinput oleh <strong>PIHAK PERTAMA</strong>.</td>
                    </tr>
                    <tr>
                        <td style="text-align: center; vertical-align: top;"><strong>(4)</strong></td>
                        <td>Apabila <strong>PIHAK KEDUA</strong> sudah selesai melakukan validasi dan data sudah sesuai, maka <strong>PIHAK PERTAMA</strong> akan segera melakukan proses start semester.</td>
                    </tr>
                </table>

                <p class="text-center"><strong>PASAL 9</strong><br><strong>Tahapan Pelaksanaan Evaluasi</strong></p>
                <table>
                    <tr>
                        <td style="text-align: center; vertical-align: top;"><strong>(1)</strong></td>
                        <td><strong>PIHAK KEDUA</strong> menginformasikan tanggal pelaksanaan Evaluasi bersama kepada <strong>PIHAK PERTAMA</strong> minimal 7 hari sebelum tanggal pelaksanaan Evaluasi bersama.</td>
                    </tr>
                    <tr>
                        <td style="text-align: center; vertical-align: top;"><strong>(2)</strong></td>
                        <td><strong>PIHAK KEDUA</strong> memastikan bahwa seluruh soal evaluasi sudah terinput dan sudah siap untuk dilakukan publish ke dalam sistem minimal 5 hari sebelum tanggal evaluasi berlangsung.</td>
                    </tr>
                    <tr>
                        <td style="text-align: center; vertical-align: top;"><strong>(3)</strong></td>
                        <td><strong>PIHAK KEDUA</strong> wajib melakukan Simulasi minimal 3 hari sebelum tanggal pelaksanaan, dan seluruh peserta didik wajib mengikuti simulasi.</td>
                    </tr>
                    <tr>
                        <td style="text-align: center; vertical-align: top;"><strong>(4)</strong></td>
                        <td><strong>PIHAK PERTAMA</strong> akan memantau pelaksanaan Evaluasi secara online dan memastikan evaluasi berjalan dengan baik dan lancar.</td>
                    </tr>
                    <tr>
                        <td style="text-align: center; vertical-align: top;"><strong>(5)</strong></td>
                        <td><strong>PIHAK PERTAMA</strong> tidak menerima tambahan atau perubahan fitur evaluasi satu minggu sebelum pelaksanaan evaluasi sampai dengan berakhirnya pelaksanaan evaluasi dari <strong>PIHAK KEDUA</strong>.</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="page-break">
            <div class="jarak">
            <p class="text-center"><strong>PASAL 10</strong><br><strong>Tahapan Penilaian dan Cetak Raport</strong></p>
                <table>
                    <tr>
                        <td style="text-align: center; vertical-align: top;"><strong>(1)</strong></td>
                        <td><strong>PIHAK KEDUA</strong> mengirimkan Format penilaian dan template rapor yang sudah dilakukan validasi internal oleh <strong>PIHAK KEDUA</strong> kepada <strong>PIHAK PERTAMA</strong> minimal satu bulan sebelum tanggal penerimaan raport.</td>
                    </tr>
                    <tr>
                        <td style="text-align: center; vertical-align: top;"><strong>(2)</strong></td>
                        <td><strong>PIHAK KEDUA</strong> harus melakukan cek hasil akhir raport yang sudah dikerjakan oleh <strong>PIHAK PERTAMA</strong> apabila ada perubahan minimal 7 hari sebelum penerimaan raport kecuali perubahan berdasarkan perubahan peraturan dari dinas Pendidikan.</td>
                    </tr>
                </table>

            <p class="text-center"><strong>PASAL 11</strong><br><strong>Tahapan Sosialisasi Siswa dan Guru</strong></p>
                <table>
                    <tr>
                        <td style="text-align: center; vertical-align: top;"><strong>(1)</strong></td>
                        <td><strong>PIHAK KEDUA</strong> sudah memastikan seluruh peserta didik dan guru sudah mencoba dengan melihat video yang sudah disiapkan oleh <strong>PIHAK PERTAMA</strong> minimal 3 hari sebelum pelaksanaan sosialisasi.</td>
                    </tr>
                    <tr>
                        <td style="text-align: center; vertical-align: top;"><strong>(2)</strong></td>
                        <td><strong>PIHAK PERTAMA</strong> akan mengirimkan tutor untuk melakukan sosialisasi ke seluruh peserta didik dan guru.</td>
                    </tr>
                </table>

                <p class="text-center"><strong>PASAL 12</strong><br><strong>Biaya Pekerjaan dan Tata Cara Pembayaran</strong></p>
                <table>
                    <tr>
                        <td style="text-align: center; vertical-align: top;"><strong>(1)</strong></td>
                        <td>Para Pihak sepakat untuk biaya Pekerjaan sesuai ruang lingkup Perjanjian adalah sebesar Rp. ………………………,- per siswa per bulan sudah termasuk pajak sesuai ketentuan yang berlaku, yang dibayarkan <strong>PIHAK KEDUA</strong> kepada <strong>PIHAK PERTAMA</strong> terhitung mulai bulan …………………. dan di bayarkan menggunakan dana BOS Melalui SIPLAH.</td>
                    </tr>
                    <tr>
                        <td style="text-align: center; vertical-align: top;"><strong>(2)</strong></td>
                        <td>Masa pemberlakuan biaya penerapan Learning Management Sistem Rp. …………….. per siswa per bulan akan menjadi harga tetap selama 12 (dua belas) bulan ke depan.</td>
                    </tr>
                    <tr>
                        <td style="text-align: center; vertical-align: top;"><strong>(3)</strong></td>
                        <td>Pembayaran biaya Pekerjaan dilakukan dengan cara pemindahbukuan atau transfer ke rekening <strong>PIHAK PERTAMA</strong> sebagai berikut:
                        <table style="margin-left: 25%; margin-top: 10px; border: 1px solid black;">
                            <tr>
                                <td>Nama</td>
                                <td>:</td>
                                <td><strong>PT Afresto Sistem Indonesia</strong></td>
                            </tr>
                            <tr>
                                <td>Nomor</td>
                                <td>:</td>
                                <td><strong>0154117778899</strong></td>
                            </tr>
                            <tr>
                                <td>Bank</td>
                                <td>:</td>
                                <td><strong>Mandiri Taspen (Mantap)</strong></td>
                            </tr>
                        </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: center; vertical-align: top;"><strong>(4)</strong></td>
                        <td>Pembayaran biaya Pekerjaan sebagaimana dimaksud pada ayat (1) Pasal ini akan dilaksanakan setelah <strong>PIHAK PERTAMA</strong> mengajukan penagihan yang dilampirkan dengan dukomen :
                            <table>
                                <tr>
                                    <td style="text-align: center; vertical-align: top;"><strong>a.</strong></td>
                                    <td>Asli Surat Pengantar Tagihan dengan mencantumkan nama Bank dan Nomor Rekening beserta salinannya</td>
                                </tr>
                                <tr>
                                    <td style="text-align: center; vertical-align: top;"><strong>b.</strong></td>
                                    <td>Asli kwitansi dan invoice bermeterai Rp 10.000,- </td>
                                </tr>
                                <tr>
                                    <td style="text-align: center; vertical-align: top;"><strong>c.</strong></td>
                                    <td>Asli Faktur Pajak atau E-Faktur beserta salinannya.</td>
                                </tr>
                                
                            </table>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="page-break">
            <div class="jarak">
            <p class="text-center"><strong>PASAL 13</strong><br><strong>Sanksi</strong></p>
            <p>Apabila terjadi suatu pelanggaran kesepakatan dalam masa berjalannya Perjanjian ini, maka <strong>PIHAK PERTAMA</strong> maupun <strong>PIHAK KEDUA</strong> dapat meninjau kembali untuk membatalkan kesepakatan yang telah dibuat dan meminta pertanggungjawaban sesuai dengan hak yang telah diatur dalam Perjanjian ini.</p>

            <p class="text-center"><strong>PASAL 14</strong><br><strong>Penyelesaian Masalah</strong></p>
                <table>
                    <tr>
                        <td style="text-align: center; vertical-align: top;"><strong>(1)</strong></td>
                        <td>Apabila terjadi suatu permasalahan dalam masa berjalannya Perjanjian, maka dapat dilaksanakan penyelesaian secara kekeluargaan di antara <strong>PIHAK PERTAMA</strong> dan <strong>PIHAK KEDUA</strong>.</td>
                    </tr>p
                    <tr>
                        <td style="text-align: center; vertical-align: top;"><strong>(2)</strong></td>
                        <td>Apabila penyelesaian masalah tidak dapat dicapai secara kekeluargaan, maka akan diselesaikan sesuai dengan hukum dan perundangan yang berlaku.</td>
                    </tr>
                </table>

            <p class="text-center"><strong>PASAL 15</strong><br><strong>Pemberitahuan</strong></p>
                <table>
                    <tr>
                        <td style="text-align: center; vertical-align: top;"><strong>(1)</strong></td>
                        <td>Setiap surat menyurat atau pemberitahuan dan/atau permintaan yang wajib dan perlu dilakukan Para Pihak dalam pelaksanaan Perjanjian ini wajib dibuat secara tertulis dan dapat disampaikan secara langsung atau melalui pos dan/atau faksimili dan/atau email ke alamat-alamat sebagai berikut:
                            <table style=" margin-top: 10px; margin-bottom: 10px; text-align: left" cellspacing="0">
                                <tr style="vertical-align: top;">
                                    <th colspan="2">PIHAK PERTAMA</th>
                                    <th colspan="2">PIHAK KEDUA</th>
                                </tr>
                                <tr style="vertical-align: top;">
                                    <td>Nama</td>
                                    <td><strong>PT Afresto Sistem Indonesia</strong></td>
                                    <td>Nama</td>
                                    <td><strong>{{ $agreementData->school->name }}</strong></td>
                                </tr>
                                <tr style="vertical-align: top; width: 100%">
                                    <td>Alamat</td>
                                    <td style="width: 40%;">Jl. Sinarmas Baru No 14, Kedungmundu, Tembalang, Semarang.</td>
                                    <td>Alamat</td>
                                    <td style="width: 40%;">{{ $agreementData->school->address }}</td>
                                </tr>
                                <tr style="vertical-align: top;">
                                    <td>Telp</td>
                                    <td>024 - 76416150</td>
                                    <td>Telp</td>
                                    <td>{{ $agreementData->school->phone_number }}</td>
                                </tr>
                                <tr style="vertical-align: top;">
                                    <td>HP</td>
                                    <td>08222-162-9997</td>
                                    <td>HP</td>
                                    <td>{{ $agreementData->school->phone_number }}</td>
                                </tr>
                                <tr>
                                    <td>Fax</td>
                                    <td>-</td>
                                    <td>Fax</td>
                                    <td>-</td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>Office@Afresto.id</td>
                                    <td>Email</td>
                                    <td>………………..</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: center; vertical-align: top;"><strong>(2)</strong></td>
                        <td>Setiap perubahan alamat sebagaimana dimaksud dalam pasal ini wajib diberitahukan secara tertulis oleh Pihak yang bersangkutan kepada Pihak lainnya selambat-lambatnya dalam jangka waktu 3 (tiga) hari kerja sebelumnya sehingga segala akibat keterlambatan pemberitahuan menjadi tanggung jawab Pihak yang melakukan perubahan tersebut. Apabila tidak ada pemberitahuan secara tertulis, maka alamat yang tercantum/diatur dalam Perjanjian ini dianggap sebagai alamat terakhir yang tercatat pada masing-masing Pihak.</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="jarak">
            <p class="text-center"><strong>PASAL 16</strong><br><strong><em>FORCE MAJEURE</em></strong></p>
                    <table>
                        <tr>
                            <td style="text-align: center; vertical-align: top;"><strong>(1)</strong></td>
                            <td>Yang dimaksud dengan <em>Force Majeure</em> adalah peristiwa-peristiwa yang terjadi diluar kemampuan kekuasaan Para Pihak yang berakibat tidak dapat dipenuhinya hak dan kewajiban Para Pihak. Adapun peristiwa yang dimaksud antara lain: gempa bumi besar, angin taufan, banjir besar, kebakaran besar, tanah longsor, wabah penyakit, pemogokan umum, huru–hara, sabotase, perang, pemberontakan, dan sebagainya.</td>
                        </tr>
                        <tr>
                            <td style="text-align: center; vertical-align: top;"><strong>(2)</strong></td>
                            <td>Apabila terjadi <em>Force Majeure</em> sebagaimana dimaksud pada ayat (1) Pasal ini, maka Pihak yang terkena <em>Force Majeure</em> wajib memberitahukan secara tertulis kepada Pihak lainnya dalam waktu 14 (empat belas) hari kalender terhitung sejak dimulainya kejadian sebagaimana dimaksud pada ayat (1) Pasal ini disertai keterangan resmi dari pejabat pemerintah yang berwenang.</td>
                        </tr>
                        <tr>
                            <td style="text-align: center; vertical-align: top;"><strong>(3)</strong></td>
                            <td>Kelalaian atau keterlambatan dalam memenuhi kewajiban, memberitahukan sebagaimana dimaksud pada ayat (2) Pasal ini mengakibatkan tidak diakuinya keadaan tersebut sebagaimana dimaksud pada ayat (1) Pasal ini sebagai <em>Force Majeure</em>.</td>
                        </tr>
                        <tr>
                            <td style="text-align: center; vertical-align: top;"><strong>(4)</strong></td>
                            <td>Pihak yang mengalami <em>Force Majeure</em> dibebaskan untuk sementara waktu dari kewajibannya melaksanakan isi Perjanjian ini baik sebagian maupun keseluruhan. Setelah <em>Force Majeure</em> tersebut berakhir, Pihak yang mengalami <em>Force Majeure</em> harus melaksanakan kembali kewajibannya sebagaimana dimaksud dalam Perjanjian ini.</td>
                        </tr>
                        <tr>
                            <td style="text-align: center; vertical-align: top;"><strong>(5)</strong></td>
                            <td>Segala dan setiap permasalahan yang timbul akibat terjadinya <em>Force Majeure</em> akan diselesaikan oleh Para Pihak secara musyawarah.</td>
                        </tr>
                    </table>

                    <p class="text-center"><strong>PASAL 17</strong><br><strong>Penutup</strong></p>
                        <p>Perjanjian ini dibuat dalam rangkap 2 (dua) masing-masing bermeterai cukup dan mempunyai kekuatan hukum yang sama, dengan disaksikan para saksi dan ditandatangani tanpa paksaan dari pihak manapun juga.</p>

                    <table style="width: 140%; margin-top: 60px;">
                    <tr>
                        <td><strong>PIHAK PERTAMA</strong></td>
                        <td><strong>PIHAK KEDUA</strong></td>
                    </tr>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <tr>
                        <td><strong>{{ $agreementData->company_directors->name  }} </strong></td>
                        <td><strong>{{ $agreementData->school->headmaster_name }}</strong></td>
                    </tr>
                    <tr>
                        <td>{{ $agreementData->company_directors->position }}</td>
                        <td>Kepala Sekolah</td>
                    </tr>
                </table>
        </div>
        <footer class="footer"></footer>
    </div>
</body>
</html>
