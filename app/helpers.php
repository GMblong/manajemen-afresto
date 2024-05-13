<?php

if (!function_exists('formatCurrency')) {
    /**
     * Format angka ke dalam format mata uang.
     *
     * @param int|float $amount
     * @param string $currency
     * @return string
     */
    function formatCurrency($amount, $currency = 'Rp') {
        return $currency . number_format($amount, 0, ',', '.');
    }

    function terbilang($number) {
        $bilangan = array(
            '',
            'satu',
            'dua',
            'tiga',
            'empat',
            'lima',
            'enam',
            'tujuh',
            'delapan',
            'sembilan',
            'sepuluh',
            'sebelas'
        );
    
        if ($number < 12) {
            return $bilangan[$number];
        } elseif ($number < 20) {
            return $bilangan[$number - 10] . ' belas';
        } elseif ($number < 100) {
            return $bilangan[(int) ($number / 10)] . ' puluh ' . $bilangan[$number % 10];
        } elseif ($number < 200) {
            return 'seratus ' . terbilang($number - 100);
        } elseif ($number < 1000) {
            return $bilangan[(int) ($number / 100)] . ' ratus ' . terbilang($number % 100);
        } elseif ($number < 2000) {
            return 'seribu ' . terbilang($number - 1000);
        } elseif ($number < 1000000) {
            return terbilang((int) ($number / 1000)) . ' ribu ' . terbilang($number % 1000);
        } elseif ($number < 1000000000) {
            return terbilang((int) ($number / 1000000)) . ' juta ' . terbilang($number % 1000000);
        }
    
        return 'undefined';
    }
    
}      

if (!function_exists('getIndonesianMonth')) {
    /**
     * Get Indonesian month name based on month number.
     *
     * @param int $monthNumber
     * @return string
     */
    function getIndonesianMonth($monthNumber)
    {
        $monthNames = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        ];

        return $monthNames[$monthNumber] ?? 'Invalid Month';
    }
}


if (!function_exists('customHelperFunction')) {
    /**
     * Fungsi pembantu kustom.
     *
     * @param mixed $parameter
     * @return mixed
     */
    function customHelperFunction($parameter) {
        // Lakukan sesuatu dengan parameter dan kembalikan hasilnya
    }
}

if (!function_exists('formatMonthYear')) {
    function formatMonthYear($date)
    {
        return strftime('%B %Y', strtotime($date));
    }
}


// Definisikan fungsi-fungsi pembantu lainnya di sini
