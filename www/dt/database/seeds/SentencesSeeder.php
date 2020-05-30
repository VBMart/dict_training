<?php

use Illuminate\Database\Seeder;

class SentencesSeeder extends Seeder
{

    public function seedFile($fileName)
    {
        $fCount = \App\File::where('file_name', $fileName)->count();

        if($fCount == 0) {
            $file = new \App\File([
                'file_name' => $fileName,
                'using' => 1
            ]);
            //$file->save();

            $filePath = '/var/www/html/dt/_import/';
            $xmlFile = new DOMDocument('1.0', 'utf-8');
            $xmlFile->load($filePath . $fileName);

            $tus = $xmlFile->getElementsByTagName('tu');
            $i = 0;
            foreach ($tus as $tu) {
                dump($tu);
                foreach ($tu->childNodes as $child){
                    dump('[');
                    if ($child->nodeName == 'tuv'){
                        foreach ($child->attributes as $attribute) {
                            dump($attribute->name . '->' . $attribute->value);
                        };
                    }

                    dump($child->nodeName);
                    dump($child->nodeValue);
                    dump(']');
                }
                dump('-');
                $i++;
                if ($i >= 1){
                    break;
                }
            }
        }

    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $allFiles = ['en-ru Books.tmx'];
        foreach($allFiles as $fileName)
        {
            $this->seedFile($fileName);
        }
    }
}
