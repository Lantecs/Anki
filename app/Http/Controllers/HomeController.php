<?php

namespace App\Http\Controllers;

use App\Models\DeckQuestion;

class HomeController extends Controller
{
    public function getUserDecksHome()
    {
        $user_id = auth()->user()->id;
        $userDecks = \App\Models\UserDecks::where('user_id', $user_id)
            ->whereDate('created_at', '=', now()->toDateString())
            ->withCount('questions')
            ->get();

        $userDecks = $userDecks->map(function ($deck) {
            $deck->pages = $deck->questions_count;

            return $deck;
        });

        return response()->json(['userDecks' => $userDecks]);
    }





    public function show($deckId)
    {
        // Fetch the questions data based on the $deckId
        $questions = DeckQuestion::where('user_deck_id', $deckId)->paginate(1);

        // Return the studyboard view with the fetched data
        return view('dashboard.studyboard', ['questions' => $questions]);
    }






}
