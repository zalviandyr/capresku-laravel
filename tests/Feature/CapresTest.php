<?php

namespace Tests\Feature;

use App\Datum\CapresData;
use App\Services\CapresService;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CapresTest extends TestCase
{
    public function test_get_capres(): void
    {
        $service = new CapresService();
        $capres = $service->getCapres();

        $this->assertEquals(count($capres), 6);
    }

    public function test_parse_date(): void
    {
        $date = CapresData::parseBirthDate('Kuningan, 7 Mei 1969');
        $carbonDate = Carbon::parse('1969-05-07');

        $this->assertEquals($date->toDateString(), $carbonDate->toDateString());
    }

    public function test_calculate_age(): void
    {
        $age = CapresData::calculateAge('Kuningan, 7 Mei 1969');
        $actualAge = 55;

        $this->assertEquals($age, $actualAge);

    }
}
