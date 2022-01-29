<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class ConvertString extends Command
{
    protected $signature = 'new:convert-string';

    protected $description = 'String Converter';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $string = $this->ask('Enter String');

        $this->info($this->convertToUpperCase($string));

        $this->info($this->convertToAlternateCase($string));

        if($this->createCSV($string))
        {
            $this->info('CSV created!');
        }

    }

    private function convertToUpperCase($string)
    {
        return strtoupper($string);
    }

    private function convertToAlternateCase($string)
    {
        $new_string = '';

        foreach(str_split($string) as $i => $char)
        {
            $new_string .= $i % 2 == 0 ? strtolower($char) : strtoupper($char);
        }

        return $new_string;
    }

    private function createCSV($string)
    {
        $csv_string = join(str_split($string), ',');

        Storage::put('new.csv', $csv_string);

        return true;
    }
}
