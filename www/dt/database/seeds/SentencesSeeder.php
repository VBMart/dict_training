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
            $file->save();

            $filePath = '/var/www/html/dt/_import/';
            $xmlFile = new DOMDocument('1.0', 'utf-8');
            $xmlFile->load($filePath . $fileName);

            $tus = $xmlFile->getElementsByTagName('tu');
            $i = 0;
            foreach ($tus as $tu) {
                $sentence = [];
                foreach ($tu->childNodes as $child){
                    if ($child->nodeName == 'tuv'){
                        foreach ($child->attributes as $attribute) {
                            if ($attribute->name == 'lang') {
                                if ($attribute->value == 'en') {
                                    $sentence['en'] = $child->nodeValue;
                                } elseif ($attribute->value == 'ru') {
                                    $sentence['ru'] = $child->nodeValue;
                                }

                            }

                        };
                    }
                }
                //dump($sentence);

                // if ru AND en
                preg_match_all('/[a-zA-Z-]{2,}/s', $sentence['en'], $allWords, PREG_PATTERN_ORDER);

                $words = [];
                for ($j = 0; $j < count($allWords[0]); $j++) {
                    if ($allWords[0][$j] != strtoupper($allWords[0][$j])) {
                        $wordLow = strtolower($allWords[0][$j]);
                        if (! in_array($wordLow, $words)) {
                            array_push($words, $wordLow);
                        }

                    }
                }

                //dump($words);

                if (count($words) > 2) {
                    //dump('Insert ' . $sentence['en']);
                    $dbSentence = new \App\Sentence([
                        'en' => $sentence['en'],
                        'ru' => $sentence['ru'],
                        'file_id' => $file->id,
                        'count_words' => count($words),
                        'count_symbols' => strlen($sentence['en'])
                    ]);
                    $dbSentence->save();

                    foreach ($words as $word) {
                        $dbWord = \App\Word::where('word', $word)->first();
                        if (is_null($dbWord)) {
                            $dbWord = new \App\Word([
                                'word' => $word
                            ]);
                            $dbWord->save();
                        }

                        $dbSentence->words()->attach($dbWord->id);
                    }


                } else {
                    dump('>> MISSED SENTENCE: ');
                    dump($sentence);
                }

                //for ($i = 0; $i < count($allWords[0]); $i++) {
                //    if ($allWords[0][$i] )
                //}

                // count allWords (except num), count symbols
                // add allWords +except CAPS+
                // link w_id with s_id

                $i++;
//                if ($i >= 50){
//                    break;
//                }
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
        $allFiles = ['en-ru Books.tmx', 'en-ru TildeMODEL.tmx'];
        foreach($allFiles as $fileName)
        {
            $this->seedFile($fileName);
        }
    }
}
