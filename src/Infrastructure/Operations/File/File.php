<?php

namespace App\Infrastructure\Operations\File;

use App\Application\Settings\SettingsInterface;


class File
{
    private const PATH = 'https://docs.google.com/spreadsheets/d/%s/export?format=csv&gid=%s';

    private SettingsInterface $settings;

    public function __construct(SettingsInterface $settings)
    {
        $this->settings = $settings;
    }

    public function loadData(): string
    {
        $fileSettings = $this->settings->get('import')['file'];
        $csvUrl = sprintf(self::PATH, $fileSettings['f_gid'], $fileSettings['gid']);
        $file = fopen($csvUrl, 'r');
        $data = stream_get_contents($file);
        fclose($file);

        return $data;
    }

    public function getCsvData(): array
    {
        $csv = $this->loadData();
        $csv = explode("\r\n", $csv);
        $array = array_map('str_getcsv', $csv);

        array_walk($array, function (&$a) use ($array) {
            $a = array_combine($array[0], $a);
        });
        array_shift($array); # remove column header

        return $array;

    }
}