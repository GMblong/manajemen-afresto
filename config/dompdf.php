<?php

return [
    'show_warnings' => false,   // Throw an Exception on warnings from dompdf

    'public_path' => null,  // Override the public path if needed

    'convert_entities' => true,

    'options' => [
        'isPhpEnabled' => true, // Enable PHP execution
        'isHtml5ParserEnabled' => true, // Enable HTML5 parser
        'font_dir' => storage_path('fonts'),
        'font_cache' => storage_path('fonts'),
        'temp_dir' => sys_get_temp_dir(),
        'chroot' => realpath(base_path()),
        'allowed_protocols' => [
            "file://" => ["rules" => []],
            "http://" => ["rules" => []],
            "https://" => ["rules" => []],
        ],
        'log_output_file' => null,
        'enable_font_subsetting' => false,
        'pdf_backend' => "CPDF",
        'default_media_type' => "screen",
        'default_paper_size' => "a4",
        'default_paper_orientation' => "portrait",
        'default_font' => "serif",
        'dpi' => 96,
        'enable_php' => false,
        'enable_javascript' => true,
        'enable_remote' => true,
        'font_height_ratio' => 1.1,
        'enable_html5_parser' => true,
        'margin_top' => 0,    // Mengatur margin atas ke nol
        'margin_right' => 0,  // Mengatur margin kanan ke nol
        'margin_bottom' => 0, // Mengatur margin bawah ke nol
        'margin_left' => 0,   // Mengatur margin kiri ke nol
    ],
];

