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

@elseif (session()->get('success'))

<div class="uk-alert uk-alert-success" uk-alert>

<a class="uk-alert-close" uk-close></a>

{{ session()->get('success') }}  

</div>

@endif

<a class="uk-button uk-button-default" href="{{ route('students.create') }}">Pridėti</a>

<div class="uk-overflow-auto">

<table class="uk-table uk-table-striped uk-table-divider uk-table-hover">
<thead>
<tr>
<th>Veiksmai</th>
<th>Vardas</th>
<th>Pavardė</th>
<th>El. paštas</th>
<th>Telefonas</th>
</tr>
</thead>
<tbody>

@foreach ($students as $student)

<tr>
	<td>

        <form action="{{ route('students.destroy', $student->id)}}" id="students-destroy-{{ $student->id }}" method="POST">
        @csrf
        @method('DELETE')
		<a title="Edit" class="uk-icon-link" href="{{ route('students.edit', $student->id) }}" uk-icon="icon: file-edit"></a>
		@if ($student->grade->isNotEmpty())
			<span title="Locked" class="uk-icon-link" uk-icon="icon: lock"></span>
		@else
			<a title="Trash" class="uk-icon-link" href="javascript:void();" OnClick="document.getElementById('students-destroy-{{ $student->id }}').submit()" uk-icon="icon: trash"></a>
		@endif
        </form>

	</td>
	<td>{{ $student->name }}</td>
	<td>{{ $student->surname }}</td>
	<td>{{ $student->email }}</td>
	<td>{{ $student->phone }}</td>
</tr>

@endforeach

</tbody>

</table>
</div>


{{ $students->links('crud.pagination_links_simple') }}

@endsection