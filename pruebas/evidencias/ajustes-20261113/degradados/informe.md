# Gradient outline con dos colores visibles

Exterior degradado + span interior con fondo del tema; en hover el span es transparente. Los componentes comunes de texto/icono/enlace conservan sus eventos y etiquetas. Los colores se separan claramente: verde/azul, naranja/ámbar, amarillo/lima, rojo/fucsia, violeta/azul y cyan/azul, entre otros. Hover luminoso usa extremos profundos y tinta contrastada. Botones heredados sin span conservan equivalencia CSS.

Verificación: Vite15.46s; Pint;14 pruebas/32 aserciones,18.18s, solo SQLite :memory: con guardia previa y artefactos en /pruebas. Playwright offline:6 casos,12 capturas,375/768/1366 y ambos temas, sin fallos. Cada botón renderiza el componente Blade real con span, contorno2px, extremos distintos e interior transparente en hover; contraste mínimo5.015:1. Se mantienen foco/Tab/Escape/cierre y tamaños sin desbordamiento. Captura de escritorio revisada visualmente.

No se ejecutó la aplicación real ni MySQL, ni se modificaron reglas de negocio. Las comprobaciones de componentes no acreditan la totalidad de estados de cada CRUD. La aprobación del CEO permite continuar al siguiente bloque conservando pendientes de fotos/PDF.
