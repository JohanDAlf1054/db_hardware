<?php

return [
    'font_dir' => base_path('/public/fonts/'), // Directorio donde se almacenan las fuentes
    'font_cache' => storage_path('fonts/'), // Directorio de caché de fuentes
    'default_media_type' => 'screen',
    'default_paper_size' => 'a4',
    'default_font' => 'Oswald',
    'dpi' => 96,
    'font_height_ratio' => 1.1,
    'is_html5_parser_enabled' => true,
    'is_php_enabled' => false,
    'is_remote_enabled' => true,
    'is_javascript_enabled' => false,
    'is_font_subsetting_enabled' => false,
    'pdf_backend' => 'CPDF',
    'pdflib_license' => '',
    'enable_font_subsetting' => false,
    'chroot' => base_path(),
    'log_output_file' => storage_path('logs/dompdf.html'),
    'temp_dir' => storage_path('tmp/'),
];
