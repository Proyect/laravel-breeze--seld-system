# Hero Slider - Documentación

## Estructura de Archivos

El hero slider ha sido reorganizado para mejor mantenibilidad y organización del código:

### 📁 Archivos CSS
- **`resources/css/hero.css`** - Estilos específicos del hero slider
  - Estilos del fondo y overlay
  - Personalización de Swiper
  - Efectos hover y responsive
  - Sombras y transiciones

### 📁 Archivos JavaScript
- **`resources/js/hero-slider.js`** - Lógica del slider
  - Clase `HeroSlider` con métodos públicos
  - Configuración completa de Swiper
  - Manejo de eventos y errores
  - API para control externo

### 📁 Vista Blade
- **`resources/views/site/index.blade.php`** - Vista principal
  - HTML limpio y semántico
  - Uso de `@vite()` para assets
  - Estructura organizada con clases CSS

## 🚀 Características

### Funcionalidades del Slider
- ✅ **Autoplay** con pausa en hover
- ✅ **Efecto fade** suave entre slides
- ✅ **Paginación** con bullets personalizados
- ✅ **Navegación por teclado** (flechas)
- ✅ **Responsive** con breakpoints
- ✅ **Loop infinito**
- ✅ **Grab cursor** para mejor UX

### Configuración Responsive
- **Móvil**: 4 segundos entre slides
- **Tablet**: 5 segundos entre slides  
- **Desktop**: 6 segundos entre slides

## 🛠️ Uso

### Inicialización Automática
El slider se inicializa automáticamente cuando se carga la página.

### Control Manual (Opcional)
```javascript
// Acceder a la instancia del slider
const slider = window.heroSlider;

// Métodos disponibles
slider.next();           // Siguiente slide
slider.prev();           // Slide anterior
slider.goTo(2);         // Ir al slide 2
slider.startAutoplay(); // Iniciar autoplay
slider.stopAutoplay();  // Detener autoplay
slider.destroy();        // Destruir slider
```

## 🔧 Configuración

### Vite
Los archivos están incluidos en `vite.config.js`:
```javascript
input: [
    'resources/css/app.css', 
    'resources/css/hero.css',
    'resources/js/app.js',
    'resources/js/hero-slider.js'
]
```

### Dependencias
- **Swiper 11** - CDN externo
- **Tailwind CSS** - Framework CSS
- **Laravel Vite** - Build tool

## 📱 Responsive

### Breakpoints
- **< 640px**: Móvil (4s autoplay)
- **640px - 1024px**: Tablet (5s autoplay)
- **> 1024px**: Desktop (6s autoplay)

### Clases CSS
- `.hero-content` - Contenedor del contenido
- `.hero-btn` - Botones con efectos hover
- `.swiper-pagination` - Paginación personalizada

## 🎨 Personalización

### Colores y Estilos
Los estilos se pueden personalizar editando `resources/css/hero.css`:
- Fondo del hero
- Overlay gradient
- Colores de paginación
- Efectos hover

### Configuración del Slider
La configuración se puede modificar en `resources/js/hero-slider.js`:
- Velocidad de transición
- Delays de autoplay
- Efectos de transición
- Comportamiento responsive

## 🐛 Troubleshooting

### Problemas Comunes
1. **Slider no se inicializa**: Verificar que Swiper esté cargado
2. **Estilos no se aplican**: Verificar que Vite esté compilando
3. **Autoplay no funciona**: Verificar configuración de eventos

### Logs
El slider incluye logs en consola para debugging:
- "Hero slider initialized successfully"
- "Hero slider is ready"
- Warnings y errores detallados

## 📝 Mantenimiento

### Agregar Nuevos Slides
1. Agregar HTML en la vista
2. Los estilos se aplican automáticamente
3. El JavaScript detecta cambios automáticamente

### Modificar Estilos
1. Editar `resources/css/hero.css`
2. Ejecutar `npm run dev` o `npm run build`
3. Los cambios se reflejan automáticamente

### Modificar Comportamiento
1. Editar `resources/js/hero-slider.js`
2. Modificar la configuración de Swiper
3. Reiniciar el servidor de desarrollo si es necesario 