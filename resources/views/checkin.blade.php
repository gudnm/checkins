@extends('layouts.app')

@section('content')
<div class="container">
  <form method="POST" action="/">
    {{ csrf_field() }}

    @foreach ($questionnaire as $qa_set)

      <h2>{{ $qa_set['question']->text }}</h2>

      @foreach ($qa_set['answers'] as $answer)
        <input type="radio"
          name="{{ $qa_set['question']->text }}"
          value="{{ $qa_set['question']->id }}-{{ $answer->rating }}" />
        <label for="{{ $qa_set['question']->id }}-{{ $answer->rating }}">
          {{ $answer->text }}
        </label>
      @endforeach

    @endforeach

    <input type="submit" value="Submit" />

  </form>
</div>
@endsection
