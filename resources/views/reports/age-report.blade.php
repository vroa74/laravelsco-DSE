
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Edades</title>
    <style>
body {
    font-family: Arial, sans-serif;
        }
        table {
    width: 100%;
    border-collapse: collapse;
        }
        th, td {
    border: 1px solid #ddd;
            padding: 8px;
        }
        th {
    background-color: #f2f2f2;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Reporte de Lista de Ages</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Nombre</th>
                <th>Apellido Paterno</th>
                <th>Apellido Materno</th>
                <th>Cargo</th>
                <th>Departamento</th>
                <th>Teléfono</th>
                <th>Email</th>
                <th>Dirección</th>
            </tr>
        </thead>
        <tbody>
@foreach ($ages as $age)
                <tr>
                    <td>{{ $age->id }}</td>
                    <td>{{ $age->titulo }}</td>
                    <td>{{ $age->nombre }}</td>
                    <td>{{ $age->apaterno }}</td>
                    <td>{{ $age->amaterno }}</td>
                    <td>{{ $age->cargo }}</td>
                    <td>{{ $age->deporg }}</td>
                    <td>{{ $age->telefono }}</td>
                    <td>{{ $age->email }}</td>
                    <td>{{ $age->dir }}</td>
                </tr>
@endforeach
        </tbody>
    </table>
</body>
</html>
