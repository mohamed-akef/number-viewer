<?php

namespace App\Services\Number\Domain\Repository;

use App\Services\Number\Domain\ValueObject\Country;

interface CountryRepositoryInterface
{
    public function getByCode($code): Country;
}
