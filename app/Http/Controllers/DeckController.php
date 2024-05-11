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

            // Assuming you have a relationship set up in the UserDecks model
            $questions = $deck->questions;

            return response()->json(['deckQuestions' => $questions]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while fetching questions'], 500);
        }
    }



    public function deckDelete($id)
    {
        $user_id = auth()->user()->id;
        $deck = UserDecks::where('user_id', $user_id)->find($id);
        $deletedRows = UserDecks::where('user_id', $user_id)
            ->where('user_deck_id', $id)
            ->delete();

        return response()->json(['message' => 'Deck deleted successfully']);
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
        // Validate request data
        $request->validate([
            'front' => 'required|max:150',
            'back' => 'required|max:150',
        ]);

        // Get the authenticated user's ID
        $user_id = auth()->user()->id;

        // Get the user_deck_id
        $user_deck_id = $id;

        // Prepare data for the new DeckQuestion
        $data['user_deck_id'] = $user_deck_id;
        $data['front'] = $request->input('front');
        $data['back'] = $request->input('back');

        // Create and save the new DeckQuestion
        $question = DeckQuestion::create($data);

        // Return a JSON response indicating success
        return response()->json(['success' => 'Question added successfully']);
    }





}
