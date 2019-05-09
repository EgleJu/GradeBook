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

<form class="uk-grid uk-form-stacked" uk-grid method="POST" action="{{ route('students.store') }}">

@csrf

<fieldset class="uk-fieldset uk-width-1-1@s uk-width-1-2@m">
<legend class="uk-legend">Create</legend>

<div class="uk-margin">

<label class="uk-form-label" for="name">Vardas</label>

<input type="text" id="name" class="uk-input" name="name"/>

</div>


<div class="uk-margin">

<label class="uk-form-label" for="surname">Pavardė</label>

<input type="text" id="surname" class="uk-input" name="surname"/>

</div>


<div class="uk-margin">

<label class="uk-form-label" for="email">El. paštas</label>

<input type="text" id="email" class="uk-input" name="email"/>

</div>


<div class="uk-margin">

<label class="uk-form-label" for="phone">Telefonas</label>

<input type="text" id="phone" class="uk-input" name="phone"/>

</div>



<div class="uk-margin">

<button type="submit" class="uk-button uk-button-primary">Pridėti</button>&nbsp;

<a href="{{ route('students.index') }}" class="uk-button uk-button-default">Atšaukti</a>

</div>

</fieldset>
</form>

@endsection