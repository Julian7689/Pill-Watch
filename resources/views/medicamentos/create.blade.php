@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto mt-20 bg-white p-8 rounded-lg shadow-md dark:bg-gray-800">
    <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-6">Agregar Medicamento</h2>

    <form id="medicamento-form" method="POST" action="{{ route('medicamentos.store') }}">
        @csrf
        <div class="mb-4">
            <label class="block text-gray-700 dark:text-gray-300 font-semibold">Nombre:</label>
            <input type="text" name="nombre" id="nombre" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 dark:text-gray-300 font-semibold">Cantidad:</label>
            <input type="number" name="cantidad" id="cantidad" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white" required>
        </div>

        <!-- Campo para agregar horarios de toma -->
        <div class="mb-4">
            <label class="block text-gray-700 dark:text-gray-300 font-semibold">Horarios de Toma:</label>
            <div id="horarios-container">
                <div class="flex items-center space-x-2 mb-2">
                    <input type="time" name="horarios[]" class="horario-input w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white">
                    <button type="button" class="bg-red-500 text-white px-2 py-1 rounded-lg remove-horario hidden">✖</button>
                </div>
            </div>
            <button type="button" id="add-horario" class="mt-2 bg-green-500 text-white px-4 py-2 rounded-lg">+ Agregar Horario</button>
        </div>

        <div class="flex justify-between">
            <button type="submit" class="w-1/2 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg">
                Guardar
            </button>
            
            <button type="button" id="cancelar-btn" class="w-1/2 bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-4 rounded-lg ml-2">
                Cancelar
            </button>
        </div>
    </form>
</div>

<script>
    document.getElementById('cancelar-btn').addEventListener('click', function () {
        document.getElementById('nombre').value = ''; 
        document.getElementById('cantidad').value = '';
        document.querySelectorAll('.horario-input').forEach(input => input.value = '');
    });

    document.getElementById('add-horario').addEventListener('click', function () {
        let horariosContainer = document.getElementById('horarios-container');
        let newHorario = document.createElement('div');
        newHorario.classList.add('flex', 'items-center', 'space-x-2', 'mb-2');
        newHorario.innerHTML = `
            <input type="time" name="horarios[]" class="horario-input w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white">
            <button type="button" class="bg-red-500 text-white px-2 py-1 rounded-lg remove-horario">✖</button>
        `;
        horariosContainer.appendChild(newHorario);
    });

    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-horario')) {
            e.target.parentElement.remove();
        }
    });
</script>
@endsection