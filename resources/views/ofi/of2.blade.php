@extends('layouts.free')

@section('title', 'Iniciar Sesión')

@section('content')
    <div class="grid gap-6 lg:grid-cols-2 lg:gap-8">
        <div class="max-w-4xl mx-auto text-white bg-gray-800 p-4 mb-6 rounded shadow">
            <img src="{{ asset('media/pic/2.png') }}" style="width: 700px; height: 600px;" alt="Cuadro gráfico que representa el proceso">

        </div>
        <div>
        <div class="max-w-4xl mx-auto text-white bg-gray-800 p-4 mb-6 rounded shadow">
            <h2>
            1. Recepción de Documentos:
            </h2>
            <h3 class="my-2" > Función principal:  </h3>
            <p>
            El proceso de recepción de documentos es clave en la oficialía de partes. Aquí es donde se asegura que todos los documentos entrantes sean registrados adecuadamente, sin importar su origen, para evitar pérdidas de información. La tarea principal es recibir documentos de diversas fuentes, verificar su contenido y asignarles un número de identificación único.
            </p>
        </div>

        <div class="max-w-4xl mx-auto text-white bg-gray-800 p-4  mb-6 rounded shadow">
            <h3 class="my-2" >
                Canales de recepción: </h3>
            <p>
            <ul>
                <li>Ventanilla física: Un lugar dedicado en la oficina donde los usuarios pueden entregar documentos en papel.</p></li>
                {{--        <li>Correo electrónico: Documentos enviados a la dirección oficial, donde el sistema puede procesarlos automáticamente o manualmente.</li>--}}
                {{--        <li>Sistemas digitales: Documentos subidos directamente a través de una plataforma web (como el sistema Laravel que estás desarrollando).</li>--}}
            </ul>

        </div>
        <div class="max-w-4xl mx-auto text-white bg-gray-800 p-4  mb-6 rounded shadow">
            <h3 class="my-2" >Registro inicial:</h3>
            <p>A cada documento recibido, ya sea físico o electrónico, se le asigna un número de folio único. Este número permite su rastreo a lo largo del flujo de trabajo y garantiza que el documento sea fácilmente localizable. </p>

        </div>
        </div>
    </div>

@endsection
