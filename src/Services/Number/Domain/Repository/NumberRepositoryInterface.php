<?php

namespace App\Services\Number\Domain\Repository;

interface NumberRepositoryInterface
{

    public function getAll(?int $offset = null, ?int $countryCode = null): array;
}
