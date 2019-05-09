<!DOCTYPE html>
<html>
<head>
<title>{{ $metaTitle ?? '' }}</title>
<link rel="stylesheet" href="{{ asset('css/uikit.min.css') }}">
<body>

<nav class="uk-navbar-container uk-background-secondary uk-light uk-margin-bottom uk-navbar-transparent" uk-navbar>
<div class="uk-navbar-left">
<a href="{{ url('/') }}" class="uk-navbar-item uk-logo">Studentų pažymių knygelė</a>
</div>
<div class="uk-navbar-center">

{{-- Menu --}}

<ul class="uk-navbar-nav uk-visible@m">
<li><a href="{{ route('grades.index') }}">Pažymiai</a></li>
<li><a href="{{ route('lectures.index') }}">Paskaitos</a></li>
<li><a href="{{ route('students.index') }}">Studentai</a></li>
</ul>

</div>
<div class="uk-navbar-right">

{{-- Login button, lang switcher --}}




<div class="uk-navbar-item">
<a class="nav-link" href="{{ route('logout') }}" 
	onclick="event.preventDefault();document.getElementById('logout-form').submit();">
	{{ __('Logout') }}, {{ Auth::user()->name }}
</a>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
@csrf
</form>
</div>



</div>
</nav>

<div class="uk-container">
{{-- Content  --}}

@yield('content')

</div>
<script src="{{ asset('js/uikit.min.js') }}"></script>
<script src="{{ asset('js/uikit-icons.min.js') }}"></script>
</body>
</html>
