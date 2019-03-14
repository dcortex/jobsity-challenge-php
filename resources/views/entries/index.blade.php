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
                    <div class="table-container">
                        <div class="table-container__head">
                            <div>#</div>
                            <div>Title</div>
                            <div>Last Updated Date</div>
                            <div>Creation Date</div>
                            <div>Action</div>
                        </div>
                        <div class="table-container__content">
                            @foreach($entries as $entry)
                                <div class="table-container__content__row">
                                    <div>{{$entry->id}}</div>
                                    <div>{{$entry->title}}</div>
                                    <div>{{$entry->updated_at->toDayDateTimeString()}}</div>
                                    <div>{{$entry->created_at->toFormattedDateString()}}</div>
                                    <div>
                                        <a href="{{ route('entries.show',$entry->id) }}" class="btn btn-primary">View</a>
                                        <a href="{{ route('entries.edit',$entry->id) }}" class="btn btn-secondary">Edit</a>
                                        <form action="{{ route('entries.destroy', $entry->id) }}" method="post" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger" type="submit" onclick="return confirm('Are you sure?');">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
