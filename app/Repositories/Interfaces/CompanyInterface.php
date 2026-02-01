<?php

namespace App\Repositories\Interfaces;

interface CompanyInterface
{
    public function getAllCompanies($companies = []);

    public function getCompanyById($id);


    public function updateCompany($id, array $data);    

    public function deleteCompany($id);

}
