<?php 


namespace App\Repositories;

use App\Models\Company;
use App\Repositories\Interfaces\CompanyInterface;
use Illuminate\Database\Eloquent\Collection;
use stdClass;

class CompanyRepository implements CompanyInterface
{
    public function getAllCompanies($companies = []): Collection
    {
        return Company::with('user')->whereIn('id', $companies->pluck('id'))->get();
    }

    public function getCompanyById($id): Collection|Company|stdClass|null
    {
        return Company::findOrFail($id);
    }


    public function updateCompany($id, array $data): bool
    {
        $company = Company::findOrFail($id);
        return $company->update($data);
    }

    public function deleteCompany($id): bool|null
    {
        $company = Company::findOrFail($id);
        return $company->delete();
    }
}