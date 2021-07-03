<?php

namespace App\Services\Number\Infrastructure\Mapper;

use App\Services\Number\Domain\Model\Number;
use App\Services\Number\Domain\Repository\CountryRepositoryInterface;

class AggregateMapper
{

    public function __construct(protected CountryRepositoryInterface $countryRepository)
    {
    }

    public function mapList(array $numbers): array
    {
        foreach ($numbers as $number){
            $this->injectionCountry($number);
        }
        return $numbers;
    }

    protected function injectionCountry(Number $number): void
    {
        $country = $this->countryRepository->getByCode($number->getCountryCode());
        $number->assignCountry($country);
    }
}
