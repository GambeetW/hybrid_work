<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use Illuminate\Http\Request;

class MeetingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $visitors = $this->get_visitors();
        return view('visitors.show', compact('visitors'));
    }

    protected function get_visitors() {
        $id = auth()->user()->id;
        return Meeting::where('user_id', $id)->latest()->paginate(5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $status = 'add_new';
        return view('visitors.add_edit', compact('status'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'guest_name' => 'required',
            'guest_email' => 'required',
            'starts_at' => 'required',
            'ends_at' => 'required|after:starts_at'
        ]);

        $request->merge([
            'user_id' => auth()->user()->id
        ]);

        Meeting::create($request->all());
        return redirect()->route('visitor.index')->with('success','Visitor\'s added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $meeting = Meeting::findOrFail($id);
        $status = 'edit';
        return view('visitors.add_edit', compact('meeting', 'status'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Meeting $meeting)
    {
        $this->show($meeting);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $meeting = Meeting::findOrFail($id);

        $request->validate([
            'guest_name' => 'required',
            'guest_email' => 'required',
            'starts_at' => 'required',
            'ends_at' => 'required|after:starts_at'
        ]);

        $meeting->update($request->all());
        return redirect()->route('visitor.index')->with('success','Visitor\'s updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $meeting = Meeting::findOrFail($id);
        $meeting->delete();
        return redirect()->route('visitor.index')->with('success','Visitor deleted successfully');
    }
}
