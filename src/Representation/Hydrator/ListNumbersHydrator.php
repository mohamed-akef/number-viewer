<?php

namespace App\Representation\Hydrator;

use App\Services\Number\Domain\Model\Number;

class ListNumbersHydrator
{

    public function hydrate(array $numbers): array
    {
        $hydratedNumbers = [];
        /**
         * @var Number $number
         */
        foreach ($numbers as $number) {
            $hydratedNumbers[] = [
                'Country' => $number->getCountry()->getName(),
                'status' => $number->IsValid()?'OK':'NOK',
                'Country Code' => '+'.$number->getCountryCode(),
                'Number' => $number->getPhone(true)
            ];
        }
        return $hydratedNumbers;
    }
}
