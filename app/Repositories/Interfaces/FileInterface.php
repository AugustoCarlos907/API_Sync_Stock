<?php 

namespace App\Repositories\Interfaces;

interface FileInterface
{
    public function getAllFiles($companyId);
    public function saveFile($data = []);
}