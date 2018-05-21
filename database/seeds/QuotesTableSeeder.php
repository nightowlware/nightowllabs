<?php

use Illuminate\Database\Seeder;

class QuotesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (file('public/cgi/quotes.txt') as $line) {
            list($quote, $author) = explode('~', $line);

//            echo $quote . PHP_EOL;
//            echo $author . PHP_EOL;

            DB::table('quotes')->insert([
                'quote' => trim($quote),
                'author' => trim($author),
            ]);
        }
    }
}
