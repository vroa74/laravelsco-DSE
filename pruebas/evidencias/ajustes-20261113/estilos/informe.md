# Componentes comunes: integración del coordinador

Entrega up000063. El modal blanco fue rechazado durante la revisión: la referencia vigente es el gestor de miembros azul marino mostrado por el CEO. Se conserva composición y se aplican Gradient outline, naranja intenso para editar y cyan/azul para PDF.

Archivos de producto: resources/css/app.css y resources/views/components/{modal,dialog-modal}.blade.php. El diálogo tiene tokens locales temáticos, borde/sombra, cierre de44px, título accesible y pie adaptable. No se modifica escudo0.12 ni paneles principales0.62. El velo claro0.15 previo del usuario se conserva fuera del commit.

Validación del coordinador:
- Vite:10.84s. Pint limpio.
- Pest:23 pruebas/51 aserciones,33.27s, SQLite :memory: con guardia previa y cachés/temporales en /pruebas.
- Playwright local:6 escenarios,12 capturas,375/768/1366 y claro/oscuro. Sin errores de JavaScript, red externa o desbordamiento; contraste mínimo de botones4.758:1. Modales abiertos con foco, Tab contenido, Escape y cierre comprobados; calendarios reciben el esquema del tema.
- Se inspeccionaron capturas de modal móvil y botones de escritorio. Los primeros intentos del helper capturaban durante la transición; se corrigió la espera y la ruta local de fuentes y se repitió la comprobación completa.

Límites: fixture de componentes Blade reales, con transporte Livewire sustituido por estado local para navegador offline. No equivale a comprobar todos los modales de cada ruta, fotos, PDF ni operaciones de servidor. Vistas delegadas y fotografías permanecen en revisión separada. Sin aplicación real, MySQL o datos personales. Las capturas contienen únicamente datos sintéticos.
