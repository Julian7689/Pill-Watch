<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de Medicamentos</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7f6;
            color: #333;
            text-align: center;
            margin: 0;
            padding: 20px;
        }

        h1 {
            color: #2c3e50;
            margin-bottom: 20px;
        }

        table {
            width: 90%;
            max-width: 800px;
            margin: 20px auto;
            border-collapse: collapse;
            background: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #3498db;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #ecf0f1;
        }
    </style>
</head>
<body>
    <h1> Historial de Medicamentos</h1>
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Dosis</th>
                <th>Frecuencia</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($medicamentos as $medicamento)
    <tr>
        <td>{{ $medicamento->nombre }}</td>
        <td>
            @foreach ($medicamento->dosis as $dosis)
                {{ $dosis->cantidad }} <!-- Ajusta según tu modelo de Dosis -->
            @endforeach
        </td>
        <td>
            @foreach ($medicamento->horarios as $horario)
                {{ $horario->hora }} <!-- Ajusta según tu modelo de Horario -->
            @endforeach
        </td>
    </tr>
@endforeach
        </tbody>
    </table>
</body>
</html>
