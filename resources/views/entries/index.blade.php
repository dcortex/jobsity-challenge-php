@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if(session()->get('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }} 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button> 
                </div><br />
            @endif
            @if(session()->get('warnings'))
                <div class="alert alert-danger">
                    {{ session()->get('warnings') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button> 
                </div><br />
            @endif
            <div class="card">
                <div class="card-header">{{ __('Entries List') }} <a class="btn btn-secondary float-right btn-sm" href="{{ route('entries.create') }}">{{ __('Create New Entry') }}</a></div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Title</th>
                                <th scope="col">Last Updated Date</th>
                                <th scope="col">Creation Date</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($entries as $entry)
                            <tr>
                                <td scope="row">{{$entry->id}}</td>
                                <td>{{$entry->title}}</td>
                                <td>{{$entry->updated_at->toDayDateTimeString()}}</td>
                                <td>{{$entry->created_at->toFormattedDateString()}}</td>
                                <td>
                                    <a href="{{ route('entries.show',$entry->id) }}" class="btn btn-primary">View</a>
                                    <a href="{{ route('entries.edit',$entry->id) }}" class="btn btn-secondary">Edit</a>
                                    <form action="{{ route('entries.destroy', $entry->id) }}" method="post" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" type="submit">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
