@extends('layouts.base')
@section('content')

<h1>{{__('Pažymiai')}}</h1>

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

<form class="uk-grid uk-form-stacked" uk-grid method="POST" action="{{ route('grades.store') }}">
@csrf

<fieldset class="uk-fieldset uk-width-1-1@s uk-width-1-2@m">
<legend class="uk-legend">{{__('Sukurti')}}</legend>



<div class="uk-margin">

<label class="uk-form-label" for="lecture_id">{{__('Paskaita')}}</label>

<select class="uk-select uk-form-width-large" id="lecture_id" name="lecture_id">


@foreach ($lecturesList as $item)

<option value="{{ $item->id }}">{{ $item->name }}</option>

@endforeach

</select>

</div>




<div class="uk-margin">

<label class="uk-form-label" for="student_id">{{__('Studentas')}}</label>

<select class="uk-select uk-form-width-large" id="student_id" name="student_id">


@foreach ($studentsList as $item)

<option value="{{ $item->id }}">{{ $item->name }}</option>

@endforeach

</select>

</div>




<div class="uk-margin">

<label class="uk-form-label" for="grade">{{__('Pažymys')}}</label>

<input type="text" id="grade" class="uk-input uk-form-width-large" name="grade"/>

</div>

<div class="uk-margin">



<button type="submit" class="uk-button uk-button-primary">{{__('Pridėti')}}</button>&nbsp;

<a href="{{ route('grades.index') }}" class="uk-button uk-button-default">{{__('Atšaukti')}}</a>

</div>


</fieldset>
</form>

@endsection