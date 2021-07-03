<?php

namespace App\Services\Number\Application\Query;

use App\Services\Number\Domain\Repository\NumberRepositoryInterface;

class GetNumbersQuery
{

    public function __construct(protected NumberRepositoryInterface $numberRepo)
    {
    }

    public function execut(
        ?int $limit = null,
        ?int $offset = null,
        ?int $countryCode = null,
        ?bool $validStatus = null
    ): array {
        $numbers = $this->numberRepo->getAll($offset, $countryCode);
        if (!is_null($validStatus)) {
            foreach ($numbers as $key => $number) {
                if ($validStatus == true && !$number->isValid()) {
                    unset($numbers[$key]);
                } elseif ($validStatus == false && $number->isValid()) {
                    unset($numbers[$key]);
                }
            }
        }
        return [array_slice($numbers, 0, $limit), count($numbers) + $offset];
    }
}
