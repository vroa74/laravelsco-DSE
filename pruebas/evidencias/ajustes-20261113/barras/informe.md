# Agregar en la fila de acciones de /rg y /agen

Corregido el desplazamiento local que creaba una celda vacía de filtros para Agregar. Se restaura junto a PDF/CSV/Aplicar filtros; sigue fuera del cuerpo plegable. El enlace rg.create y la acción openInsertModal permanecen iguales. La posición ya existía en HEAD; RG no conserva diferencia versionable después de corregir el estado local.

También se integra el acabado pendiente de modales People después de corregir el h3 duplicado de edición y su cierre accesible.

Verificación: build7.79s; Pint; exportación con SQLite :memory: y guardia previa,1 prueba/11 aserciones. Se renderizó además el componente real People en edición para comprobar un único h3 con título correcto. Navegador offline:12 capturas, dos rutas, dos temas,375/768/1366; sin desbordamiento. Un único Agregar en la barra, a la misma altura de PDF,8 bloques de filtros en RG y4 en directorio; en1366px se distribuyen en2 y1 filas.

Sin aplicación real, MySQL, datos personales ni escrituras de negocio. El exportador reemplaza imágenes por una decoración local: las capturas acreditan posición y distribución, no reparación de fotos ni logotipos reales. Parches ajenos permanecen fuera de esta entrega.
