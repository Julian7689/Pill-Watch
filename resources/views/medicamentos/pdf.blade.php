<!DOCTYPE html>
<html>
<head>
    <title>Historial de Medicamentos</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid black; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h1>Historial de Medicamentos</h1>
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Dosis</th>
                <th>Frecuencia</th>
            </tr>
        </thead>
        <tbody>
            @foreach($medicamentos as $medicamento)
                <tr>
                    <td>{{ $medicamento->nombre }}</td>
                    <td>{{ $medicamento->dosis }}</td>
                    <td>{{ $medicamento->frecuencia }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
