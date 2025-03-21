@extends('layouts.app')

@section('content')
<h2>Notificaciones</h2>

<ul class="list-group">
    @foreach($notificaciones as $notificacion)
        <li class="list-group-item">
            {{ $notificacion->mensaje }}
            <span class="badge bg-{{ $notificacion->leido ? 'success' : 'warning' }}">
                {{ $notificacion->leido ? 'Leído' : 'No leído' }}
            </span>
        </li>
    @endforeach
</ul>
@endsection
