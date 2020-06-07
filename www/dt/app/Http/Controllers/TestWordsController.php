<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Word;
use App\Sentence;

class TestWordsController extends Controller
{
    public function randomTest() {
        $word = Word::inRandomOrder()->first();
        $sentence = $word->sentences()->inRandomOrder()->first();

        return view('test_word', [
            'success' => null,
            'userWord' => null,
            'word' => $word,
            'sentence' => $sentence,
        ]);
    }

    public function checkRandomTest(Request $request) {
        // TODO Add validation

        $wId = $request->get('word_id');
        $sId = $request->get('sentence_id');
        $userWord = $request->get('word');

        $word = Word::findOrFail($wId);
        $sentence = Sentence::findOrFail($sId);

        return view('test_word', [
            'success' => $userWord == $word->word,
            'userWord' => $userWord,
            'word' => $word,
            'sentence' => $sentence,
        ]);
    }
}
