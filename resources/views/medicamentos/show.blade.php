@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto mt-20 bg-white p-8 rounded-lg shadow-md dark:bg-gray-800">
    <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-6">{{ $medicamento->nombre }}</h2>
    
    <p class="text-gray-700 dark:text-gray-300"><strong>Descripción:</strong> {{ $medicamento->descripcion ?? 'Sin descripción' }}</p>
    <p class="text-gray-700 dark:text-gray-300"><strong>Cantidad:</strong> {{ $medicamento->cantidad }}</p>
    
    <a href="{{ route('medicamentos.index') }}" class="mt-4 inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg">
        Volver a la lista
    </a>
</div>
@endsection