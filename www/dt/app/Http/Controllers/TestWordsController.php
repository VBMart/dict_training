<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Word;
use App\Sentence;
use App\OxfordWord;
use App\Level;

class TestWordsController extends Controller
{
    public function randomTest(Request $request, Level $level) {
        $word = null;
        $oxfordWord = null;
        $i = 0;

        while (is_null($word)) {
            $oxfordWord = OxfordWord::where('level_id', $level->id)->inRandomOrder()->first();
            $word = Word::where('word', $oxfordWord->en)->first();
            $i ++;
            if ($i > 10) {
                dd('Too much iterations');
            }

            if (is_null($word)) {
                dump($oxfordWord->en." isn't in WORDS");
            }
        }

//        $word = Word::find(1)->first();
        $sentence = $word
            ->sentences()
            ->whereRaw('`sentences`.`count_symbols` between 10 and 150')
            ->inRandomOrder()
            ->first();

        // SQL: select `sentences`.*, `sentence_word`.`word_id` as `pivot_word_id`, `sentence_word`.`sentence_id` as `pivot_sentence_id` from `sentences` inner join `sentence_word` on `sentences`.`id` = `sentence_word`.`sentence_id` where `sentence_word`.`word_id` = 1 and `sentence_word`.`count_symbols` between 8 and 20

//        dump($word->word);
//        foreach ($sentence as $item) {
//            dump($item->id);
//            dump($item->en);
//        }
//
//        dd();

        return view('test_word', [
            'success' => null,
            'userWord' => null,
            'word' => $word,
            'oxfordWord' => $oxfordWord,
            'sentence' => $sentence,
            'level' => $level,
        ]);
    }

    public function checkRandomTest(Request $request, Level $level) {
        // TODO Add validation

        $wId = $request->get('word_id');
        $sId = $request->get('sentence_id');
        $userWord = strtolower($request->get('word'));

        $word = Word::findOrFail($wId);
        $sentence = Sentence::findOrFail($sId);

        return view('test_word', [
            'success' => $userWord == $word->word,
            'userWord' => $userWord,
            'word' => $word,
            'sentence' => $sentence,
            'level' => $level,
        ]);
    }

    public function selectLevel(Request $request) {
        $levels = Level::all();
        return view('select_level',[
            'levels' => $levels,
        ]);
    }
}
