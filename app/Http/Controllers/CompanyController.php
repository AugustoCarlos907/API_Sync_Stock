<?php

namespace App\Http\Controllers;

use App\Services\CompanyService;
use Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function __construct(
        public CompanyService $service){}

    
    public function index(): JsonResponse{
        $user = Auth::user();
        $companies = $user->company;

        $data = $this->service->getAllCompanies($companies);
        return response()->json(['data' => $data], 200);
    }
    
    public function show($id): JsonResponse{
        $company = $this->service->getCompanyById($id);
        if(!$company){
            return response()->json(['message' => 'Company not found'], 404);
        }
        return response()->json(['data' => $company], 200);
    }

    public function delete($id): JsonResponse{
        $company = $this->service->deleteCompany($id);

        if(!$company){
            return response()->json(['message' => 'Company not found'], 404);
        }

        return response()->json(['message' => 'Company deleted successfully'], 200);

    }

}
