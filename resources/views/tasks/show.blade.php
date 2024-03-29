@extends('layouts.app')

@section('content')

        <h1>id = {{ $task->id }} のタスク詳細</h1>

        <table class="table table-bordered">
            <tr>
                <th>id</th>
                <td>{{ $task->id }}</td>
            </tr>
        
             <tr>
                <th>ステータス</th>
                <td>{{ $task->status }}</td>
             </tr>
        
             <tr>
                 
             <th>タスク</th>
                 <td>{{ $task->content }}</td>
             </tr>
        </table>
        
         {!! link_to_route('tasks.edit' ,'タスク編集',['id' => $task->id], ['class' => 'btn btn-light'])!!}
    
          {!! Form::open(['route'=>['tasks.destroy',$task->id],'method'=>'delete']) !!}
            {!! Form::submit('完了',['class' => 'btn btn-danger']) !!}
          {!! Form::close() !!}
    
    

@endsection