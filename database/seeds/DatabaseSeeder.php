<?php

use App\StatusCode;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->seedStatusCodes($this->fetchStatusCodes());
    }

    protected function fetchStatusCodes(): Collection
    {
        $statusCodeSource = 'https://raw.githubusercontent.com/for-GET/know-your-http-well/master/json/status-codes.json';
        $statusCodes = json_decode(file_get_contents($statusCodeSource));

        return collect($statusCodes ?? []);
    }

    protected function seedStatusCodes(Collection $statusCodes)
    {
        StatusCode::unguard();

        $statusCodes->filter(function($statusCode) {
            return is_numeric($statusCode->code);
        })->each(function($statusCode) {
            $statusCode->description = trim($statusCode->description, '"');

            StatusCode::firstOrCreate(
                ['code' => $statusCode->code],
                (array) $statusCode
            );
        });
    }
}
