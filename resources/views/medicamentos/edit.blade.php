@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto mt-12 p-12 bg-blue-600 dark:bg-blue-700 text-white shadow-2xl rounded-2xl border border-blue-500 transition-all">
    <h2 class="text-3xl font-extrabold mb-8 text-center">✏️ Editar Medicamento</h2>

    <form action="{{ route('medicamentos.update', $medicamento->id) }}" method="POST" class="space-y-8">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-lg font-semibold mb-2">Nombre:</label>
            <input type="text" name="nombre" value="{{ $medicamento->nombre }}" required
                class="w-full px-5 py-3 rounded-xl border border-gray-300 focus:outline-none focus:ring-4 focus:ring-white text-gray-900">
        </div>

        <div>
            <label class="block text-lg font-semibold mb-2">Descripción:</label>
            <textarea name="descripcion" rows="4"
                class="w-full px-5 py-3 rounded-xl border border-gray-300 focus:outline-none focus:ring-4 focus:ring-white text-gray-900">{{ $medicamento->descripcion }}</textarea>
        </div>

        <div>
            <label class="block text-lg font-semibold mb-2">Cantidad:</label>
            <input type="number" name="cantidad" value="{{ $medicamento->cantidad }}" required
                class="w-full px-5 py-3 rounded-xl border border-gray-300 focus:outline-none focus:ring-4 focus:ring-white text-gray-900">
        </div>

        <div class="flex justify-center space-x-6 mt-8">
            <button type="submit"
                class="bg-white text-blue-600 font-semibold py-3 px-8 rounded-xl shadow-lg hover:bg-gray-200 transition-all">💾 Actualizar</button>
            <a href="{{ route('medicamentos.index') }}"
                class="bg-gray-300 text-gray-800 font-semibold py-3 px-8 rounded-xl shadow-lg hover:bg-gray-400 transition-all">❌ Cancelar</a>
        </div>
    </form>
</div>
@endsection