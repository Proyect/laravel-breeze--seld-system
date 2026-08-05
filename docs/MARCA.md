# Guía de marca

Identidad visual de Infrasoft en el sistema.

---

## Logo

| Archivo | Ubicación |
|---------|-----------|
| Logo principal | `src/public/media/img/logo-infrasoft.png` |

### Uso en Blade

```blade
{{-- Tamaños: xs, sm, md, lg, xl --}}
<x-infrasoft-logo size="md" />

{{-- Con clases adicionales --}}
<x-infrasoft-logo size="sm" class="md:h-14" />
```

### Tamaños disponibles

| Tamaño | Altura CSS | Uso recomendado |
|--------|-----------|-----------------|
| `xs` | 32px (h-8) | Favicon inline, espacios reducidos |
| `sm` | 40px (h-10) | Navbar admin, footer compacto |
| `md` | 48px (h-12) | Header público, footer principal |
| `lg` | 64px (h-16) | Login, páginas de auth |
| `xl` | 80px (h-20) | Hero, presentaciones |

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
