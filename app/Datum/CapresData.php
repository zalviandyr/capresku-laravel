<?php

namespace App\Datum;

use App\Enums\CapresPosition;
use Carbon\Carbon;

class CapresData
{
    /**
     * @param \App\Datum\
     */
    public function __construct(
        public int $number,
        public string $fullName,
        public string $rawBirthDatePlace,
        public CapresPosition $position,
        public string $birthPlace,
        public Carbon $birthDate,
        public int $age,
        public array $careers,
    ) {}

    /**
     * @return \App\Datum\CapresData[];
     */
    public static function from(array $json): array
    {
        $count = count($json['calon_presiden']);
        $datum = [];

        for ($i=0; $i < $count; $i++) {
            $president = $json['calon_presiden'][$i];
            $vicePresident = $json['calon_wakil_presiden'][$i];

            // president
            $datum[] = new CapresData(
                $president['nomor_urut'],
                $president['nama_lengkap'],
                $president['tempat_tanggal_lahir'],
                CapresPosition::PRESIDENT,
                self::parseBirthPlace($president['tempat_tanggal_lahir']),
                self::parseBirthDate($president['tempat_tanggal_lahir']),
                self::calculateAge($president['tempat_tanggal_lahir']),
                $president['karir']
            );

            // vice president
            $datum[] = new CapresData(
                $vicePresident['nomor_urut'],
                $vicePresident['nama_lengkap'],
                $vicePresident['tempat_tanggal_lahir'],
                CapresPosition::WAKIL_PRESIDENT,
                self::parseBirthPlace($vicePresident['tempat_tanggal_lahir']),
                self::parseBirthDate($vicePresident['tempat_tanggal_lahir']),
                self::calculateAge($vicePresident['tempat_tanggal_lahir']),
                $vicePresident['karir']
            );
        }

        return $datum;
    }

    public static function parseBirthPlace(string $value): string
    {
        return explode(',', $value)[0];
    }

    public static function parseBirthDate(string $value): Carbon
    {
        $months = [
            "Januari" => "January",
            "Februari" => "February",
            "Maret" => "March",
            "April" => "April",
            "Mei" => "May",
            "Juni" => "June",
            "Juli" => "July",
            "Agustus" => "August",
            "September" => "September",
            "Oktober" => "October",
            "November" => "November",
            "Desember" => "December"
        ];


        $stringDate = trim(explode(',', $value)[1]);
        $arrDate = explode(' ', $stringDate);
        $month = $arrDate[1];
        $stringDate = $arrDate[0] . ' ' . $months[$month] . ' ' . $arrDate[2];
        return Carbon::createFromFormat('d F Y', $stringDate);
    }

    public static function calculateAge(string $value): int
    {
        $birthDate = self::parseBirthDate($value);
        $birthDate = $birthDate->year;

        $now = Carbon::now()->year;

        return $now - $birthDate;
    }
}
