<?php

namespace App\Http\Controllers;

use App\Models\Objective;
use Illuminate\Http\Request;

class SmOjectiveController extends Controller
{
    public function destroy($id)
    {
        // Find the objective by ID
        $objective = Objective::find($id);

        // Delete the objective
        $objective->delete();

        // Return a response indicating success
        return response()->json(['message' => 'Objective deleted successfully'], 200);
    }
}
