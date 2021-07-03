<?php

namespace App\Services\Number\Infrastructure\Repository;

use App\Services\Number\Domain\ValueObject\Country;
use JetBrains\PhpStorm\Pure;

class CountryRepository
{

    protected array $unitOfWork = [];

    public function getAll(): array
    {
        dd($this->loadResource());
    }

    public function getByCode($code): Country
    {
        $countries = $this->loadResource();
        foreach ($countries as $country){
            if ($code == $country['code']) {
                if (!array_key_exists($code, $this->unitOfWork)) {
                    $this->unitOfWork[$code] = $this->mapToDomain($country);
                }
                return $this->unitOfWork[$code];
            }
        }
        throw new \Exception("This code didn't match any country");
    }

    #[Pure] public function mapToDomain(array $country): Country
    {
        return new Country($country['name'], $country['code'], $country['matchExpression']);
    }

    private function loadResource()
    {
        return json_decode(file_get_contents(__DIR__.'/../../../../../database/countries.json'), true);
    }
}
