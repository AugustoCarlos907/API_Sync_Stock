<?php 

namespace App\Repositories;

use App\Models\StockFile;
use App\Repositories\Interfaces\FileInterface;
use File;

class FileRepository implements FileInterface
{

    public function saveFile( $data = [])
    {
        return StockFile::save($data= [] );
    }   
}