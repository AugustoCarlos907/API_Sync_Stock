<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFileRequest;
use App\Jobs\ParseStockCsvJob;
use App\Models\StockFile;
use App\Services\FileService;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Session\Store;

class FileController extends Controller
{
    public function __construct(
        public FileService $service,
    ){}


    public function index(){
        $companyId = auth()->user()->id;
        $files = $this->service->getAllFiles($companyId);

        return response()->json([
            'files' => $files
        ], 200);

        if(!$files || $files->isEmpty()){
            return response()->json([
                'message' => 'No files found'
            ], 404);
        }


    }

    public function uploadFile(StoreFileRequest $request){
        $request->validated();

        if($request->hasFile('file')){
            $file = $request->file('file')->store('uploads');
            $relativePath = $file;
            $filename =  $request->file('file')->getClientOriginalName();

            $companyId = Auth::user()->id;

            $stockFile = $this->service->saveFile([
                'file_path' => $relativePath, 
                'file_name' => $filename,
                'company_id' => $companyId,
            ]);

            ParseStockCsvJob::dispatch($stockFile);

            return response()->json([
                'message' => 'File uploaded successfully',
                'file_path' => $relativePath,
            ], 201);
        } else {
            return response()->json([
                'message' => 'No file uploaded'
            ], 400);
        }
    }
}
