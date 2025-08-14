# Componentes Livewire Móviles vs Desktop

## Descripción

Se han creado versiones móviles de los componentes Livewire existentes en la página de catálogos. Cada componente tiene dos versiones:

- **Versión Desktop**: Componentes originales (sin prefijo)
- **Versión Móvil**: Componentes con prefijo "M" (M = Mobile)

## Componentes Disponibles

### 1. Legislaturas
- **Desktop**: `@livewire('leg')` - Componente `Leg`
- **Móvil**: `@livewire('m-leg')` - Componente `MLeg`

### 2. N. Cor. (Naturaleza de Correspondencia)
- **Desktop**: `@livewire('nc')` - Componente `Nc`
- **Móvil**: `@livewire('m-nc')` - Componente `MNc`

### 3. T. Cor. (Tipo de Correspondencia)
- **Desktop**: `@livewire('tc')` - Componente `Tc`
- **Móvil**: `@livewire('m-tc')` - Componente `MTc`

### 4. Clas. Cor. (Clasificación de Correspondencia)
- **Desktop**: `@livewire('cc')` - Componente `Cc`
- **Móvil**: `@livewire('m-cc')` - Componente `MCc`

## Rutas Disponibles

- **Desktop**: `/catalogos` - Usa componentes originales
- **Móvil**: `/catalogos-mobile` - Usa componentes móviles

## Características de los Componentes Móviles

### Diseño Responsivo
- Botones más grandes para facilitar el uso táctil
- Espaciado optimizado para pantallas pequeñas
- Colores y contrastes mejorados para dispositivos móviles

### Funcionalidad
- Misma funcionalidad que los componentes desktop
- Validaciones y lógica de negocio idénticas
- Manejo de errores y mensajes de éxito optimizados

### Estructura de Archivos

```
app/Livewire/
├── Leg.php          # Componente desktop
├── MLeg.php         # Componente móvil
├── Nc.php           # Componente desktop
├── MNc.php          # Componente móvil
├── Tc.php           # Componente desktop
├── MTc.php          # Componente móvil
├── Cc.php           # Componente desktop
└── MCc.php          # Componente móvil

resources/views/livewire/
├── leg.blade.php    # Vista desktop
├── m-leg.blade.php  # Vista móvil
├── nc.blade.php     # Vista desktop
├── m-nc.blade.php   # Vista móvil
├── tc.blade.php     # Vista desktop
├── m-tc.blade.php   # Vista móvil
├── cc.blade.php     # Vista desktop
└── m-cc.blade.php   # Vista móvil
```

## Cómo Implementar Detección de Dispositivo

Para implementar la detección automática de dispositivo y mostrar la versión correcta, puedes usar:

### Opción 1: Middleware de Detección de Dispositivo
Crear un middleware que detecte si es móvil y redirija automáticamente.

### Opción 2: JavaScript de Detección
```javascript
function isMobile() {
    return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
}

if (isMobile()) {
    window.location.href = '/catalogos-mobile';
}
```

### Opción 3: CSS Media Queries
```css
/* Ocultar componentes desktop en móvil */
@media (max-width: 768px) {
    .desktop-only {
        display: none;
    }
}

/* Ocultar componentes móviles en desktop */
@media (min-width: 769px) {
    .mobile-only {
        display: none;
    }
}
```

## Ventajas de la Implementación

1. **Mantenibilidad**: Código separado y fácil de mantener
2. **Flexibilidad**: Puedes modificar cada versión independientemente
3. **Performance**: Solo se cargan los componentes necesarios
4. **UX**: Experiencia optimizada para cada tipo de dispositivo
5. **Escalabilidad**: Fácil agregar más componentes móviles

## Notas Importantes

- Los componentes móviles usan los mismos modelos y lógica de negocio
- Las vistas están optimizadas para diferentes tamaños de pantalla
- Se mantiene la consistencia en funcionalidad entre ambas versiones
- Los componentes se auto-descubren gracias a Livewire 3
