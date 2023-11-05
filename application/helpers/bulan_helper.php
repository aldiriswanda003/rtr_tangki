<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('bulan_to_string')) {
    function bulan_to_string($bulan)
    {
        $bulanArray = array(
            // 01 => "Januari",
            // 02 => "Februari",
            // 03 => "Maret",
            // 04 => "April",
            // 05 => "Mei",
            // 06 => "Juni",
            // 07 => "Juli",
            // 08 => "Agustus",
            // 09 => "September",
            // 10 => "Oktober",
            // 11 => "November",
            // 12 => "Desember"

            1 => "Januari",
            2 => "Februari",
            3 => "Maret",
            4 => "April",
            5 => "Mei",
            6 => "Juni",
            7 => "Juli",
            8 => "Agustus",
            9 => "September",
            10 => "Oktober",
            11 => "November",
            12 => "Desember"
        );

        return $bulanArray[$bulan];
    }
}
