<?php

namespace App\Services\Number\Application\Query;

use App\Services\Number\Application\Hydrator\ListHydrator;
use App\Services\Number\Infrastructure\Repository\CountryRepository;
use App\Services\Number\Infrastructure\Repository\NumberRepository;

class GetCountriesQuery
{

    public function __construct(
        protected CountryRepository $countryRepository
    ) {
    }

    public function execut(): array
    {
        return $this->countryRepository->getAll();
    }
}
