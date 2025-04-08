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
                        <p class="text-xs" >Volante de recibo de correspondencia normal</p>
                    </td>

                    <!-- Tercera columna (20%) -->
                    <td style="width: 20%; text-align: center; vertical-align: middle;">
                        <img src="{{ public_path('media/img/legislatura.png') }}" alt="Logo derecho" style="max-width: 100%; height: auto;">
                    </td>
                </tr>
            </table>
        </div>
    </div>

{{--    <div class="bgfooter " ></div>--}}
    <div id="footer" >
        <table class="two-column-table ">
            <tr>
                <!-- Columna del 70% -->
                <td class="pt-6 mb-12 col-70">
                    <div>

                        <div style="
                            position: relative;
                            width: 150%;
                            height: 1900px; /* Ajusta el tamaño según el diseño */
                            background-image: url('data:image/png;base64,{{ base64_encode(file_get_contents(public_path('media/pic/i05.png'))) }}');
                            background-size: cover;
                            background-position: center;
                            top: 2cm;
                            opacity: 0.3;">
                        </div>
                        <div class="text-left" >
                        <P class="text-10px " >
                            C.c.p. Minutario/Expediente
                        </P>
                        <P class="text-8px leading-xs" >
                            By <span class="text-gray-600 text-7px" >Vroa74@gmail.com</span>
                        </P>
                        <P><span class="text-gray-500 text-7px leading-3xs " >M.C.C. Victor Roman Ortiz Abreu</span></P>
                        </div>
                    </div>
                    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </p>
                    <br>

                </td>

                <!-- Columna del 30% -->

                <td class="col-30 tableRoundx">

                    <table style="width: 96%" >
                        <tr class="mb-2 ">
                            <td class="tableRoundMS" style="height: 20px; line-height: 12px; padding: 2px; vertical-align: middle;">
                                <p class="text-center text-10px" style=" margin: 0.5rem; padding: 0.15rem;">
                                    Área de sello
                                </p>
                            </td>
                        </tr>
                        <tr class="mb-2 " >
                            <td class="text-lg  tableRoundMS">
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
                            <td class="p-0 text-sm leading-none text-center tableRoundMS" >
                                <p class="p-0 m-0 text-center text-10px">Nombre y Firma</p>
                                <p class="p-0 m-0">&nbsp;</p>
                                <p class="p-0 m-0">&nbsp;</p>
                            </td>
                        </tr>
                        <
                    </table>
                    <br><br>
                </td> {{--                fin de la columna del 30%--}}

            </tr>

        </table>
    </div>

<div class="body">
    <table class="mb-2 table4 ">
        <tr  >
            <td  >
            <p class="pl-2 text-10px ">
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
                <p class="pl-2 text-10px ">
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

    <table class="mb-2 table4 ">
        <tr  >
            <td  >
                @if (!empty($registro->rem_nombre))
                    <p class="pl-2 text-10px ">
                    <span class="font-bold">Nombre :</span> {{ $registro->rem_nombre }}
                    </p>
                @endif
                    @if (!empty($registro->rem_cargo))
                        <p class="pl-2 text-10px ">
                        <span class="font-bold">Cargo: </span> {{ $registro->rem_cargo}}
                        </p>
                    @endif
                    @if (!empty($registro->rem_deporg))
                        <p class="pl-2 text-10px ">
                        <span class="font-bold">Dependencia u Organismo: </span> {{ $registro->rem_deporg }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        </p>
                    @endif

                    @if (!empty($registro->rem_dir))
                        <p class="pl-2 text-10px ">
                        <span class="font-bold">Domicilio: </span> {{ $registro->rem_dir }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        </p>
                    @endif


            </td>
        </tr>
    </table>

    <table class="mb-2 table4 ">
        <tr  >
            <td>

                    @if (!empty($registro->tcor))
                    <p class="pl-2 text-10px ">
                        <span class="font-bold">Tipo del documento: </span> {{ $registro->tcor }}  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </p>
                    @endif
                    @if (!empty($registro->ccor))
                    <p class="pl-2 text-10px ">
                        <span class="font-bold"> clasificación del documento: </span> {{ $registro->ccor }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </p>
                    @endif
                    @if (!empty($registro->des))
                    <p class="pl-2 text-10px ">
                        <span class="font-bold"> Descripción del asunto: </span> {{ $registro->des }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </p>
                    @endif
                    @if (!empty($registro->seguimiento))
                    <p class="pl-2 text-10px ">
                        <span class="font-bold"> clasificación del documento: </span> {{ $registro->seguimiento }}
                    </p>
                    @endif
                <hr>
                    @if (!empty($registro->rem_nombre))
                            <p class="pl-2 text-10px ">
                        <span class="font-bold">Nombre: </span> {{ $registro->rem_nombre }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            </p>
                    @endif
                    @if (!empty($registro->rem_cargo))
                            <p class="pl-2 text-10px ">
                        <span class="font-bold">Cargo: </span> {{ $registro->rem_cargo}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            </p>
                    @endif
                    @if (!empty($registro->rem_deporg))
                            <p class="pl-2 text-10px ">
                        <span class="font-bold">Dependencia u Organismo: </span> {{ $registro->rem_deporg }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            </p>
                    @endif
            </td>
        </tr>
    </table>

 </div>
</body>
</html>
