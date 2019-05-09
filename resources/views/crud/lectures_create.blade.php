@extends('layouts.base')
@section('content')

<h1>{{__('Paskaitos')}}</h1>

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

<form class="uk-grid uk-form-stacked" uk-grid method="POST" action="{{ route('lectures.store') }}">

@csrf

<fieldset class="uk-fieldset uk-width-1-1@s uk-width-1-2@m">
<legend class="uk-legend">{{__('Sukurti')}}</legend>

<div class="uk-margin">

<label class="uk-form-label" for="name">{{__('Pavadinimas')}}</label>

<input type="text" id="name" class="uk-input" name="name"/>

</div>


<div class="uk-margin">

<label class="uk-form-label" for="description">{{__('Aprašymas')}}</label>

<input type="text" id="description" class="uk-input" name="description"/>

</div>


<div class="uk-margin">

<button type="submit" class="uk-button uk-button-primary">{{__('Pridėti')}}</button>&nbsp;

<a href="{{ route('lectures.index') }}" class="uk-button uk-button-default">{{__('Atšaukti')}}</a>

</div>

</fieldset>
</form>

@endsection