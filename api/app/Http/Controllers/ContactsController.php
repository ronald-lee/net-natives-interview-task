<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;
/**
 * ContactsController
 * Provides API calls for accessing and manipulating the contacts stored in the system
 * @author Ronald Lee <ronald@ronaldlee.co.uk>
 */
class ContactsController extends Controller
{
    /**
     * Get all the contact records
     */
    public function index()
    {
        $contacts = Contact::all();
        return response()->json($contacts);
    }

    /**
     * Get all the contact records that matches the specified query string (q)
     */
    public function search(Request $request)
    {
        // Compile the query statement
        $q = $request->input('q');
        $query = Contact::where('name', 'LIKE', "%$q%")
            ->orWhere('email', 'LIKE', "%$q%")
            ->orWhere('location', 'LIKE', "%$q%")
            ->orWhere('primary', 'LIKE', "%$q%")
            ->orderBy('name', 'asc');
        
        // Generate the meta-data and then results set
        $count = $query->count();
        $total = Contact::count();
        $results = $query->get();

        // Return the results to the user
        return response()->json([
            'count' => $count,
            'total' => $total,
            'results' => $results,
        ]);
    }

    /**
     * Get details for a specific contact record
     */
    public function show($id)
    {
        $contact = Contact::findOrFail($id);
        return response()->json($contact);
    }

    /**
     * Save details for a new contact record
     */
    public function store(Request $request)
    {
        // Validate the inputs
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'location' => 'required',
            'primary' => 'required'
        ]);

        // Save the information in a new Contact
        $contact = new Contact();
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->location = $request->location;
        $contact->primary = $request->primary;
        $contact->save();

        // Return a success reponse and the new data
        return response()->json([
            'status' => 'success',
            'data' => $contact
        ]);
    }

    /**
     * Update details for a specified contact record
     */
    public function update(Request $request, $id)
    {
        // Validate the inputs
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'location' => 'required',
            'primary' => 'required'
        ]);

        // Find the specified contact and updates the information
        $contact= Contact::find($id);
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->location = $request->location;
        $contact->primary = $request->primary;
        $contact->save();

        // Return a success response and the new data
        return response()->json([
            'status' => 'success',
            'data' => $contact,
        ]);
    }

    /**
     * Removes the specified contact record from the system
     */
    public function destroy($id)
    {
        if (Contact::destroy($id)) {
            return response()->json(['status' => 'success']);
        }
    }
}
