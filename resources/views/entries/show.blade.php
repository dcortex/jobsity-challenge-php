@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Showing Entry {{ $entry->title }}</div>
                <div class="card-body">

                    <dl class="row">
                        <dt class="col-sm-4 text-md-right">{{ __('Title') }}</dt>
                        <dd class="col-sm-8">{{ $entry->title }}</dd>

                        <dt class="col-sm-4 text-md-right">{{ __('Content') }}</dt>
                        <dd class="col-sm-8">{{ $entry->content }}</dd>
                        
                        <dt class="col-sm-4 text-md-right">{{ __('Last Updated Date') }}</dt>
                        <dd class="col-sm-8">{{ $entry->updated_at->toDayDateTimeString() }}</dd>

                        <dt class="col-sm-4 text-md-right">{{ __('Creation Date') }}</dt>
                        <dd class="col-sm-8">{{ $entry->created_at->toFormattedDateString() }}</dd>
                    </dl>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
