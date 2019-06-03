<div class="card">
    <div class="card-header text-center">{{$task->title}}</div>
    <div class="card-body">
        <h5 class="card-title">Description</h5>
        <P class="card-text">
            {{$task->description}}
        </P>
        <hr>
        <h5 class="card-title">Deadline</h5>
        <P class="card-text">
            {{$task->deadline}}
        </P>
        <hr>
        <h5 class="card-title">Developers</h5>
        @forelse($task->developers as $developer)
            <span class="badge badge-warning">{{$developer->name}}</span>
        @empty
            <p>No users</p>
        @endforelse
        <hr>
        <h5 class="card-title">Status</h5>
        @can('changeStatus', \App\Models\Task::class)
            <form action="{{route('tasks.change_status', $task)}}" method="POST" class="change-status">
                @csrf
                <select name="status" class="form-control">
                    @foreach (config('task.status') as $key => $status)
                        <option value="{{$key}}" {{$key == $task->status ? 'selected' : ''}}>{{$status}}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-primary m-2">Save</button>
            </form>
        @else
            <P class="card-text">
                {{$task->status}}
            </P>
        @endcan
    </div>
</div>
