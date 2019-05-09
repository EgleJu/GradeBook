@extends('layouts.base')
@section('content')

<h1>Studentai</h1>

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


<form class="uk-grid uk-form-stacked" uk-grid method="POST" action="{{ route('students.update', $student->id) }}">

@method('PATCH')
@csrf

<fieldset class="uk-fieldset uk-width-1-1@s uk-width-1-2@m">
<legend class="uk-legend">{{__('Koreguoti')}}</legend>

<div class="uk-margin">

<label class="uk-form-label" for="name">{{__('Vardas')}}</label>
<input type="text" id="name" class="uk-input" name="name" value="{{ $student->name }}"/>

</div>


<div class="uk-margin">

<label class="uk-form-label" for="surname">{{__('Pavardė')}}</label>
<input type="text" id="surname" class="uk-input" name="surname" value="{{ $student->surname }}"/>

</div>


<div class="uk-margin">

<label class="uk-form-label" for="email">{{__('El. paštas')}}</label>
<input type="text" id="email" class="uk-input" name="email" value="{{ $student->email }}"/>

</div>


<div class="uk-margin">

<label class="uk-form-label" for="phone">{{__('Telefonas')}}</label>
<input type="text" id="phone" class="uk-input" name="phone" value="{{ $student->phone }}"/>

</div>



<div class="uk-margin">

<button type="submit" class="uk-button uk-button-primary">{{__('Atnaujinti')}}</button>&nbsp;

<a href="{{ route('students.index') }}" class="uk-button uk-button-default">{{__('Atšaukti')}}</a>

</div>

</fieldset>

</form>

@endsection