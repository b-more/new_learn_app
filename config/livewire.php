<?php
// config/livewire.php - Create this file to fix Livewire upload issues

return [
    'class_namespace' => 'App\\Http\\Livewire',
    'view_path' => resource_path('views/livewire'),
    'layout' => 'layouts.app',
    'lazy_loading_placeholder' => null,

    // IMPORTANT: Temporary file upload configuration
    'temporary_file_upload' => [
        'disk' => 'local',  // Use 'local' instead of 'public' for temp files
        'rules' => ['file', 'max:51200'], // 50MB max
        'directory' => 'livewire-tmp',
        'middleware' => null,
        'preview_mimes' => [
            'png', 'gif', 'bmp', 'svg', 'wav', 'mp4',
            'mov', 'avi', 'wmv', 'mp3', 'm4a',
            'jpg', 'jpeg', 'mpga', 'webp', 'pdf'
        ],
        'max_upload_time' => 5, // minutes
    ],

    'render_on_redirect' => false,
    'legacy_model_binding' => false,
    'inject_assets' => true,
    'navigate' => [
        'show_progress_bar' => true,
    ],
    'back_button_cache' => false,
];
