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

@elseif (session()->get('success'))

<div class="uk-alert uk-alert-success" uk-alert>

<a class="uk-alert-close" uk-close></a>

{{ session()->get('success') }}  

</div>

 @endif

<div class="uk-margin-bottom">

<div class="uk-child-width-1-1@s uk-child-width-1-2@m uk-child-width-1-3@l" uk-grid="masonry: true" uk-sortable>
<div>
<form action="{{ route('grades.index') }}" method="get" id="student-filter-form">
{{--@method('PUT')--}}
<fieldset class="uk-fieldset uk-width-1-1">
<legend class="uk-legend">Pasirinkti studentą</legend>

<select name="student_filter" class="uk-select" onchange="event.preventDefault();
document.getElementById('student-filter-form').submit();">

@if ($studentFilter === 'All')
	<option value="All" selected>-- All --</option>
@else	
	<option value="All">-- All --</option>
@endif

@foreach ($studentsList as $item)

@if ($item->id == $studentFilter)
	<option value="{{ $item->id }}" selected>{{ $item->surname }}</option>
@else
	<option value="{{ $item->id }}">{{ $item->surname }}</option>
@endif

@endforeach

</select>
</fieldset>
</form>	
</div> 



<div>
<form action="{{ route('grades.index') }}" method="get" id="lecture-filter-form">
{{--@method('PUT')--}}
<fieldset class="uk-fieldset uk-width-1-1">
<legend class="uk-legend">Pasirinkti paskaitą</legend>

<select name="lecture_filter" class="uk-select" onchange="event.preventDefault();
document.getElementById('lecture-filter-form').submit();">

@if ($lectureFilter === 'All')
	<option value="All" selected>-- All --</option>
@else	
	<option value="All">-- All --</option>
@endif

@foreach ($lecturesList as $item)

@if ($item->id == $lectureFilter)
	<option value="{{ $item->id }}" selected>{{ $item->name }}</option>
@else
	<option value="{{ $item->id }}">{{ $item->name }}</option>
@endif

@endforeach

</select>
</fieldset>
</form>	
</div> 


<div>
<form action="{{ route('grades.index') }}" method="get" id="grades-search-form">
{{--@method('PUT')--}}
<fieldset class="uk-fieldset uk-width-1-1">
<legend class="uk-legend">Ieškoti</legend>

<div class="uk-inline uk-width-1-1">
<a class="uk-form-icon uk-form-icon-flip" href="javascript:void();" uk-icon="icon: search"
onclick="event.preventDefault;document.getElementById('grades-search-form').submit()"></a>
<input type="text" class="uk-input" name="grade_filter"> 
</div>

</fieldset>
</form>	
</div>

</div>
</div>	


<a class="uk-button uk-button-default" href="{{ route('grades.create') }}">{{__('Pridėti')}}</a>

<div class="uk-overflow-auto">

<table class="uk-table uk-table-striped uk-table-divider uk-table-hover">
<thead>
<tr>
<th>{{__('Veiksmai')}}</th>
<th>Paskaita</th>
<th>Studentas:vardas</th>
<th>Studentas:pavardė</th>
<th>Pažymys</th>
</tr>
</thead>
<tbody>



@foreach ($grades as $grade)

<tr>
	<td>

        <form action="{{ route('grades.destroy', $grade->id)}}" method="POST" id="grades-destroy-{{ $grade->id }}">
        @csrf
        @method('DELETE')
		<a class="uk-icon-link" href="{{ route('grades.edit', $grade->id) }}" uk-icon="icon: file-edit"></a>
		<a class="uk-icon-link" href="javascript:void();" OnClick="document.getElementById('grades-destroy-{{ $grade->id }}').submit()" uk-icon="icon: trash"></a>
        </form>
	</td>
	<td>{{ $grade->lecture->name }}</td>
	<td>{{ $grade->student->name }}</td>
	<td>{{ $grade->student->surname }}</td>
	<td>{{ $grade->grade }}</td>
	
	
</tr>

@endforeach

</tbody>

</table>
</div>


{{ $grades->links('crud.pagination_links_simple') }}

@endsection