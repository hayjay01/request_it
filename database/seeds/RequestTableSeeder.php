<?php

use Illuminate\Database\Seeder;

class RequestTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $requests = new \App\Requests([
        	'request_title' => 'I neeed something',
        	'request_type' => 'Others',
        	'body' => 'Mobile team need something please kindly provide before tomorow thanks'
        ]);
        $requests->save();
    }
}
