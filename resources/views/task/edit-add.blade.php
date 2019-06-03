<h2 class="text-center">{{$task->getKey() ? "Edit" : 'Create'}} Task</h2>

<form action="{{$task->getKey() ? route('tasks.update', $task) : route('tasks.store')}}" method="POST" class="edit-add-form">
    @if ($task->getKey())
        {{ method_field("PUT") }}
    @endif
    @csrf
    <div class="form-group">
        <label>Title</label>
        <input type="text" class="form-control" id="title" name="title"  value="{{$task->title}}" placeholder="Title">
    </div>
    <div class="form-group">
        <label >Deadline</label>
        <input type="text" class="form-control datepicker" id="deadline" name="deadline" value="{{$task->deadline}}"  placeholder="Deadline">
    </div>
    <div class="form-group">
        <label >Developers</label>
        <select data-multiple="true" class="form-control select2" id="developers" name="developers[]" data-url="{{route('tasks.get_developers')}}" data-placeholder="Developers">
            @foreach ($task->developers as $developer)
                <option value="{{$developer->id}}">{{$developer->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label>Description</label>
        <textarea class="form-control" id="description" name="description" rows="3" placeholder="Description">{{$task->description}}</textarea>
    </div>
    <button type="button" class="btn btn-primary mb-2 save-button">Save</button>
</form>
