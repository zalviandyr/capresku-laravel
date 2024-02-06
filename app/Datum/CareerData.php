<?php

namespace App\Datum;

class CareerData
{
    public function __construct(
        public string $description,
        public int $startYear,
        public ?int $endYear,
    ) {}
}
