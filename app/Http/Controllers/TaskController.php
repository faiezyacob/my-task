<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $i = 0;
        $tasks = Task::where('user_id', \Auth::user()->id)->get();

        foreach ($tasks as $task)
        {
            if ($task->related !=  null) {
                $titles = Task::where('id', $task->related)->get();
                foreach ($titles as $title)
                {
                    $temp = $title->title;
                    $tasks[$i]["temp"] = $temp;
                }
            }
            $i++;
        }
        return $tasks;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $obj = $request->related;
        $id = $obj['id'];

        $task = new Task();
        $task->title = ucfirst($request->title);
        $task->description = ucfirst($request->description);
        $task->due = $request->due;
        $task->related = $id;
        $task->user_id = auth()->id();
        $task->save();

        return $task;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);
        $task->title = $request->title;
        $task->description = $request->description;
        $task->due = $request->due;
        $task->related = $request->related;
        $task->save();

        return $task;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
    }

    public function showForm()
    {
        return view ('create');
    }

    public function editForm()
    {
        return view ('edit');
    }

    public function related() 
    {
        $task = Task::select('id', 'title')->get();
        return $task;
    }
}
