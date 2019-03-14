@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Recent Entries</h1>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            @foreach ($entries as $entry)            
                <div class="card blog-entry">
                    @if (Auth::check() && Auth::id()===$entry->user->id)
                        <div class="card-header blog-entry__options">
                            <a class="btn btn-secondary float-right btn-sm" href="{{ route('entries.edit', $entry->id) }}">{{ __('Edit Entry') }}</a>
                        </div>
                    @endif
                    <div class="card-body blog-entry__body">
                        <h5 class="card-title blog-entry__body__title">{{ $entry->title }}</h5>
                        <p class="card-text blog-entry__body__content">{{ $entry->content }}</p>
                        <p class="card-text blog-entry__body__footer">
                            <small class="text-muted">{{ $entry->updated_at->toDayDateTimeString() }}</small>
                            <span class="text-muted float-right">Author: <a href="{{ route('site.author', ['id' => $entry->user->id]) }}" class="card-link">{{ $entry->user->name }}</a> </span>
                        </p>
                    </div>
                </div>
            @endforeach
            {{ $entries->links() }}
        </div>
    </div>
</div>
@endsection
