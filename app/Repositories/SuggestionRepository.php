<?php

namespace App\Repositories;

use App\Models\Suggestion;
use Iqbalatma\LaravelServiceRepo\BaseRepository;

class SuggestionRepository extends BaseRepository
{
    protected $model;

    public function __construct()
    {
        $this->model = new Suggestion();
    }
}
