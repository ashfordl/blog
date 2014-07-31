<?php

class BantypesSeeder extends Seeder
{
    public function run()
    {
        $bantype = new Bantype();
        $bantype->name = "Spaming";
        $bantype->default_length = 3;
        $bantype->save();

        $bantype = new Bantype();
        $bantype->name = "Flaming";
        $bantype->default_length = 14;
        $bantype->save();

        $bantype = new Bantype();
        $bantype->name = "Permanent";
        $bantype->default_length = -1;
        $bantype->save();
    }
}