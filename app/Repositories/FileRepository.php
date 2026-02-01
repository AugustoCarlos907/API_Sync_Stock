<?php 

namespace App\Repositories;

use App\Models\StockFile;
use App\Repositories\Interfaces\FileInterface;
use File;
use Illuminate\Database\Eloquent\Collection;

class FileRepository implements FileInterface
{

    public function getAllFiles($companyId): Collection
    {
        return StockFile::where('company_id', $companyId)->get();
    }
    public function saveFile( $data = [])
    {
        return StockFile::create($data);
    }   
}