<?php

use Illuminate\Database\Seeder;

class DictionarySeeder extends Seeder
{

    public function seedLevel($level)
    {
        $filePath = '/var/www/html/dt/_import/';
        $fileName = $filePath.$level.'.csv';

        $data = file($fileName);

        $dbLevel = \App\Level::where('name', $level)->first();
        if (is_null($dbLevel)) {
            $dbLevel = new \App\Level([
                'name' => $level
            ]);
            $dbLevel->save();
        }

        foreach($data as $row) {
            $row = str_replace(["\r","\n"],'', $row);
            $row =  mb_convert_encoding($row, "utf-8", "windows-1251");
            $rowData = explode(';', $row);

            $dbOxfordWord = new \App\OxfordWord([
                'en' => $rowData[0],
                'ru1' => $rowData[2],
                'ru2' => $rowData[3],
                'level_id' => $dbLevel->id,
            ]);
            $dbOxfordWord->save();

            //dump($rowData);

        }



    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->seedLevel('A1');
    }
}
