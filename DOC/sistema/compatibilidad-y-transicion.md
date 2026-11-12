# Compatibilidad y transición del stack

Fecha: 12/11/2026. Revisión del coordinador de F1.2. Resultado: dirección y adaptadores elegidos, consumidores y pruebas de integración identificados. No se instalaron paquetes ni se resolvió o compiló el stack objetivo.

## Estado comprobado y objetivo

| Capa | Base existente | Decisión de transición | Evidencia/límite |
| --- | --- | --- | --- |
| Backend | Laravel 12.72.0, Composer ^12.0; PHP CLI 8.5.11 comunicado y comprobado por el desarrollador. Composer simula 8.4.0. | Laravel ^13.0 con PHP 8.5 como objetivo. Conservar plataforma Composer durante la primera resolución salvo motivo verificado. | Laravel 13 admite PHP 8.3–8.5 según sus notas; PHP del servidor web sigue sin comprobar. No confundir CLI/plataforma/runtime web. |
| Inertia servidor | No instalado. | inertiajs/inertia-laravel ^3. | El manifiesto 3.x admite Laravel ^11.35, ^12 y ^13; resuelve el pendiente declarado por el desarrollador. No demuestra resolución del conjunto. |
| Svelte e Inertia cliente | No instalados. | Svelte 5, @inertiajs/svelte ^3 y TypeScript, páginas por recurso y rutas Laravel actuales. | El adaptador Svelte 3.x declara Svelte ^5. No crear API paralela. |
| Vite | 8.3.8; laravel-vite-plugin ^3.2.1. | Conservar Vite 8 y seleccionar vite-plugin-svelte 7 compatible. | Manifiesto upstream 7.3.1: Svelte ^5.46.4, Vite ^8 y Node ^20.19/^22.12/>=24. Son candidatos por declaración; confirmar publicación y lock al resolver. |
| Tailwind | 3.4.19 con preset WireUI y Flowbite 2.5.2. | Tailwind 4 para el destino; conservar el aspecto y flujo aprobados. | @tailwindcss/vite 4.x declara Vite 5.2/6/7/8. La adaptación CSS y la convivencia con 3 requieren build real posterior. |
| Autenticación actual | Jetstream, Fortify, Sanctum y pantallas personalizadas. | Mantener capacidades, políticas y sesión; reemplazar interfaz por recorrido, no retirar paquetes por anticipado. | Los constraints instalados leídos por el desarrollador admiten Laravel 13; probar login/perfil/MFA/sesiones y estado activo al actualizar. |
| Reportes y QR | Dompdf, Snappy, Excel y QR actuales. | Mantener Blade de servidor cuando corresponda y filtros/permisos comunes. | Revisar cada consumidor y constraints en la resolución; una declaración compatible no prueba PDF/CSV ejecutados. |

Fuentes primarias: [Laravel 13](https://laravel.com/framework/docs/13.x/releases), [guía de actualización](https://laravel.com/framework/docs/13.x/upgrade), [Inertia Laravel 3.x](https://raw.githubusercontent.com/inertiajs/inertia-laravel/3.x/composer.json), [Svelte/Vite](https://raw.githubusercontent.com/sveltejs/vite-plugin-svelte/main/packages/vite-plugin-svelte/package.json), [adaptador Inertia/Svelte](https://raw.githubusercontent.com/inertiajs/inertia/3.x/packages/svelte/package.json) y [Tailwind/Vite](https://raw.githubusercontent.com/tailwindlabs/tailwindcss/main/packages/@tailwindcss-vite/package.json). Los manifiestos upstream no equivalen a paquetes instalados.

## Convivencia y paridad

- Mantener la entrada actual app.js/app.css para las pantallas Blade/Livewire todavía no migradas. No retirar Alpine, WireUI, Flowbite o Vue hasta inventariar y sustituir consumidores.
- Preparar una entrada Svelte/TypeScript y un layout Inertia propios del nuevo recorrido. Cargar en cada layout solo su CSS y JavaScript; la navegación entre motores debe mantener sesión y no montar ambas aplicaciones en el mismo DOM.
- La separación de CSS es una decisión de transición, no una garantía de que dos versiones de Tailwind funcionen sin configuración. Elegir alias/entradas o builds separados durante la implementación y comprobar resolución, reset, plugins y tamaño del bundle.
- Tailwind 4 cambia configuración y algunas utilidades. Adaptar equivalencias visuales contra las vistas actuales, sin inventar campos, botones o flujo; las mejoras estéticas permitidas conservan funcionalidad y responsive obligatorio.
- Priorizar listado/búsqueda y captura después de permisos e identidades mínimas. No migrar primero un dashboard por comodidad ni reconstruir todos los módulos nuevos en Livewire.
- Mantener componentes de contraseña, acciones con iconos, filtros plegables, tabla-apilada, foco, mensajes en español y ambos temas. Guardar evidencia nueva bajo /pruebas.

La guía de [Tailwind 4](https://tailwindcss.com/docs/upgrade-guide) especifica cambios de configuración, utilidades y navegadores mínimos; esa compatibilidad de navegador se comprueba en la aceptación real y no se deduce de un build.

## D15/D16 y validación pendiente

- D15: queda fijada la combinación objetivo anterior y el orden de transición. Durante la tarea de integración se debe resolver Composer/npm sin scripts no controlados, revisar lockfiles y adaptadores efectivamente publicados, y probar el conjunto. No publicar compatibilidad integral por estos manifiestos.
- D16: resuelta para las pruebas nuevas actuales mediante clases PHPUnit bajo /pruebas que extienden Tests/TestCase; Pest y PHPUnit las ejecutan. No depende de asumir que tests/Pest.php descubre carpetas externas. Un futuro uso de DSL Pest debe verificar su binding sin debilitar guardias.
- F1.3 implementó y verificó la preparación de pruebas: 62 aprobadas, 8 omitidas y 163 aserciones en la regresión completa; ver fase-1.md.
- Antes de modificar dependencias: revisar cambios upstream relevantes, consumidores, scripts, reversión y el entorno web. Instalar/resolver solo en la tarea asignada; no ejecutar migraciones o conectar a MySQL por actualizar paquetes.
- Después de integración: Pint para PHP, build y type-check con scripts realmente disponibles, pruebas protegidas y paridad visual/funcional en móvil/tableta/escritorio claro/oscuro, sin scroll horizontal. Ninguno de esos controles del stack futuro se ha ejecutado aún.

Este documento cierra F1.2 como preparación técnica según el plan; la implementación y su comprobación pertenecen a sus tareas de integración. No se afirma haber instalado Laravel 13, Svelte o Inertia.
