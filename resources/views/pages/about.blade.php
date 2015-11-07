@extends('app')

@section('content')
<h1>People i love:</h1>
@if(count($people))
    <ul>
        @foreach($people as $person)
            <li>{{ $person }}</li>
        @endforeach
    </ul>
@endif
<p>
    Ik ben Maikel,</br>
    En ik ben Laravel 5 aan het leren.</br>
    en ben nu met de video Blade101 aan het doen
</p>
@stop