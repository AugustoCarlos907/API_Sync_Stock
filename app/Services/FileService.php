<?php 

namespace App\Services;

use App\Repositories\Interfaces\FileInterface;

class FileService{
    public function __construct(
        public FileInterface $repository
        ){}

    public function getAllFiles($companyId){
        return $this->repository->getAllFiles($companyId);
    }
    

    public function saveFile( $data = []){

        return $this->repository->saveFile($data);
    }

    
}