@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto mt-10 bg-gradient-to-r from-blue-900 to-blue-600 p-10 rounded-xl shadow-2xl dark:bg-gray-900 transition-all text-white">
    <h2 class="text-4xl font-extrabold text-center mb-8">💊 Lista de Medicamentos</h2>

    <div class="overflow-hidden rounded-lg shadow-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-200">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-200 dark:bg-gray-700">
                    <th class="px-6 py-3 text-lg font-semibold">Nombre</th>
                    <th class="px-6 py-3 text-lg font-semibold">Cantidad</th>
                    <th class="px-6 py-3 text-lg font-semibold text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($medicamentos as $medicamento)
                    <tr class="border-b dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                        <td class="px-6 py-4">{{ $medicamento->nombre }}</td>
                        <td class="px-6 py-4">{{ $medicamento->cantidad }}</td>
                        <td class="px-6 py-4 flex justify-center space-x-4">
                            <a href="{{ route('medicamentos.edit', $medicamento->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-black px-4 py-2 rounded-lg shadow-md text-sm">✏️ Editar</a>
                            <form action="{{ route('medicamentos.destroy', $medicamento->id) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar este medicamento?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg shadow-md text-sm">🗑️ Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Botón para agregar medicamentos -->
    <div class="mt-10 flex justify-center">
        <a href="{{ route('medicamentos.create') }}" class="bg-green-500 hover:bg-green-600 text-white font-semibold py-3 px-8 rounded-lg shadow-lg text-lg transition-all">
            ➕ Agregar Medicamento
        </a>
    </div>
</div>
@endsection
