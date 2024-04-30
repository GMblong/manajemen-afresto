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
