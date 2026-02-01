<?php 


namespace App\Services;

use App\Repositories\Interfaces\CompanyInterface;

class CompanyService
{
    public function __construct(
        public CompanyInterface $repository
    ){}

    public function getAllCompanies($companies = []): mixed{
        return $this->repository->getAllCompanies($companies);
    }

    public function getCompanyById($id): mixed
    {
        return $this->repository->getCompanyById($id);
    }


    public function updateCompany($id, array $data): mixed
    {
        return $this->repository->updateCompany($id, $data);
    }

    public function deleteCompany($id): mixed
    {
        return $this->repository->deleteCompany($id);
    }
}
