@extends('layouts.app')

@section('content')
<div class="container">
@foreach ($questions as $question)
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ $question->text }}</div>
                @foreach ($answers as $answer)
                <div class="panel-body">
                    <input type="radio" value="{{ $answer->text }}" />
                </div>
                @endforeach
            </div>
          </div>
      </div>
@endforeach
</div>
@endsection
