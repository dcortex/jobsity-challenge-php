@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @foreach ($entries as $entry)            
                <div class="card">
                    <div class="card-header">{{ $entry->title }}</div>

                    <div class="card-body">
                        {{ $entry->content }}
                    </div>
                </div>
            @endforeach

            {{ $entries->links() }}
        </div>
    </div>
</div>
@endsection
