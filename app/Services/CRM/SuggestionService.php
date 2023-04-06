<?php

namespace App\Services\CRM;

use App\Repositories\SuggestionRepository;
use Exception;
use Iqbalatma\LaravelServiceRepo\BaseService;

class SuggestionService extends BaseService
{
    protected $repository;
    public function __construct()
    {
        $this->repository = new SuggestionRepository();
    }

    public function getAllData(): array
    {
        return [
            "title"       => "Suggestion",
            "description" => "Suggestion from customer",
            "cardTitle"   => "Suggestion",
            "suggestions"       => $this->repository->getAllDataPaginated()
        ];
    }
    public function addNewData(array $requestedData):array
    {
        try {
            $this->repository->addNewData($requestedData);
            $response = [
                "success" => true,
            ];
        } catch (Exception $e) {
            $response = [
                "success" => false,
                "message" => $e->getMessage()
            ];
        }
        return $response;
    }

}
