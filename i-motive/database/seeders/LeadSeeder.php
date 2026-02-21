<?php

namespace Database\Seeders;

use App\Models\Lead;
use GuzzleHttp\Promise\Create;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LeadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //creates 25 randomized records in the leads table
        Lead::factory()->count(25)->create();
    }
}
