<?php

namespace App\Http\Controllers;

use App\Services\FileService;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function __construct(
        public FileService $service
    ){}

    public function uploadFile(Request $request){
        
        $request->validate([
            'file' => 'required|file|mimes:csv,txt|max:2048',
        ]);

        if($request->hasFile('file')){
            $file = $request->file('file');
            $filename = uniqid().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads'), $filename);
            $filePath = public_path('uploads').'/'.$filename;

            $companyId = auth()->user()->company_id;

            $this->service->saveFile([
                'file_path' => $filePath,
                'file_name' => $filename,
                'company_id' => $companyId
            ]);

            return response()->json([
                'message' => 'File uploaded successfully',
                'file_path' => $filePath
            ], 201);
        } else {
            return response()->json([
                'message' => 'No file uploaded'
            ], 400);
        }

    }
}
