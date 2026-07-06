<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Tarif Pajak Tagihan
    |--------------------------------------------------------------------------
    |
    | Persentase pajak yang ditampilkan pada rincian tagihan (invoice) admin
    | maupun member. Default 0 (tidak dibebankan ke pelanggan) mengikuti
    | perilaku yang sudah berjalan di tampilan member sebelum disatukan
    | dengan tampilan admin. Ubah lewat FINANCE_TAX_RATE di .env bila
    | kebijakan pajak berubah di kemudian hari.
    |
    */
    'tax_rate' => env('FINANCE_TAX_RATE', 0),

    /*
    |--------------------------------------------------------------------------
    | Rasio Komisi Agen (dalam Poin)
    |--------------------------------------------------------------------------
    |
    | Jumlah rupiah pembayaran terverifikasi yang setara dengan 1 poin komisi
    | untuk agen yang menaungi jemaah terkait. Contoh: nilai 100000 berarti
    | agen mendapat 1 poin untuk setiap Rp 100.000 pembayaran yang diverifikasi.
    | Ini adalah rasio awal (placeholder) — sesuaikan lewat FINANCE_KOMISI_AGEN_POIN_PER_RP
    | di .env begitu aturan komisi resmi ditetapkan oleh bisnis.
    |
    */
    'komisi_agen_poin_per_rp' => env('FINANCE_KOMISI_AGEN_POIN_PER_RP', 100000),

    /*
    |--------------------------------------------------------------------------
    | Bonus Poin Referral
    |--------------------------------------------------------------------------
    |
    | Poin flat yang diberikan ke agen perujuk saat pembayaran PERTAMA dari
    | member yang direferensikannya berhasil diverifikasi. Placeholder awal —
    | sesuaikan lewat FINANCE_BONUS_REFERRAL_POIN di .env begitu aturan resmi
    | ditetapkan oleh bisnis.
    |
    */
    'bonus_referral_poin' => env('FINANCE_BONUS_REFERRAL_POIN', 10),
];
