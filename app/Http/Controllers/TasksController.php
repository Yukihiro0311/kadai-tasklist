<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Task;

class TasksController extends Controller
{
    
    public function index()
    {
        $data = [];
        if (\Auth::check()) {
            $user = \Auth::user();
            
            $tasks = $user->tasks()->get();
            
            $data = [
                'user' => $user,
                'tasks' => $tasks,
            ];
        }
        
        return view('welcome', $data);
    }

    public function create()
    {
        $task = new Task;
        
        return view('tasks.create',[
            'task'=>$task,
            ]);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'status' => 'required|max:10',
            'content' => 'required|max:191',
            ]);
    
        $request->user()->tasks()->create([
            'content' => $request->content,
            'status' => $request->status,
        ]);
        
        return redirect('/');
    }

    public function show($id)
    {
        $task = Task::find($id);
        
        if(\Auth::id() === $task->user_id){
        
        return view('tasks.show', [
            'task' => $task,
            ]);        
        }
    
    return redirect('/');
    
    }

    public function edit($id)
    {
        $task = Task::find($id);
        
        if(\Auth::id() === $task->user_id){

        return view('tasks.edit',[
            'task' => $task,
             ]);
    }
    
    return redirect('/');
    
}

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'status' => 'required|max:10',
            'content' => 'required|max:191',
            ]);
            
        $task = \App\Task::find($id);
            
        if(\Auth::id() === $task->user_id){
            $task = Task::find($id);
            $task->status = $request->status;
            $task->content = $request->content;
            $task->save();
        }
        
        return redirect('/');
    }

    public function destroy($id)
    {
        $task = \App\Task::find($id);
        
        if(\Auth::id() === $task->user_id){
          $task->delete();
        }
        
        return redirect('/');
    }
}
