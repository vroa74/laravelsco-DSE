<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte 1</title>
        <link rel="icon" type="image/png" href="{{ asset('media/img/favicon.png') }}v=5">
    <link href="{{ public_path('pdf.css') }}" rel="stylesheet">
</head>
<body>
    <div id="header">
        <div style="width: 96%; display: flex; justify-content: center;">
            <table style="width: 100%; border-collapse: collapse; ">
                <tr>
                    <!-- Primera columna (20%) -->
                    <td style="width: 20%; text-align: center; vertical-align: middle;">
                        <img src="{{ public_path('media/img/ple.png') }}" alt="Logo izquierdo" style="max-width: 100%; height: auto;">
                    </td>

                    <!-- Segunda columna (60%) - Texto centrado y más grande -->
                    <td style="width: 56%; text-align: center; vertical-align: middle; padding: 10px;">
                        <p class="text-base">
                            PODER LEGISLATIVO DEL ESTADO DE CAMPECHE</p>
                        <p class="text-sm">

                            SECRETARIA GENERAL Y ADMINISTRACION</p>
                        <p class="text-xs" >OFICIALÍA DE PARTES</p>
                        <p class="text-xs" > Volante de recibo de peticiones o solicitudes de información </p>
                    </td>

                    <!-- Tercera columna (20%) -->
                    <td style="width: 20%; text-align: center; vertical-align: middle;">
                        <img src="{{ public_path('media/img/legislatura.png') }}" alt="Logo derecho" style="max-width: 100%; height: auto;">
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <div id="footer" >
        <table class="two-column-table ">
            <tr>
                <!-- Columna del 70% -->
                <td class="col-70 ">
                </td>

                <!-- Columna del 30% -->

                <td class="col-30 tableRoundx">

                    <table style="width: 96%" >
                        <tr class=" mb-2">
                            <td class="tableRoundMS" style="height: 20px; line-height: 12px; padding: 2px; vertical-align: middle;">
                                <p class="text-center text-10px" style=" margin: 0.5rem; padding: 0.15rem;">
                                    Área de sello
                                </p>
                            </td>
                        </tr>
                        <tr class="  mb-2" >
                            <td class=" tableRoundMS  text-lg">
                                <p class="text-xs" ></p>
                                <p class="text-xs" ></p>
                                <p class="text-xs" ></p>
                                <p class="text-xs" ></p>
                                <p class="text-xs" ></p>
                                <p class="text-xs" ></p>
                                <p class="text-xs" ></p>
                                <p class="text-xs" ></p>
                                <p class="text-xs" ></p>
                                <p class="text-xs" ></p>
                                <p class="text-xs" ></p>
                                <p class="text-xs" ></p>
                                <p class="text-xs" ></p>
                                <p class="text-xs" ></p>
                                <p class="text-xs" ></p>
                                <p class="text-xs" ></p>
                            </td>
                        </tr>
                        <tr class="mb-4" >
                            <td class="text-center text-sm tableRoundMS leading-none p-0" >
                                <p class="text-center text-10px m-0 p-0">Nombre y Firma</p>
                                <p class="m-0 p-0">&nbsp;</p>
                                <p class="m-0 p-0">&nbsp;</p>
                            </td>
                        </tr>
                    </table>
                </td> {{--                fin de la columna del 30%--}}
            </tr>
            <div>
                <P class="text-8px" >
                    C.c.p. Minutario/Expediente
                </P>
                <P class="text-8px text-justify" >
                    Observación: Este oficio requiere respuesta al peticionario o solicitante, en el caso de solicitud de información considerar los  tiempos marcados en la Ley de Transparencia y Acceso a la Información Pública del Estado de Campeche. Favor de enviar a
                    esta Oficialía de Partes copia de la contestación para su control y seguimiento correspondiente. Hágase referencia al folio de
                    control asignado.
                </P>
                <P class="text-8px leading-xs" >
                    By <span class="text-gray-600 text-7px" >Vroa74@gmail.com</span>
                </P>
                <P><span class="text-gray-500 text-7px leading-3xs ">M.C.C. Victor Roman Ortiz Abreu</span></P>
            </div>

        </table>
    </div>

