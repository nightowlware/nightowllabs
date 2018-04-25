<?php

use Illuminate\Database\Seeder;

class ZipcodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $t = DB::table('zipcodes');
        $this->command->info('Reading zipcode csv file - this can take a while, please wait!');
        $data = excelFileToArray(__DIR__ . '/zipcodes.csv');

        // remove column headings (first row)
        array_shift($data);

        $this->command->info('Creating zipcode records - this can take a while, please wait!');
        foreach ($data as $row) {
            $t->insert([
                'zip' => $row[0],
                'city' => $row[1],
                'state' => $row[2],
                'latitude' => $row[3],
                'longitude' => $row[4],
                'timezone_offset' => $row[5],
                'is_dst' => $row[6],
                'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
            ]);
        }
    }
}
