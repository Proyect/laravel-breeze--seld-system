<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Infrasoft Servicios Informáticos')</title>
    <meta name="description" content="@yield('meta_description', 'Desarrollo de sistemas, Data Science, Seguridad Informática, SaaS')">
    <meta name="author" content="Ariel Marcelo Diaz">
    <link rel="icon" href="{{ asset('media/img/logo-infrasoft.png') }}" type="image/png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
      tailwind.config = {
        theme: {
          extend: {
            fontFamily: {
              'sans': ['Inter', 'ui-sans-serif', 'system-ui'],
            },
            colors: {
              infrasoft: {
                navy: '#0a192f',
                'navy-light': '#112240',
                blue: '#0066cc',
                cyan: '#00aaff',
              },
            },
          }
        }
      }
    </script>
    <style>
      .site-header {
        background: linear-gradient(180deg, #0a192f 0%, #0d1f35 100%);
        border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        backdrop-filter: blur(12px);
      }
      .nav-link {
        position: relative;
        color: rgba(255, 255, 255, 0.75);
        font-weight: 500;
        transition: color 0.2s ease;
      }
      .nav-link:hover {
        color: #ffffff;
      }
      .nav-link::after {
        content: '';
        position: absolute;
        left: 0;
        bottom: -4px;
        width: 0;
        height: 2px;
        background: linear-gradient(90deg, #0066cc, #00aaff);
        transition: width 0.25s ease;
        border-radius: 1px;
      }
      .nav-link:hover::after {
        width: 100%;
      }
      .btn-primary {
        background: linear-gradient(135deg, #0066cc 0%, #0088ee 100%);
        box-shadow: 0 4px 14px rgba(0, 102, 204, 0.35);
        transition: all 0.25s ease;
      }
      .btn-primary:hover {
        background: linear-gradient(135deg, #0055aa 0%, #0077dd 100%);
        box-shadow: 0 6px 20px rgba(0, 102, 204, 0.45);
        transform: translateY(-1px);
      }
    </style>
    @stack('head')
</head>
<body class="bg-gray-50 text-gray-900 min-h-screen flex flex-col font-sans antialiased">
    <header class="site-header sticky top-0 z-50 shadow-lg shadow-black/20">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-[72px] md:h-[80px]">
                <a href="/" class="flex items-center shrink-0 py-2">
                    <x-infrasoft-logo variant="header" />
                </a>

                <nav class="hidden md:flex items-center gap-6 lg:gap-8">
                    <a href="/servicios" class="nav-link text-sm lg:text-base">Servicios</a>
                    <a href="/#portfolio" class="nav-link text-sm lg:text-base">Portfolio</a>
                    <a href="/#ventajas" class="nav-link text-sm lg:text-base">Ventajas</a>
                    <a href="/#about" class="nav-link text-sm lg:text-base">Nosotros</a>
                    <a href="{{ route('blog.index') }}" class="nav-link text-sm lg:text-base">Blog</a>
                    <a href="/#contacto" class="nav-link text-sm lg:text-base">Contacto</a>
                    @auth
                        <a href="{{ route('dashboard') }}" class="btn-primary ml-2 px-5 py-2.5 text-white text-sm font-semibold rounded-lg">Panel</a>
                    @else
                        <a href="{{ route('login') }}" class="btn-primary ml-2 px-5 py-2.5 text-white text-sm font-semibold rounded-lg">Ingresar</a>
                    @endauth
                </nav>

                <div class="md:hidden flex items-center gap-4">
                    <a href="/servicios" class="text-sm text-gray-300 hover:text-white transition">Servicios</a>
                    @auth
                        <a href="{{ route('dashboard') }}" class="btn-primary px-4 py-2 text-white text-sm font-semibold rounded-lg">Panel</a>
                    @else
                        <a href="{{ route('login') }}" class="btn-primary px-4 py-2 text-white text-sm font-semibold rounded-lg">Ingresar</a>
                    @endauth
                </div>
            </div>
        </div>
    </header>

    <main class="flex-1">
        @yield('container')
    </main>

    @hasSection('footer')
        @yield('footer')
    @else
    <footer class="bg-infrasoft-navy text-gray-200 py-8 border-t border-white/5">
        <div class="container mx-auto px-4 sm:px-6 flex flex-col md:flex-row justify-between items-center gap-6">
            <a href="/" class="shrink-0">
                <x-infrasoft-logo variant="header" class="!h-10 !max-w-[220px]" />
            </a>
            <div class="text-sm text-gray-400">&copy; {{ date('Y') }} Infrasoft Servicios Informáticos</div>
            <div class="flex gap-5">
                <a href="https://www.facebook.com/infrasofts/" target="_blank" rel="noopener" class="text-gray-400 hover:text-infrasoft-cyan transition"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M22.675 0h-21.35C.595 0 0 .592 0 1.326v21.348C0 23.406.595 24 1.326 24h11.495v-9.294H9.691v-3.622h3.13V8.413c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.797.143v3.24l-1.918.001c-1.504 0-1.797.715-1.797 1.763v2.313h3.587l-.467 3.622h-3.12V24h6.116C23.406 24 24 23.406 24 22.674V1.326C24 .592 23.406 0 22.675 0"></path></svg></a>
                <a href="https://twitter.com/infra_soft" target="_blank" rel="noopener" class="text-gray-400 hover:text-infrasoft-cyan transition"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557a9.93 9.93 0 0 1-2.828.775 4.932 4.932 0 0 0 2.165-2.724c-.951.564-2.005.974-3.127 1.195a4.92 4.92 0 0 0-8.384 4.482C7.691 8.095 4.066 6.13 1.64 3.161c-.542.929-.856 2.01-.857 3.17 0 2.188 1.115 4.117 2.823 5.247a4.904 4.904 0 0 1-2.229-.616c-.054 2.281 1.581 4.415 3.949 4.89a4.936 4.936 0 0 1-2.224.084c.627 1.956 2.444 3.377 4.6 3.417A9.867 9.867 0 0 1 0 21.543a13.94 13.94 0 0 0 7.548 2.209c9.057 0 14.009-7.496 14.009-13.986 0-.213-.005-.425-.014-.636A9.936 9.936 0 0 0 24 4.557z"></path></svg></a>
                <a href="https://api.whatsapp.com/send?phone=5493872204925&text=-Consultas-" target="_blank" rel="noopener" class="text-gray-400 hover:text-green-400 transition"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M20.52 3.48A11.93 11.93 0 0 0 12 0C5.37 0 0 5.37 0 12c0 2.11.55 4.16 1.6 5.97L0 24l6.18-1.62A11.94 11.94 0 0 0 12 24c6.63 0 12-5.37 12-12 0-3.19-1.24-6.19-3.48-8.52zM12 22c-1.85 0-3.68-.5-5.26-1.44l-.38-.22-3.67.96.98-3.58-.25-.37A9.94 9.94 0 0 1 2 12c0-5.52 4.48-10 10-10s10 4.48 10 10-4.48 10-10 10zm5.2-7.6c-.28-.14-1.65-.81-1.9-.9-.25-.09-.43-.14-.61.14-.18.28-.7.9-.86 1.08-.16.18-.32.2-.6.07-.28-.14-1.18-.44-2.25-1.4-.83-.74-1.39-1.65-1.55-1.93-.16-.28-.02-.43.12-.57.13-.13.28-.34.42-.51.14-.17.18-.29.28-.48.09-.19.05-.36-.02-.5-.07-.14-.61-1.47-.84-2.01-.22-.53-.45-.46-.61-.47-.16-.01-.35-.01-.54-.01-.19 0-.5.07-.76.34-.26.27-1 1-1 2.43 0 1.43 1.02 2.81 1.16 3 .14.19 2.01 3.07 4.88 4.19.68.29 1.21.46 1.62.59.68.22 1.3.19 1.79.12.55-.08 1.65-.67 1.88-1.32.23-.65.23-1.2.16-1.32-.07-.12-.25-.19-.53-.33z"></path></svg></a>
            </div>
        </div>
    </footer>
    @endif
    @stack('scripts')
</body>
</html>
