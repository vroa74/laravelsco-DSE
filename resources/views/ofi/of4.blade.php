@extends('layouts.free')

@section('title', 'Iniciar Sesión')

@section('content')

    <div class="max-w-4xl mx-auto text-white bg-gray-800 p-4 mb-6 rounded shadow">
        <h2>
            3. Registro Oficial:
        </h2>
        <h3 class="my-2" > Sistema de control:  </h3>
        <p>
            Los documentos, ya sean físicos o electrónicos, se ingresan en un sistema centralizado de registro. </p> <p>
            En el contexto de tu proyecto, este sistema podría estar basado en Laravel, donde cada documento recibido es registrado automáticamente con su información básica.
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


@endsection
