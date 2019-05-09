@extends('layouts.base')
@section('content')

<h1>Pažymiai</h1>

@if ($errors->any())

<div class="uk-alert uk-alert-danger" uk-alert>
<a class="uk-alert-close" uk-close></a>

<ul class="uk-list">
@foreach ($errors->all() as $error)
	<li>{{ $error }}</li>
@endforeach
</ul>
</div>

@endif

<form class="uk-grid uk-form-stacked" uk-grid method="POST" action="{{ route('grades.update',  $grade->id) }}">

@method('PATCH')
@csrf

<fieldset class="uk-fieldset">
<legend class="uk-legend">Koreguoti</legend>


<div class="uk-margin">

<label class="uk-form-label" for="lecture_id">Paskaita</label>

<select class="uk-select uk-form-width-large" id="lecture_id" name="lecture_id">

@foreach ($lecturesList as $item)

@if ($item->id == $grade->lecture_id)
	<option value="{{ $item->id }}" SELECTED>{{ $item->name }}</option>
@else 
	<option value="{{ $item->id }}">{{ $item->name }}</option>
@endif

@endforeach

</select>

</div>



<div class="uk-margin">
<label class="uk-form-label" for="student_id">Studentai</label>

<select class="uk-select uk-form-width-large" id="student_id" name="student_id">


@foreach ($studentsList as $item)

@if ($item->id == $grade->student_id)
	<option value="{{ $item->id }}" SELECTED>{{ $item->name }}</option>
@else
	<option value="{{ $item->id }}">{{ $item->name }}</option>
@endif

@endforeach

</select>

</div>



<div class="uk-margin">

<label class="uk-form-label" for="grade">Pažymys</label>

<input type="text" id="grade" class="uk-input uk-form-width-large"  name="grade" value="{{ $grade->grade }}" />

</div>





<div class="uk-margin">
<button type="submit" class="uk-button uk-button-primary">Atnaujinti</button>&nbsp;
<a href="{{ route('grades.index') }}" class="uk-button uk-button-default">Atšaukti</a>
</div>

</fieldset>
</form>

@endsection

@section('footer')

@endsection