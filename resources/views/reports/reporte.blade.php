<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte General</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 10px; margin: 20px; }
        .header { text-align: center; margin-bottom: 20px; }
        .title { font-size: 16px; font-weight: bold; margin-bottom: 10px; }
        .subtitle { font-size: 12px; margin-bottom: 5px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #ccc; padding: 4px; text-align: left; }
        th { background-color: #f0f0f0; font-weight: bold; }
        .footer { margin-top: 30px; font-size: 8px; }
        .total { text-align: center; font-weight: bold; margin: 10px 0; }
    </style>
</head>
<body>
    <div class="header">
        <div class="title">PODER LEGISLATIVO DEL ESTADO DE CAMPECHE</div>
        <div class="subtitle">SECRETARIA GENERAL Y ADMINISTRACION</div>
        <div class="subtitle">OFICIALÍA DE PARTES</div>
        <div class="subtitle">Reporte General de Correspondencia</div>
        <div class="subtitle">Fecha: {{ date('d/m/Y H:i:s') }}</div>
    </div>

    <div class="content">
        @if(isset($registros) && count($registros) > 0)
            <table>
                <thead>
                    <tr>
                        <th>Folio</th>
                        <th>Legislatura</th>
                        <th>Fecha Captura</th>
                        <th>Remitente</th>
                        <th>Descripción</th>
                        <th>Seguimiento</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($registros as $registro)
                        <tr>
                            <td>{{ $registro->id }}</td>
                            <td>{{ $registro->legislatura }}</td>
                            <td>{{ $registro->fcap ? date('d/m/Y', strtotime($registro->fcap)) : '-' }}</td>
                            <td>
                                @if(!empty($registro->rem_nombre))
                                    <strong>{{ $registro->rem_nombre }}</strong><br>
                                @endif
                                @if(!empty($registro->rem_cargo))
                                    {{ $registro->rem_cargo }}<br>
                                @endif
                                @if(!empty($registro->rem_deporg))
                                    {{ $registro->rem_deporg }}
                                @endif
                            </td>
                            <td>{{ Str::limit($registro->des, 50) }}</td>
                            <td>{{ Str::limit($registro->seguimiento, 50) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            
            <div class="total">
                Total de registros: {{ count($registros) }}
            </div>
        @else
            <div style="text-align: center; margin: 40px;">
                <p>No se encontraron registros con los filtros aplicados.</p>
            </div>
        @endif
    </div>

    <div class="footer">
        <p>C.c.p. Minutario/Expediente</p>
        <p>Observación: Este documento requiere atención urgente y respuesta a su remitente.</p>
        <p>By Vroa74@gmail.com - M.C.C. Victor Roman Ortiz Abreu</p>
    </div>
</body>
</html>
