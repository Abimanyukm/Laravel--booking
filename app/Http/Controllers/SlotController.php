<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Slot;

class SlotController extends Controller
{
    public function slots()
    {
        $slots = Slot::all();
        return response()->json($slots, 200);
        
    }



    public function bookSlot(Request $request, $id)
{
    // Validate the request data as needed
    $request->validate([
        'status' => 'required|in:already booked',
    ]);

    try {
        // Find the slot by ID
        $slot = Slot::findOrFail($id);

        // Check if the slot is currently 'available'
        if ($slot->status === 'available') {
            // Update the status to 'booked'
            $slot->update(['status' => $request->status]);

            // Return a success response
            return response()->json(['message' => 'Slot booked successfully'], 200);
        }
    } catch (\Exception $e) {
        // Handle any exceptions (e.g., slot not found)
        return response()->json(['message' => 'Error booking slot'], 500);
    }
}


}
