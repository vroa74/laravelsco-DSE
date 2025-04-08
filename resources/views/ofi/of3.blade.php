@extends('layouts.free')

@section('title', 'Iniciar Sesión')

@section('content')

    <div class="max-w-4xl mx-auto text-white bg-gray-800 p-4 mb-6 rounded shadow">
        <h2>
            2. Clasificación y Validación:
        </h2>
        <h3 class="my-2" > Verificación:  </h3>
        <p>
            En este paso, se revisa cada documento recibido para garantizar que cumpla con los requisitos básicos:
            <ul>
            <li> Completo: Verificación de que no falten páginas o información esencial.</li>
            <li> Firmado y sellado: Si el documento requiere firmas o sellos, se verifica su presencia y validez.</li>
            <li> Documentación adjunta: Comprobación de anexos o referencias necesarias.</li>
        </ul>
        </p>
    </div>

    <div class="max-w-4xl mx-auto text-white bg-gray-800 p-4  mb-6 rounded shadow">
        <h3 class="my-2" >
            Clasificación: </h3>
        <p>Una vez que los documentos han sido verificados, se agrupan en categorías para facilitar su distribución y manejo: </p>

        <ul>
            <li>Por tipo: Oficios, solicitudes, informes, actas, etc.</li>
            <li>Por urgencia: Alta, media o baja prioridad, dependiendo del contenido y los plazos requeridos.</li>
            <li>Por área de destino: Departamento específico o responsable que debe gestionar el documento.</li>
            {{--        <li>Correo electrónico: Documentos enviados a la dirección oficial, donde el sistema puede procesarlos automáticamente o manualmente.</li>--}}
            {{--        <li>Sistemas digitales: Documentos subidos directamente a través de una plataforma web (como el sistema Laravel que estás desarrollando).</li>--}}
        </ul>

    </div>



@endsection
