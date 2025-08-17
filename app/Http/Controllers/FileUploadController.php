<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class FileUploadController extends Controller
{
    /**
     * Handle file upload with better error handling
     */
    public function upload(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'file' => [
                    'required',
                    'file',
                    'max:51200', // 50MB in KB
                    'mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,txt,rtf'
                ],
                'directory' => 'sometimes|string'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'File validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            $file = $request->file('file');
            $directory = $request->get('directory', 'lessons/documents');

            // Generate unique filename
            $filename = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();

            // Store file
            $path = $file->storeAs($directory, $filename, 'public');

            if (!$path) {
                throw new \Exception('Failed to store file');
            }

            return response()->json([
                'success' => true,
                'message' => 'File uploaded successfully',
                'data' => [
                    'path' => $path,
                    'url' => Storage::disk('public')->url($path),
                    'filename' => $filename,
                    'original_name' => $file->getClientOriginalName(),
                    'size' => $file->getSize(),
                    'mime_type' => $file->getMimeType()
                ]
            ]);

        } catch (\Exception $e) {
            \Log::error('File upload error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'File upload failed: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Check upload configuration
     */
    public function checkConfig()
    {
        $config = [
            'storage_linked' => is_link(public_path('storage')),
            'storage_writable' => is_writable(storage_path('app/public')),
            'directories_exist' => [
                'lessons' => is_dir(storage_path('app/public/lessons')),
                'documents' => is_dir(storage_path('app/public/lessons/documents')),
                'thumbnail' => is_dir(storage_path('app/public/thumbnail'))
            ],
            'php_limits' => [
                'upload_max_filesize' => ini_get('upload_max_filesize'),
                'post_max_size' => ini_get('post_max_size'),
                'max_file_uploads' => ini_get('max_file_uploads'),
                'memory_limit' => ini_get('memory_limit')
            ],
            'disk_space' => disk_free_space(storage_path()) / (1024 * 1024) // MB
        ];

        return response()->json($config);
    }
}
