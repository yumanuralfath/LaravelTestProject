<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Todo::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $todo = Todo::create($request->validate([
            'title' => 'required|string|max:255'
        ]));

        return response()->json($todo, 201);
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Todo $todo)
    {
        $todo ->update($request->validate([
            'title'=> 'string|max:255',
            'completed'=>'boolean'
        ]));
        
        return response()->json($todo, 200);
    } 
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Todo $todo)
    {
        $todo->delete();
        return response()->json(null, 204);
    }
    
    /**
     * BLADE: Show HTML UI
     */
    public function showTodos()
    {
        $todos = Todo::latest()->get();
        return view('todos.index', compact('todos'));
    }

        // BLADE: Submit from HTML form
    public function createFromBlade(Request $request)
    {
        Todo::create($request->validate([
            'title' => 'required|string|max:255',
        ]));

        return redirect()->back();
    }

    public function toggle(Todo $todo)
    {
        $todo->completed = !$todo->completed;
        $todo->save();
        return redirect()->back();
    }

    public function deleteBlade(Todo $todo)
    {
        $todo->delete();
        return redirect()->back();
    }
}