<div class="body">
    <table class="table4 mb-2 ">
        <tr  >
            <td  >
            <p class="text-10px pl-2 ">
                @if (!empty($registro->id))
                    <span class="font-bold">Número de oficio: </span> {{ $registro->id }}
                @endif
            </p>
            </td>
            <td  >
                <p class="text-10px ">
                    @if (!empty($registro->nofi))
                        <span class="font-bold">Número de oficio: </span> {{ $registro->nofi }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    @endif

                </p>
            </td>
        </tr>
        <tr>
            <td >
                <p class="text-10px pl-2 ">
                    @if (!empty($registro->fcap))
                        <span class="font-bold">Fecha del documento:</span>
                        {{ \Carbon\Carbon::parse($registro->fcap)->format('d/m/Y') }}  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    @endif

                </p>
            </td>
            <td >
                <p class="text-10px">
                    @if (!empty($registro->frec))
                        <span class="font-bold">Fecha de recepción:</span>
                        {{ \Carbon\Carbon::parse($registro->frec)->format('d/m/Y') }}  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    @endif

                </p>
            </td>
        </tr>
    </table>

    <table class="table4 mb-2 ">
        <tr  >
            <td  >
                @if (!empty($registro->rem_nombre))
                    <p class="text-10px pl-2  ">
                    <span class="font-bold">Nombre :</span> {{ $registro->rem_nombre }}
                    </p>
                @endif
                    @if (!empty($registro->rem_cargo))
                        <p class="text-10px pl-2 ">
                        <span class="font-bold">Cargo: </span> {{ $registro->rem_cargo}}
                        </p>
                    @endif
                    @if (!empty($registro->rem_deporg))
                        <p class="text-10px pl-2 ">
                        <span class="font-bold">Dependencia u Organismo: </span> {{ $registro->rem_deporg }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        </p>
                    @endif

                    @if (!empty($registro->rem_dir))
                        <p class="text-10px pl-2 ">
                        <span class="font-bold">Domicilio: </span> {{ $registro->rem_dir }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        </p>
                    @endif


            </td>
        </tr>
    </table>

    <table class="table4 mb-2 ">
        <tr  >
            <td>

                    @if (!empty($registro->tcor))
                    <p class="text-10px pl-2  ">
                        <span class="font-bold">Tipo del documento: </span> {{ $registro->tcor }}  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </p>
                    @endif
                    @if (!empty($registro->ccor))
                    <p class="text-10px pl-2  ">
                        <span class="font-bold"> clasificación del documento: </span> {{ $registro->ccor }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </p>
                    @endif
                    @if (!empty($registro->des))
                    <p class="text-10px pl-2  ">
                        <span class="font-bold"> Descripción del asunto: </span> {{ $registro->des }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </p>
                    @endif
                    @if (!empty($registro->seguimiento))
                    <p class="text-10px pl-2  ">
                        <span class="font-bold"> clasificación del documento: </span> {{ $registro->seguimiento }}
                    </p>
                    @endif
                <hr>
                    @if (!empty($registro->rem_nombre))
                            <p class="text-10px pl-2  ">
                        <span class="font-bold">Nombre: </span> {{ $registro->rem_nombre }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            </p>
                    @endif
                    @if (!empty($registro->rem_cargo))
                            <p class="text-10px pl-2  ">
                        <span class="font-bold">Cargo: </span> {{ $registro->rem_cargo}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            </p>
                    @endif
                    @if (!empty($registro->rem_deporg))
                            <p class="text-10px pl-2  ">
                        <span class="font-bold">Dependencia u Organismo: </span> {{ $registro->rem_deporg }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            </p>
                    @endif
            </td>
        </tr>
    </table>

 </div>

{{--<div>--}}
{{--    @for($i=0; $i<= 10; $i++)--}}
{{--        <div>--}}
{{--            <div class="cuadro text-sm">--}}
{{--                {{$i}}--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    @endfor--}}
{{--</div>--}}
</body>
</html>
