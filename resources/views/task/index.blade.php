@extends('layouts.app')


@section('content')
    @can('seeNoteAssigned', \App\Models\Task::class)
        <nav class="nav nav-pills flex-column flex-sm-row m-3">
            <a class="flex-sm-fill text-sm-center nav-link {{request()->input('status') != 'not-assigned' ? 'active' :''}} "
               href="{{route('tasks.index', ['status' => 'assign'])}}">Assign Task</a>
            <a class="flex-sm-fill text-sm-center nav-link {{request()->input('status') == 'not-assigned' ? 'active' :''}}"
               href="{{route('tasks.index', ['status' => 'not-assigned'])}}">Not Assigned Tasks</a>
        </nav>
    @endcan
    @if ($data->total())
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Deadline</th>
                <th>Developers</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($data as $item)
                <tr>
                    <td>{{$item->title}}</td>
                    <td>{{\Str::limit($item->description, 100, ' (...)')}}</td>
                    <td>{{$item->deadline}}</td>
                    <td>
                        @forelse($item->developers as $developer)
                            <span class="badge badge-warning">{{$developer->name}}</span>
                        @empty
                            <p>No users</p>
                        @endforelse
                    </td>
                    <td>
                        <button type="button" class="btn btn-info task-edit-add" data-toggle="modal" data-target=".task-edit-add-modal" data-url="{{route('tasks.view', $item)}}" >
                            View
                        </button>
                        @can('edit', $item)
                            <button type="button" class="btn btn-primary task-edit-add" data-url="{{route('tasks.edit', $item)}}" data-toggle="modal" data-target=".task-edit-add-modal">
                                Edit
                            </button>
                        @endcan
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    @else
        <p>No users</p>
    @endif

    {{$data->links()}}


@stop
