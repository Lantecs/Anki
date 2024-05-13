<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\DeckQuestion;
use App\Models\UserDecks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DeckController extends Controller
{
    
    public function getUserDecks()
    {
        $user_id = auth()->user()->id;
        $userDecks = DB::table('user_deck')
            ->where('user_id', $user_id)
            ->whereDate('created_at', '=', date('Y-m-d'))
            ->get();

        return response()->json(['userDecks' => $userDecks]);
    }

    public function getUserQuestions($id)
    {
        try {
            $user_id = auth()->user()->id;
            $deck = UserDecks::where('user_id', $user_id)->find($id);

            if (!$deck) {
                return response()->json(['error' => 'Deck not found'], 404);
            }

            $questions = $deck->questions;

            return response()->json(['deckQuestions' => $questions]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while fetching questions'], 500);
        }
    }

    public function questionDelete($id)
    {
        $user_id = auth()->user()->id;
        // Assuming $id is the ID of the question to be deleted
        $deleted = DB::table('deck_questions')
            ->where('user_id', $user_id)
            ->where('id', $id)
            ->delete();

        if ($deleted) {
            return response()->json(['message' => 'Question deleted successfully']);
        } else {
            return response()->json(['message' => 'Failed to delete question'], 500);
        }
    }

    public function deckEdit(string $id)
    {
        $user_id = auth()->user()->id;

        $deck = UserDecks::where('user_id', $user_id)->find($id);

        if (!$deck) {
            return response()->json(['error' => 'Deck not found'], 404);
        }

        return response()->json(['deck' => $deck]);
    }

    public function addDeck(Request $request)
    {
        $request->validate([
            'name' => 'required|max:50', // Update min length if necessary
            'description' => 'required|max:150',
        ]);

        $user_id = auth()->user()->id;

        $data['user_id'] = $user_id;
        $data['name'] = $request->input('name');
        $data['description'] = $request->input('description');

        $deck = UserDecks::create($data);

        return response()->json(['success' => 'Deck added successfully']);
    }

    public function saveQuestion(Request $request, $id)
    {

        $request->validate([
            'front' => 'required|max:150',
            'back' => 'required|max:150',
        ]);

        $user_id = auth()->user()->id;

        $user_deck_id = $id;

        $data['user_deck_id'] = $user_deck_id;
        $data['front'] = $request->input('front');
        $data['back'] = $request->input('back');

        $question = DeckQuestion::create($data);

        return response()->json(['success' => 'Question added successfully']);
    }

    public function deckDelete($id)
    {
        $user_id = auth()->user()->id;

        $deletedRows = UserDecks::where('user_id', $user_id)
            ->where('user_deck_id', $id)
            ->delete();

        // Optionally, you can return a response to indicate success or failure
        return response()->json(['message' => 'Deck deleted successfully']);
    }

}
