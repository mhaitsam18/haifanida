<?php

if (! function_exists('rupiah')) {

    /**
     * Rupiah
     *
     * Konversi angka menjadi format rupiah
     *
     * @param string|int|float $angka Angka yang ingin dikonversi
     *
     * @return string
     */
    function rupiah(string|int|float $angka): string {
        $formatter = new \NumberFormatter('id_ID', \NumberFormatter::CURRENCY);

        return $formatter->formatCurrency($angka, 'IDR');
    }
}
