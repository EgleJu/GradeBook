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

@elseif (session()->get('success'))

<div class="uk-alert uk-alert-success" uk-alert>

<a class="uk-alert-close" uk-close></a>

{{ session()->get('success') }}  

</div>

@endif

<a class="uk-button uk-button-default" href="{{ route('lectures.create') }}">{{__('Pridėti')}}</a>

<div class="uk-overflow-auto">

<table class="uk-table uk-table-striped uk-table-divider uk-table-hover">
<thead>
<tr>
<th>{{__('Veiksmai')}}</th>
<th>{{__('Paskaitos pavadinimas')}}</th>
<th>{{__('Aprašymas')}}</th>
</tr>
</thead>
<tbody>

@foreach ($lectures as $lecture)

<tr>
	<td>

        <form action="{{ route('lectures.destroy', $lecture->id)}}" id="lectures-destroy-{{ $lecture->id }}" method="POST">
        @csrf
        @method('DELETE')
		<a title="Edit" class="uk-icon-link" href="{{ route('lectures.edit', $lecture->id) }}" uk-icon="icon: file-edit"></a>
		@if ($lecture->grade->isNotEmpty())
			<span title="Locked" class="uk-icon-link" uk-icon="icon: lock"></span>
		@else
			<a title="Trash" class="uk-icon-link" href="javascript:void();" OnClick="document.getElementById('lectures-destroy-{{ $lecture->id }}').submit()" uk-icon="icon: trash"></a>
		@endif
        </form>

	</td>
	<td>{{ $lecture->name }}</td>
    <td>{{ $lecture->description }}</td>
</tr>

@endforeach

</tbody>

</table>
</div>


{{ $lectures->links('crud.pagination_links_simple') }}

@endsection