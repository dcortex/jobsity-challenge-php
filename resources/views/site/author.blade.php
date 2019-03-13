@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Author <b>{{ $user->name }}</b></h1>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            @foreach ($entries as $entry)            
                <div class="card entry">
                    @if (Auth::check() && Auth::id()===$entry->user->id)
                        <div class="card-header entry__options">
                            <a class="btn btn-secondary float-right btn-sm" href="{{ route('entries.edit', $entry->id) }}">{{ __('Edit Entry') }}</a>
                        </div>
                    @endif
                    <div class="card-body entry__body">
                        <h5 class="card-title entry__title">{{ $entry->title }}</h5>
                        <p class="card-text entry__content">{{ $entry->content }}</p>
                        <p class="card-text entry__footer">
                            <small class="text-muted">{{ $entry->updated_at->toDayDateTimeString() }}</small>
                        </p>
                    </div>
                </div>
            @endforeach
            {{ $entries->links() }}
        </div>
        <div class="col-md-4">
            <!-- Vue Twitter Widget -->
            <input type="hidden" value="{{ $user->id }}" id="current_user_id"/>
            <twitter-feed-component/>
        </div>
    </div>
</div>
@endsection



