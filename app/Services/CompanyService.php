<?php 


namespace App\Services;

use App\Repositories\Interfaces\CompanyInterface;

class CompanyService
{
    protected $repository;
    public function __construct(CompanyInterface $repository){
        $this->repository = $repository;
    }

    public function getAllCompanies(): mixed{
        return $this->repository->getAllCompanies();
    }

    public function getCompanyById($id): mixed
    {
        return $this->repository->getCompanyById($id);
    }

    public function createCompany(array $data): mixed
    {
        return $this->repository->createCompany($data);
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
