# Guía de marca

Identidad visual de Infrasoft en el sistema.

---

## Logo

| Archivo | Ubicación |
|---------|-----------|
| Logo principal | `src/public/media/img/logo-infrasoft.png` |

### Uso en Blade

```blade
{{-- Header del sitio público (recomendado) --}}
<x-infrasoft-logo variant="header" />

{{-- Navbar del panel admin --}}
<x-infrasoft-logo variant="nav" />

{{-- Login, páginas de auth --}}
<x-infrasoft-logo variant="header" class="!h-16 !max-w-[300px]" />

{{-- Logo completo cuadrado --}}
<x-infrasoft-logo variant="full" size="lg" />
```

### Archivos de logo

| Archivo | Uso |
|---------|-----|
| `logo-infrasoft.png` | Logo completo (cuadrado, favicon) |
| `logo-infrasoft-header.png` | Versión recortada horizontal para header/nav |

### Variantes del componente

| Variante | Descripción |
|----------|-------------|
| `header` | Logo horizontal recortado para navbar y footer |
| `nav` | Versión compacta para panel admin |
| `full` | Logo completo con tamaños `xs`–`xl` |

### Favicon

El logo PNG se usa como favicon en todos los layouts:

```html
<link rel="icon" href="{{ asset('media/img/logo-infrasoft.png') }}" type="image/png">
```

---

## Paleta de colores

| Nombre | Hex | Uso |
|--------|-----|-----|
| Navy | `#0a192f` | Fondo header, footer, auth |
| Blue | `#0066cc` | Botones primarios, enlaces activos |
| Cyan | `#00aaff` | Acentos, hover en redes sociales |
| White | `#ffffff` | Texto sobre fondos oscuros |
| Gray 300 | `#d1d5db` | Texto secundario sobre oscuro |

### En Tailwind (admin — `app.css`)

```css
@theme {
    --color-infrasoft-navy: #0a192f;
    --color-infrasoft-blue: #0066cc;
    --color-infrasoft-cyan: #00aaff;
}
```

Clases disponibles: `bg-infrasoft-navy`, `text-infrasoft-blue`, `hover:text-infrasoft-cyan`, etc.

### En Tailwind CDN (sitio público — `landing-tailwind.blade.php`)

```javascript
colors: {
  infrasoft: {
    navy: '#0a192f',
    blue: '#0066cc',
    cyan: '#00aaff',
  },
}
```

---

## Tipografía

| Contexto | Fuente |
|----------|--------|
| Sitio público | Inter (Google Fonts) |
| Panel admin | Instrument Sans / Figtree (Bunny Fonts) |

---

## Dónde aparece el logo

| Ubicación | Componente | Tamaño |
|-----------|-----------|--------|
| Header sitio público | `<x-infrasoft-logo>` | md |
| Footer sitio público | `<x-infrasoft-logo>` | sm |
| Footer landing (home) | `<x-infrasoft-logo>` | md |
| Login / registro | `<x-infrasoft-logo>` | lg |
| Navbar admin | `<x-infrasoft-logo>` | sm |
| Favicon | PNG directo | — |

---

## Reemplazar el logo

1. Reemplazar el archivo `src/public/media/img/logo-infrasoft.png`
2. Mantener proporción horizontal (icono + texto)
3. Fondo oscuro recomendado para uso en header navy
4. Limpiar caché del navegador para ver el favicon actualizado

---

## Tagline

**"Make the Difference"** — aparece en el logo corporativo.

**"Servicios Informáticos"** — subtítulo de la marca.

---

## Documentos relacionados

- [Desarrollo](DESARROLLO.md) — componentes Blade
- [Manual de Usuario](../MANUAL_USUARIO.md)
