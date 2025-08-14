@extends('layouts.landing-tailwind')

@section('title', 'Infrasoft | Servicios Informáticos')
@section('meta_description', 'Desarrollo de software, Data Science, Seguridad Informática, SaaS y más.')

@push('head')
    <!-- SwiperJS CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <!-- Custom Hero Styles -->
    <style>
        /* Hero Section Styles */
        .hero-bg {
            background-image: url('https://images.unsplash.com/photo-1461749280684-dccba630e2f6?auto=format&fit=crop&w=1500&q=80'), 
                              linear-gradient(135deg, #0a2239 0%, #0066cc 100%);
            background-size: cover, cover;
            background-position: center, center;
            background-repeat: no-repeat, no-repeat;
            min-height: 500px;
            position: relative;
        }
        
        /* Fallback si la imagen no carga */
        .hero-bg::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, #0a2239 0%, #0066cc 100%);
            z-index: -1;
        }
        
        .hero-overlay {
            background: linear-gradient(120deg, rgba(10,34,57,0.85) 60%, rgba(0,170,255,0.7) 100%);
        }
        
        /* Swiper Customization */
        .swiper-slide {
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .swiper-pagination-bullet {
            background: white !important;
            opacity: 0.5 !important;
            transition: opacity 0.3s ease;
        }
        
        .swiper-pagination-bullet-active {
            opacity: 1 !important;
            transform: scale(1.2);
        }
        
        .swiper-pagination {
            bottom: 20px !important;
        }
        
        /* Hero Content Responsive */
        .hero-content h1 {
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
        }
        
        .hero-content p {
            text-shadow: 1px 1px 2px rgba(0,0,0,0.5);
        }
        
        /* Button Hover Effects */
        .hero-btn {
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }
        
        .hero-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0,0,0,0.3);
        }
        
        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .hero-bg {
                background-position: center center;
                min-height: 400px;
            }
            
            .swiper-pagination {
                bottom: 15px !important;
            }
        }
        
        /* Navigation Buttons */
        .swiper-button-next,
        .swiper-button-prev {
            color: white !important;
            background: rgba(0, 0, 0, 0.3);
            width: 50px !important;
            height: 50px !important;
            border-radius: 50%;
            transition: all 0.3s ease;
        }
        
        .swiper-button-next:hover,
        .swiper-button-prev:hover {
            background: rgba(0, 0, 0, 0.6);
            transform: scale(1.1);
        }
        
        .swiper-button-next::after,
        .swiper-button-prev::after {
            font-size: 20px !important;
            font-weight: bold;
        }
        
        /* Hide navigation on mobile */
        @media (max-width: 640px) {
            .swiper-button-next,
            .swiper-button-prev {
                display: none !important;
            }
        }
        
        /* Service Cards Styles */
        .service-card {
            transition: all 0.3s ease;
            border: 1px solid transparent;
        }
        
        .service-card:hover {
            border-color: rgba(59, 130, 246, 0.2);
        }
        
        /* Service Section Styles */
        .service-section {
            position: relative;
            overflow: hidden;
        }
        
        .service-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, transparent 30%, rgba(255,255,255,0.1) 50%, transparent 70%);
            transform: translateX(-100%);
            transition: transform 0.6s ease;
        }
        
        .service-section:hover::before {
            transform: translateX(100%);
        }
        
        /* Feature List Styles */
        .feature-item {
            transition: all 0.3s ease;
        }
        
        .feature-item:hover {
            transform: translateX(8px);
        }
        
        /* CTA Button Styles */
        .cta-primary {
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .cta-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s ease;
        }
        
        .cta-primary:hover::before {
            left: 100%;
        }
        
        /* Decorative Elements */
        .decorative-circle {
            animation: float 6s ease-in-out infinite;
        }
        
        .decorative-circle:nth-child(2) {
            animation-delay: 2s;
        }
        
        .decorative-circle:nth-child(3) {
            animation-delay: 4s;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        
        /* Responsive Service Grid */
        @media (max-width: 1024px) {
            .service-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        
        @media (max-width: 768px) {
            .service-grid {
                grid-template-columns: 1fr;
            }
            
            .service-section {
                padding: 3rem 0;
            }
        }
        
        /* Portfolio Styles */
        .portfolio-item {
            transition: all 0.5s ease;
            opacity: 1;
            transform: scale(1);
        }
        
        .portfolio-item.hidden {
            opacity: 0;
            transform: scale(0.8);
            display: none;
        }
        
        .portfolio-filter {
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .portfolio-filter::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s ease;
        }
        
        .portfolio-filter:hover::before {
            left: 100%;
        }
        
        .portfolio-filter.active {
            background: #2563eb !important;
            color: white !important;
            transform: scale(1.05);
            box-shadow: 0 4px 15px rgba(37, 99, 235, 0.4);
        }
        
        /* Portfolio Card Hover Effects */
        .portfolio-item .bg-white {
            transition: all 0.5s ease;
        }
        
        .portfolio-item:hover .bg-white {
            transform: translateY(-16px);
            box-shadow: 0 25px 50px rgba(0,0,0,0.25);
        }
        
        /* Technology Tags */
        .tech-tag {
            transition: all 0.3s ease;
        }
        
        .tech-tag:hover {
            transform: scale(1.1);
        }
        
        /* Portfolio Grid Animation */
        .portfolio-item {
            animation: fadeInUp 0.6s ease forwards;
        }
        
        .portfolio-item:nth-child(1) { animation-delay: 0.1s; }
        .portfolio-item:nth-child(2) { animation-delay: 0.2s; }
        .portfolio-item:nth-child(3) { animation-delay: 0.3s; }
        .portfolio-item:nth-child(4) { animation-delay: 0.4s; }
        .portfolio-item:nth-child(5) { animation-delay: 0.5s; }
        .portfolio-item:nth-child(6) { animation-delay: 0.6s; }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        /* Portfolio Image Hover Effects */
        .portfolio-item .relative {
            overflow: hidden;
        }
        
        .portfolio-item .w-full.h-48 {
            transition: all 0.5s ease;
        }
        
        .portfolio-item:hover .w-full.h-48 {
            transform: scale(1.1);
        }
        
        /* Portfolio Badge Animation */
        .portfolio-item .absolute.top-4.right-4 span {
            animation: badgePulse 2s ease-in-out infinite;
        }
        
        @keyframes badgePulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }
        
        /* Portfolio Action Buttons */
        .portfolio-item .flex.space-x-2 a {
            transition: all 0.3s ease;
        }
        
        .portfolio-item .flex.space-x-2 a:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }
        
        /* Portfolio Responsive */
        @media (max-width: 1024px) {
            .portfolio-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        
        @media (max-width: 768px) {
            .portfolio-grid {
                grid-template-columns: 1fr;
            }
            
            .portfolio-filters {
                flex-direction: column;
                align-items: center;
            }
            
            .portfolio-filter {
                width: 100%;
                max-width: 200px;
            }
        }
        
        /* Testimonial Styles */
        .testimonial-card {
            transition: all 0.5s ease;
            position: relative;
            overflow: hidden;
        }
        
        .testimonial-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, transparent 30%, rgba(59, 130, 246, 0.1) 50%, transparent 70%);
            transform: translateX(-100%);
            transition: transform 0.6s ease;
        }
        
        .testimonial-card:hover::before {
            transform: translateX(100%);
        }
        
        .testimonial-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        }
        
        /* Contact Form Styles */
        .contact-form input,
        .contact-form select,
        .contact-form textarea {
            transition: all 0.3s ease;
        }
        
        .contact-form input:focus,
        .contact-form select:focus,
        .contact-form textarea:focus {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(59, 130, 246, 0.15);
        }
        
        /* Social Media Icons */
        .social-icon {
            transition: all 0.3s ease;
        }
        
        .social-icon:hover {
            transform: scale(1.1) rotate(5deg);
        }
        
        /* Contact Info Cards */
        .contact-info-item {
            transition: all 0.3s ease;
        }
        
        .contact-info-item:hover {
            transform: translateX(8px);
        }
        
        .contact-info-item .w-12.h-12 {
            transition: all 0.3s ease;
        }
        
        .contact-info-item:hover .w-12.h-12 {
            transform: scale(1.1);
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.4);
        }
        
        /* Form Validation Styles */
        .form-input-error {
            border-color: #ef4444 !important;
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1) !important;
        }
        
        .form-input-success {
            border-color: #10b981 !important;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1) !important;
        }
        
        /* Loading States */
        .btn-loading {
            position: relative;
            color: transparent;
        }
        
        .btn-loading::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 20px;
            height: 20px;
            margin: -10px 0 0 -10px;
            border: 2px solid transparent;
            border-top: 2px solid currentColor;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        /* Responsive Contact */
        @media (max-width: 1024px) {
            .contact-grid {
                grid-template-columns: 1fr;
            }
            
            .contact-info {
                text-align: center;
                margin-bottom: 2rem;
            }
        }
        
        @media (max-width: 768px) {
            .contact-form {
                padding: 1.5rem;
            }
            
            .social-icons {
                justify-content: center;
            }
        }
        
        /* CTA Section Styles */
        .cta-section {
            position: relative;
            overflow: hidden;
        }
        
        .cta-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, transparent 30%, rgba(255,255,255,0.1) 50%, transparent 70%);
            transform: translateX(-100%);
            transition: transform 0.8s ease;
        }
        
        .cta-section:hover::before {
            transform: translateX(100%);
        }
        
        /* Counter Animation */
        .counter {
            transition: all 0.3s ease;
        }
        
        .counter.animate {
            transform: scale(1.1);
            color: #fbbf24;
        }
        
        /* Footer Styles */
        .footer-link {
            transition: all 0.3s ease;
            position: relative;
        }
        
        .footer-link::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: #3b82f6;
            transition: width 0.3s ease;
        }
        
        .footer-link:hover::after {
            width: 100%;
        }
        
        /* Reveal Animations */
        .reveal-on-scroll {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s ease;
        }
        
        .reveal-on-scroll.revealed {
            opacity: 1;
            transform: translateY(0);
        }
        
        /* Focus States */
        .focused {
            transform: scale(1.02);
        }
        
        /* Loading States */
        .loading {
            opacity: 0.7;
            pointer-events: none;
        }
        
        /* Success States */
        .success {
            border-color: #10b981;
            background-color: #f0fdf4;
        }
        
        /* Error States */
        .error {
            border-color: #ef4444;
            background-color: #fef2f2;
        }
        
        /* Hover Effects for Interactive Elements */
        .interactive-element {
            transition: all 0.3s ease;
            cursor: pointer;
        }
        
        .interactive-element:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }
        
        /* Gradient Text Effects */
        .gradient-text {
            background: linear-gradient(135deg, #3b82f6, #06b6d4);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        /* Glassmorphism Effects */
        .glass {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }
        
        ::-webkit-scrollbar-thumb {
            background: #3b82f6;
            border-radius: 4px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: #2563eb;
        }
        
        /* Print Styles */
        @media print {
            .no-print {
                display: none !important;
            }
            
            .print-break {
                page-break-before: always;
            }
        }
        
        /* High Contrast Mode Support */
        @media (prefers-contrast: high) {
            .bg-gray-100 {
                background-color: #000000 !important;
                color: #ffffff !important;
            }
            
            .text-gray-600 {
                color: #ffffff !important;
            }
        }
        
        /* Reduced Motion Support */
        @media (prefers-reduced-motion: reduce) {
            *,
            *::before,
            *::after {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
        }
        
        /* Dark Mode Support */
        @media (prefers-color-scheme: dark) {
            .auto-dark {
                background-color: #1f2937;
                color: #f9fafb;
            }
            
            .auto-dark .bg-white {
                background-color: #374151;
            }
            
            .auto-dark .text-gray-800 {
                color: #f9fafb;
            }
            
            .auto-dark .text-gray-600 {
                color: #d1d5db;
            }
        }
        
        /* Focus Visible for Accessibility */
        .focus-visible:focus {
            outline: 2px solid #3b82f6;
            outline-offset: 2px;
        }
        
        /* Skip Link for Accessibility */
        .skip-link {
            position: absolute;
            top: -40px;
            left: 6px;
            background: #3b82f6;
            color: white;
            padding: 8px;
            text-decoration: none;
            border-radius: 4px;
            z-index: 1000;
        }
        
        .skip-link:focus {
            top: 6px;
        }
        
        /* Responsive Typography */
        .responsive-text {
            font-size: clamp(1rem, 4vw, 2rem);
        }
        
        .responsive-heading {
            font-size: clamp(2rem, 8vw, 4rem);
        }
        
        /* Container Queries Support */
        @container (min-width: 400px) {
            .container-adaptive {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        
        @container (min-width: 600px) {
            .container-adaptive {
                grid-template-columns: repeat(3, 1fr);
            }
        }
        
        /* Modern CSS Grid Fallbacks */
        .modern-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }
        
        @supports not (display: grid) {
            .modern-grid {
                display: flex;
                flex-wrap: wrap;
            }
            
            .modern-grid > * {
                flex: 1 1 300px;
                margin: 1rem;
            }
        }
    </style>
@endpush

@section('container')
    <!-- Hero principal con slider y fondo -->
    <section class="relative hero-bg py-0 mb-12 shadow-lg">
        <div class="hero-overlay absolute inset-0 w-full h-full z-0"></div>
        <div class="relative z-10">
            <div class="swiper hero-swiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide flex flex-col items-center justify-center min-h-[400px] md:min-h-[500px] px-4">
                        <div class="hero-content text-center">
                            <h1 class="text-4xl md:text-5xl font-extrabold mb-4 drop-shadow-lg text-white tracking-tight">Soluciones Informáticas para tu Negocio</h1>
                            <p class="text-lg md:text-2xl mb-8 font-light text-blue-100 max-w-3xl">Desarrollo de Software · Data Science · Seguridad Informática · SaaS</p>
                            <a href="#contacto" class="hero-btn inline-block px-8 py-3 bg-blue-600 text-white font-semibold rounded shadow hover:bg-blue-700 transition">Solicita tu presupuesto</a>
                        </div>
                    </div>
                    <div class="swiper-slide flex flex-col items-center justify-center min-h-[400px] md:min-h-[500px] px-4">
                        <div class="hero-content text-center">
                            <h1 class="text-3xl md:text-4xl font-extrabold mb-4 drop-shadow-lg text-white tracking-tight">Transforma tu empresa con tecnología</h1>
                            <p class="text-lg md:text-xl mb-8 font-light text-blue-100 max-w-3xl">Automatización, análisis de datos y seguridad a tu alcance</p>
                            <a href="#servicio-desarrollo" class="hero-btn inline-block px-8 py-3 bg-blue-700 text-white font-semibold rounded shadow hover:bg-blue-800 transition">Ver servicios</a>
                        </div>
                    </div>
                    <div class="swiper-slide flex flex-col items-center justify-center min-h-[400px] md:min-h-[500px] px-4">
                        <div class="hero-content text-center">
                            <h1 class="text-3xl md:text-4xl font-extrabold mb-4 drop-shadow-lg text-white tracking-tight">Soluciones SaaS y en la Nube</h1>
                            <p class="text-lg md:text-xl mb-8 font-light text-blue-100 max-w-3xl">Escala tu negocio con plataformas modernas y seguras</p>
                            <a href="#servicio-saas" class="hero-btn inline-block px-8 py-3 bg-cyan-600 text-white font-semibold rounded shadow hover:bg-cyan-700 transition">Descubre más</a>
                        </div>
                    </div>
                </div>
                <!-- Pagination -->
                <div class="swiper-pagination"></div>
                <!-- Navigation -->
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
    </section>

    <!-- Sección de Servicios -->
    <section id="servicios" class="py-20 bg-gradient-to-br from-gray-50 via-blue-50 to-cyan-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">Nuestros Servicios</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">Soluciones tecnológicas integrales para transformar tu negocio y potenciar tu crecimiento</p>
            </div>
            
            <!-- Grid de Servicios -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-16">
                <!-- Desarrollo de Software -->
                <div class="service-card bg-white rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 p-6 text-center">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-2a2 2 0 012-2h2a2 2 0 012 2v2m-6 4h6a2 2 0 002-2v-6a2 2 0 00-2-2h-2a2 2 0 00-2 2v6a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Desarrollo de Software</h3>
                    <p class="text-gray-600 mb-4">Sistemas a medida, robustos y escalables para tu empresa</p>
                    <a href="#servicio-desarrollo" class="text-blue-600 font-semibold hover:text-blue-800 transition">Ver más →</a>
                </div>

                <!-- Data Science -->
                <div class="service-card bg-white rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 p-6 text-center">
                    <div class="w-16 h-16 bg-cyan-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-cyan-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 17a4 4 0 01-4-4V7a4 4 0 018 0v6a4 4 0 01-4 4zm0 0v2m0 0h2m-2 0H9" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Data Science</h3>
                    <p class="text-gray-600 mb-4">Analítica avanzada y modelos predictivos para decisiones inteligentes</p>
                    <a href="#servicio-datascience" class="text-cyan-600 font-semibold hover:text-cyan-800 transition">Ver más →</a>
                </div>

                <!-- Seguridad Informática -->
                <div class="service-card bg-white rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 p-6 text-center">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-blue-800" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Ciberseguridad</h3>
                    <p class="text-gray-600 mb-4">Protección integral de datos y sistemas empresariales</p>
                    <a href="#servicio-seguridad" class="text-blue-800 font-semibold hover:text-blue-900 transition">Ver más →</a>
                </div>

                <!-- SaaS y Nube -->
                <div class="service-card bg-white rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 p-6 text-center">
                    <div class="w-16 h-16 bg-cyan-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-cyan-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 15a4 4 0 004 4h10a4 4 0 100-8h-1.26A8 8 0 103 15z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">SaaS & Nube</h3>
                    <p class="text-gray-600 mb-4">Soluciones cloud escalables para digitalizar tu empresa</p>
                    <a href="#servicio-saas" class="text-cyan-700 font-semibold hover:text-cyan-900 transition">Ver más →</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Desarrollo de Software - Detallado -->
    <section id="servicio-desarrollo" class="service-section py-20 bg-gradient-to-r from-blue-50 via-white to-cyan-50">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <!-- Contenido -->
                <div class="order-2 lg:order-1">
                    <div class="mb-8">
                        <span class="inline-block px-4 py-2 bg-blue-100 text-blue-800 rounded-full text-sm font-semibold mb-4">Desarrollo a Medida</span>
                        <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-6">Desarrollo de Software</h2>
                        <p class="text-xl text-gray-600 mb-8 leading-relaxed">
                            Creamos soluciones tecnológicas personalizadas que se adaptan perfectamente a las necesidades específicas de tu negocio. 
                            Desde aplicaciones web hasta sistemas empresariales complejos.
                        </p>
                    </div>

                    <!-- Características -->
                    <div class="space-y-6 mb-8">
                        <div class="feature-item flex items-start space-x-4">
                            <div class="w-6 h-6 bg-blue-600 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800 mb-1">Aplicaciones Web y Móviles</h4>
                                <p class="text-gray-600">Sitios web responsivos, aplicaciones móviles nativas y híbridas</p>
                            </div>
                        </div>

                        <div class="feature-item flex items-start space-x-4">
                            <div class="w-6 h-6 bg-blue-600 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800 mb-1">Integración de Sistemas</h4>
                                <p class="text-gray-600">Conectamos tus sistemas existentes con nuevas tecnologías</p>
                            </div>
                        </div>

                        <div class="feature-item flex items-start space-x-4">
                            <div class="w-6 h-6 bg-blue-600 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800 mb-1">Automatización de Procesos</h4>
                                <p class="text-gray-600">Optimizamos flujos de trabajo para mayor eficiencia</p>
                            </div>
                        </div>
                    </div>

                    <!-- CTA -->
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="#contacto" class="cta-primary inline-flex items-center justify-center px-8 py-4 bg-blue-600 text-white font-semibold rounded-lg shadow-lg hover:bg-blue-700 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                            Solicitar Presupuesto
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </a>
                        <a href="#portfolio" class="inline-flex items-center justify-center px-8 py-4 border-2 border-blue-600 text-blue-600 font-semibold rounded-lg hover:bg-blue-600 hover:text-white transition-all duration-300">
                            Ver Portfolio
                        </a>
                    </div>
                </div>

                <!-- Imagen/Ilustración -->
                <div class="order-1 lg:order-2 text-center">
                    <div class="relative">
                        <div class="w-80 h-80 bg-gradient-to-br from-blue-400 to-cyan-500 rounded-full mx-auto flex items-center justify-center shadow-2xl">
                            <svg class="w-32 h-32 text-white" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-2a2 2 0 012-2h2a2 2 0 012 2v2m-6 4h6a2 2 0 002-2v-6a2 2 0 00-2-2h-2a2 2 0 00-2 2v6a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <!-- Elementos decorativos -->
                        <div class="decorative-circle absolute -top-4 -right-4 w-20 h-20 bg-yellow-400 rounded-full opacity-80"></div>
                        <div class="decorative-circle absolute -bottom-4 -left-4 w-16 h-16 bg-green-400 rounded-full opacity-80"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Data Science - Detallado -->
    <section id="servicio-datascience" class="service-section py-20 bg-gradient-to-r from-cyan-50 via-white to-blue-50">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <!-- Imagen/Ilustración -->
                <div class="text-center">
                    <div class="relative">
                        <div class="w-80 h-80 bg-gradient-to-br from-cyan-400 to-blue-500 rounded-full mx-auto flex items-center justify-center shadow-2xl">
                            <svg class="w-32 h-32 text-white" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10a2 2 0 01-2 2h-2a2 2 0 01-2-2zm0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </div>
                        <!-- Elementos decorativos -->
                        <div class="decorative-circle absolute -top-4 -left-4 w-20 h-20 bg-purple-400 rounded-full opacity-80"></div>
                        <div class="decorative-circle absolute -bottom-4 -right-4 w-16 h-16 bg-pink-400 rounded-full opacity-80"></div>
                    </div>
                </div>

                <!-- Contenido -->
                <div>
                    <div class="mb-8">
                        <span class="inline-block px-4 py-2 bg-cyan-100 text-cyan-800 rounded-full text-sm font-semibold mb-4">Analítica Avanzada</span>
                        <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-6">Data Science & Analytics</h2>
                        <p class="text-xl text-gray-600 mb-8 leading-relaxed">
                            Transformamos datos en insights accionables. Nuestras soluciones de Data Science te permiten 
                            tomar decisiones informadas y descubrir oportunidades ocultas en tu negocio.
                        </p>
                    </div>

                    <!-- Características -->
                    <div class="space-y-6 mb-8">
                        <div class="feature-item flex items-start space-x-4">
                            <div class="w-6 h-6 bg-cyan-600 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800 mb-1">Dashboards Interactivos</h4>
                                <p class="text-gray-600">Visualizaciones en tiempo real de KPIs y métricas clave</p>
                            </div>
                        </div>

                        <div class="feature-item flex items-start space-x-4">
                            <div class="w-6 h-6 bg-cyan-600 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800 mb-1">Modelos Predictivos</h4>
                                <p class="text-gray-600">Machine Learning para anticipar tendencias y comportamientos</p>
                            </div>
                        </div>

                        <div class="feature-item flex items-start space-x-4">
                            <div class="w-6 h-6 bg-cyan-600 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800 mb-1">Automatización de Reportes</h4>
                                <p class="text-gray-600">Generación automática de informes y análisis periódicos</p>
                            </div>
                        </div>
                    </div>

                    <!-- CTA -->
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="#contacto" class="cta-primary inline-flex items-center justify-center px-8 py-4 bg-cyan-600 text-white font-semibold rounded-lg shadow-lg hover:bg-cyan-700 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                            Consultar Servicios
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </a>
                        <a href="#demo" class="inline-flex items-center justify-center px-8 py-4 border-2 border-cyan-600 text-cyan-600 font-semibold rounded-lg hover:bg-cyan-600 hover:text-white transition-all duration-300">
                            Solicitar Demo
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Seguridad Informática - Detallado -->
    <section id="servicio-seguridad" class="service-section py-20 bg-gradient-to-r from-blue-50 via-white to-cyan-50">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <!-- Contenido -->
                <div class="order-2 lg:order-1">
                    <div class="mb-8">
                        <span class="inline-block px-4 py-2 bg-blue-100 text-blue-800 rounded-full text-sm font-semibold mb-4">Protección Integral</span>
                        <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-6">Ciberseguridad & Seguridad Informática</h2>
                        <p class="text-xl text-gray-600 mb-8 leading-relaxed">
                            Protegemos tu empresa de amenazas digitales con soluciones integrales de ciberseguridad. 
                            Desde auditorías hasta implementación de protocolos de seguridad avanzados.
                        </p>
                    </div>

                    <!-- Características -->
                    <div class="space-y-6 mb-8">
                        <div class="feature-item flex items-start space-x-4">
                            <div class="w-6 h-6 bg-blue-800 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800 mb-1">Auditoría de Sistemas</h4>
                                <p class="text-gray-600">Evaluación completa de vulnerabilidades y riesgos de seguridad</p>
                            </div>
                        </div>

                        <div class="feature-item flex items-start space-x-4">
                            <div class="w-6 h-6 bg-blue-800 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800 mb-1">Consultoría en Ciberseguridad</h4>
                                <p class="text-gray-600">Asesoramiento experto para fortalecer tu postura de seguridad</p>
                            </div>
                        </div>

                        <div class="feature-item flex items-start space-x-4">
                            <div class="w-6 h-6 bg-blue-800 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800 mb-1">Implementación de Protocolos</h4>
                                <p class="text-gray-600">Establecimiento de políticas y procedimientos de seguridad</p>
                            </div>
                        </div>

                        <div class="feature-item flex items-start space-x-4">
                            <div class="w-6 h-6 bg-blue-800 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800 mb-1">Monitoreo 24/7</h4>
                                <p class="text-gray-600">Vigilancia continua de amenazas y respuesta rápida a incidentes</p>
                            </div>
                        </div>
                    </div>

                    <!-- CTA -->
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="#contacto" class="cta-primary inline-flex items-center justify-center px-8 py-4 bg-blue-800 text-white font-semibold rounded-lg shadow-lg hover:bg-blue-900 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                            Evaluar Seguridad
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </a>
                        <a href="#auditoria" class="inline-flex items-center justify-center px-8 py-4 border-2 border-blue-800 text-blue-800 font-semibold rounded-lg hover:bg-blue-800 hover:text-white transition-all duration-300">
                            Solicitar Auditoría
                        </a>
                    </div>
                </div>

                <!-- Imagen/Ilustración -->
                <div class="order-1 lg:order-2 text-center">
                    <div class="relative">
                        <div class="w-80 h-80 bg-gradient-to-br from-blue-600 to-blue-900 rounded-full mx-auto flex items-center justify-center shadow-2xl">
                            <svg class="w-32 h-32 text-white" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <!-- Elementos decorativos -->
                        <div class="absolute -top-4 -right-4 w-20 h-20 bg-red-400 rounded-full opacity-80 animate-pulse"></div>
                        <div class="absolute -bottom-4 -left-4 w-16 h-16 bg-orange-400 rounded-full opacity-80 animate-pulse" style="animation-delay: 0.5s;"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SaaS y Soluciones en la Nube - Detallado -->
    <section id="servicio-saas" class="service-section py-20 bg-gradient-to-r from-cyan-50 via-white to-blue-50">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <!-- Imagen/Ilustración -->
                <div class="text-center">
                    <div class="relative">
                        <div class="w-80 h-80 bg-gradient-to-br from-cyan-500 to-blue-600 rounded-full mx-auto flex items-center justify-center shadow-2xl">
                            <svg class="w-32 h-32 text-white" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 15a4 4 0 004 4h10a4 4 0 100-8h-1.26A8 8 0 103 15z" />
                            </svg>
                        </div>
                        <!-- Elementos decorativos -->
                        <div class="absolute -top-4 -left-4 w-20 h-20 bg-indigo-400 rounded-full opacity-80"></div>
                        <div class="absolute -bottom-4 -right-4 w-16 h-16 bg-teal-400 rounded-full opacity-80"></div>
                    </div>
                </div>

                <!-- Contenido -->
                <div>
                    <div class="mb-8">
                        <span class="inline-block px-4 py-2 bg-cyan-100 text-cyan-800 rounded-full text-sm font-semibold mb-4">Soluciones Cloud</span>
                        <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-6">SaaS & Soluciones en la Nube</h2>
                        <p class="text-xl text-gray-600 mb-8 leading-relaxed">
                            Digitalizamos tu empresa con soluciones SaaS escalables y seguras. Implementamos y personalizamos 
                            plataformas cloud que crecen junto con tu negocio.
                        </p>
                    </div>

                    <!-- Características -->
                    <div class="space-y-6 mb-8">
                        <div class="feature-item flex items-start space-x-4">
                            <div class="w-6 h-6 bg-cyan-700 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800 mb-1">Implementación de SaaS</h4>
                                <p class="text-gray-600">Despliegue y configuración de plataformas SaaS empresariales</p>
                            </div>
                        </div>

                        <div class="feature-item flex items-start space-x-4">
                            <div class="w-6 h-6 bg-cyan-700 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800 mb-1">Consultoría en la Nube</h4>
                                <p class="text-gray-600">Estrategias de migración y optimización cloud</p>
                            </div>
                        </div>

                        <div class="feature-item flex items-start space-x-4">
                            <div class="w-6 h-6 bg-cyan-700 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800 mb-1">Integración de Servicios</h4>
                                <p class="text-gray-600">Conectamos múltiples plataformas cloud en un ecosistema unificado</p>
                            </div>
                        </div>

                        <div class="feature-item flex items-start space-x-4">
                            <div class="w-6 h-6 bg-cyan-700 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800 mb-1">Escalabilidad Automática</h4>
                                <p class="text-gray-600">Sistemas que se adaptan automáticamente a la demanda</p>
                            </div>
                        </div>
                    </div>

                    <!-- CTA -->
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="#contacto" class="cta-primary inline-flex items-center justify-center px-8 py-4 bg-cyan-700 text-white font-semibold rounded-lg shadow-lg hover:bg-cyan-800 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                            Migrar a la Nube
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </a>
                        <a href="#cloud-assessment" class="inline-flex items-center justify-center px-8 py-4 border-2 border-cyan-700 text-cyan-700 font-semibold rounded-lg hover:bg-cyan-700 hover:text-white transition-all duration-300">
                            Evaluación Cloud
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Portfolio y Proyectos -->
    <section id="portfolio" class="py-20 bg-gradient-to-br from-gray-900 via-blue-900 to-gray-900 text-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <span class="inline-block px-4 py-2 bg-blue-600 text-white rounded-full text-sm font-semibold mb-4">Nuestro Trabajo</span>
                <h2 class="text-4xl md:text-5xl font-bold mb-6">Portfolio de Proyectos</h2>
                <p class="text-xl text-blue-100 max-w-3xl mx-auto">Descubre cómo hemos transformado empresas con soluciones tecnológicas innovadoras</p>
            </div>

            <!-- Filtros de Categorías -->
            <div class="flex flex-wrap justify-center gap-4 mb-12">
                <button class="portfolio-filter active px-6 py-3 bg-blue-600 text-white rounded-full font-semibold hover:bg-blue-700 transition-all duration-300" data-filter="all">
                    Todos
                </button>
                <button class="portfolio-filter px-6 py-3 bg-gray-700 text-gray-300 rounded-full font-semibold hover:bg-blue-600 hover:text-white transition-all duration-300" data-filter="web">
                    Desarrollo Web
                </button>
                <button class="portfolio-filter px-6 py-3 bg-gray-700 text-gray-300 rounded-full font-semibold hover:bg-blue-600 hover:text-white transition-all duration-300" data-filter="mobile">
                    Aplicaciones Móviles
                </button>
                <button class="portfolio-filter px-6 py-3 bg-gray-700 text-gray-300 rounded-full font-semibold hover:bg-blue-600 hover:text-white transition-all duration-300" data-filter="saas">
                    SaaS & Cloud
                </button>
                <button class="portfolio-filter px-6 py-3 bg-gray-700 text-gray-300 rounded-full font-semibold hover:bg-blue-600 hover:text-white transition-all duration-300" data-filter="data">
                    Data Science
                </button>
            </div>

            <!-- Grid de Proyectos -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Proyecto 1: E-commerce -->
                <div class="portfolio-item" data-category="web">
                    <div class="bg-white rounded-xl overflow-hidden shadow-2xl transform hover:-translate-y-4 transition-all duration-500">
                        <div class="relative overflow-hidden">
                            <div class="w-full h-48 bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center">
                                <svg class="w-20 h-20 text-white" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                </svg>
                            </div>
                            <div class="absolute top-4 right-4">
                                <span class="px-3 py-1 bg-blue-600 text-white text-xs font-semibold rounded-full">Web</span>
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-800 mb-2">E-commerce Empresarial</h3>
                            <p class="text-gray-600 mb-4">Plataforma de comercio electrónico completa con gestión de inventario, pagos y analytics</p>
                            <div class="flex flex-wrap gap-2 mb-4">
                                <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded">Laravel</span>
                                <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded">Vue.js</span>
                                <span class="px-2 py-1 bg-purple-100 text-purple-800 text-xs rounded">MySQL</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <a href="#proyecto-ecommerce" class="text-blue-600 font-semibold hover:text-blue-800 transition">Ver Detalles →</a>
                                <div class="flex space-x-2">
                                    <a href="#demo-ecommerce" class="p-2 bg-blue-100 text-blue-600 rounded-lg hover:bg-blue-200 transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                        </svg>
                                    </a>
                                    <a href="#contacto" class="p-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Proyecto 2: App Móvil -->
                <div class="portfolio-item" data-category="mobile">
                    <div class="bg-white rounded-xl overflow-hidden shadow-2xl transform hover:-translate-y-4 transition-all duration-500">
                        <div class="relative overflow-hidden">
                            <div class="w-full h-48 bg-gradient-to-br from-green-500 to-teal-600 flex items-center justify-center">
                                <svg class="w-20 h-20 text-white" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div class="absolute top-4 right-4">
                                <span class="px-3 py-1 bg-green-600 text-white text-xs font-semibold rounded-full">Mobile</span>
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-800 mb-2">App de Gestión Empresarial</h3>
                            <p class="text-gray-600 mb-4">Aplicación móvil para gestión de inventario, ventas y reportes en tiempo real</p>
                            <div class="flex flex-wrap gap-2 mb-4">
                                <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded">React Native</span>
                                <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded">Node.js</span>
                                <span class="px-2 py-1 bg-orange-100 text-orange-800 text-xs rounded">MongoDB</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <a href="#proyecto-app" class="text-green-600 font-semibold hover:text-green-800 transition">Ver Detalles →</a>
                                <div class="flex space-x-2">
                                    <a href="#demo-app" class="p-2 bg-green-100 text-green-600 rounded-lg hover:bg-green-200 transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                        </svg>
                                    </a>
                                    <a href="#contacto" class="p-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Proyecto 3: SaaS -->
                <div class="portfolio-item" data-category="saas">
                    <div class="bg-white rounded-xl overflow-hidden shadow-2xl transform hover:-translate-y-4 transition-all duration-500">
                        <div class="relative overflow-hidden">
                            <div class="w-full h-48 bg-gradient-to-br from-purple-500 to-pink-600 flex items-center justify-center">
                                <svg class="w-20 h-20 text-white" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 15a4 4 0 004 4h10a4 4 0 100-8h-1.26A8 8 0 103 15z" />
                                </svg>
                            </div>
                            <div class="absolute top-4 right-4">
                                <span class="px-3 py-1 bg-purple-600 text-white text-xs font-semibold rounded-full">SaaS</span>
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-800 mb-2">Plataforma de Gestión CRM</h3>
                            <p class="text-gray-600 mb-4">Sistema SaaS completo para gestión de relaciones con clientes y ventas</p>
                            <div class="flex flex-wrap gap-2 mb-4">
                                <span class="px-2 py-1 bg-purple-100 text-purple-800 text-xs rounded">Laravel</span>
                                <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded">Vue.js</span>
                                <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded">AWS</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <a href="#proyecto-crm" class="text-purple-600 font-semibold hover:text-purple-800 transition">Ver Detalles →</a>
                                <div class="flex space-x-2">
                                    <a href="#demo-crm" class="p-2 bg-purple-100 text-purple-600 rounded-lg hover:bg-purple-200 transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                        </svg>
                                    </a>
                                    <a href="#contacto" class="p-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Proyecto 4: Data Science -->
                <div class="portfolio-item" data-category="data">
                    <div class="bg-white rounded-xl overflow-hidden shadow-2xl transform hover:-translate-y-4 transition-all duration-500">
                        <div class="relative overflow-hidden">
                            <div class="w-full h-48 bg-gradient-to-br from-cyan-500 to-blue-600 flex items-center justify-center">
                                <svg class="w-20 h-20 text-white" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10a2 2 0 01-2 2h-2a2 2 0 01-2-2zm0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                </svg>
                            </div>
                            <div class="absolute top-4 right-4">
                                <span class="px-3 py-1 bg-cyan-600 text-white text-xs font-semibold rounded-full">Data</span>
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-800 mb-2">Dashboard de Analytics</h3>
                            <p class="text-gray-600 mb-4">Sistema de análisis de datos con visualizaciones interactivas y reportes automáticos</p>
                            <div class="flex flex-wrap gap-2 mb-4">
                                <span class="px-2 py-1 bg-cyan-100 text-cyan-800 text-xs rounded">Python</span>
                                <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded">Power BI</span>
                                <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded">SQL</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <a href="#proyecto-analytics" class="text-cyan-600 font-semibold hover:text-cyan-800 transition">Ver Detalles →</a>
                                <div class="flex space-x-2">
                                    <a href="#demo-analytics" class="p-2 bg-cyan-100 text-cyan-600 rounded-lg hover:bg-cyan-200 transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                        </svg>
                                    </a>
                                    <a href="#contacto" class="p-2 bg-cyan-600 text-white rounded-lg hover:bg-cyan-700 transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Proyecto 5: Seguridad -->
                <div class="portfolio-item" data-category="web">
                    <div class="bg-white rounded-xl overflow-hidden shadow-2xl transform hover:-translate-y-4 transition-all duration-500">
                        <div class="relative overflow-hidden">
                            <div class="w-full h-48 bg-gradient-to-br from-red-500 to-orange-600 flex items-center justify-center">
                                <svg class="w-20 h-20 text-white" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <div class="absolute top-4 right-4">
                                <span class="px-3 py-1 bg-red-600 text-white text-xs font-semibold rounded-full">Security</span>
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-800 mb-2">Sistema de Auditoría</h3>
                            <p class="text-gray-600 mb-4">Plataforma de monitoreo y auditoría de seguridad para empresas</p>
                            <div class="flex flex-wrap gap-2 mb-4">
                                <span class="px-2 py-1 bg-red-100 text-red-800 text-xs rounded">Python</span>
                                <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded">Django</span>
                                <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded">PostgreSQL</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <a href="#proyecto-security" class="text-red-600 font-semibold hover:text-red-800 transition">Ver Detalles →</a>
                                <div class="flex space-x-2">
                                    <a href="#demo-security" class="p-2 bg-red-100 text-red-600 rounded-lg hover:bg-red-200 transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                        </svg>
                                    </a>
                                    <a href="#contacto" class="p-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Proyecto 6: Integración -->
                <div class="portfolio-item" data-category="saas">
                    <div class="bg-white rounded-xl overflow-hidden shadow-2xl transform hover:-translate-y-4 transition-all duration-500">
                        <div class="relative overflow-hidden">
                            <div class="w-full h-48 bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center">
                                <svg class="w-20 h-20 text-white" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                            </div>
                            <div class="absolute top-4 right-4">
                                <span class="px-3 py-1 bg-indigo-600 text-white text-xs font-semibold rounded-full">Integration</span>
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-800 mb-2">API de Integración</h3>
                            <p class="text-gray-600 mb-4">Sistema de APIs para conectar múltiples plataformas empresariales</p>
                            <div class="flex flex-wrap gap-2 mb-4">
                                <span class="px-2 py-1 bg-indigo-100 text-indigo-800 text-xs rounded">Laravel</span>
                                <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded">GraphQL</span>
                                <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded">Redis</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <a href="#proyecto-api" class="text-indigo-600 font-semibold hover:text-indigo-800 transition">Ver Detalles →</a>
                                <div class="flex space-x-2">
                                    <a href="#demo-api" class="p-2 bg-indigo-100 text-indigo-600 rounded-lg hover:bg-indigo-200 transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                        </svg>
                                    </a>
                                    <a href="#contacto" class="p-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CTA Portfolio -->
            <div class="text-center mt-16">
                <p class="text-xl text-blue-100 mb-8">¿Te gusta lo que ves? Podemos crear algo similar para tu empresa</p>
                <a href="#contacto" class="cta-primary inline-flex items-center justify-center px-10 py-4 bg-blue-600 text-white font-semibold rounded-lg shadow-lg hover:bg-blue-700 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 text-lg">
                    Solicitar Proyecto Similar
                    <svg class="w-6 h-6 ml-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- Ventajas -->
    <section id="ventajas" class="bg-white py-16">
        <div class="container mx-auto px-4">
            <h2 class="text-2xl font-bold text-center mb-8 text-blue-700">¿Por qué elegirnos?</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
                <div class="p-6 rounded-lg shadow hover:shadow-lg transition">
                    <h3 class="font-semibold text-lg mb-2 text-blue-600">Experiencia</h3>
                    <p>Más de 10 años desarrollando soluciones para empresas de todo el país y el mundo.</p>
                </div>
                <div class="p-6 rounded-lg shadow hover:shadow-lg transition">
                    <h3 class="font-semibold text-lg mb-2 text-blue-600">Soporte Personalizado</h3>
                    <p>Acompañamiento y asesoría en cada etapa de tu proyecto, desde la idea hasta la implementación.</p>
                </div>
                <div class="p-6 rounded-lg shadow hover:shadow-lg transition">
                    <h3 class="font-semibold text-lg mb-2 text-blue-600">Innovación</h3>
                    <p>Aplicamos las últimas tecnologías y metodologías para que tu negocio crezca seguro y escalable.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonios -->
    <section id="testimonios" class="py-20 bg-gradient-to-r from-blue-50 via-white to-cyan-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <span class="inline-block px-4 py-2 bg-blue-100 text-blue-800 rounded-full text-sm font-semibold mb-4">Testimonios</span>
                <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-6">Lo que dicen nuestros clientes</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">Descubre por qué empresas confían en nosotros para transformar sus negocios con tecnología</p>
            </div>

            <!-- Testimonios Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
                <!-- Testimonio 1 -->
                <div class="testimonial-card bg-white rounded-xl shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 p-8">
                    <div class="flex items-center mb-6">
                        <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center text-white font-bold text-xl mr-4">
                            JP
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800">Juan Pérez</h4>
                            <p class="text-blue-600 text-sm">CEO, Empresa X</p>
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="flex text-yellow-400 mb-2">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                        </div>
                    </div>
                    <p class="text-gray-600 italic leading-relaxed">
                        "El equipo de Infrasoft superó nuestras expectativas en cada etapa del proyecto. La comunicación fue excelente y los resultados superaron lo prometido."
                    </p>
                </div>

                <!-- Testimonio 2 -->
                <div class="testimonial-card bg-white rounded-xl shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 p-8">
                    <div class="flex items-center mb-6">
                        <div class="w-16 h-16 bg-gradient-to-br from-cyan-500 to-cyan-600 rounded-full flex items-center justify-center text-white font-bold text-xl mr-4">
                            MG
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800">María Gómez</h4>
                            <p class="text-cyan-600 text-sm">CTO, Startup Y</p>
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="flex text-yellow-400 mb-2">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                        </div>
                    </div>
                    <p class="text-gray-600 italic leading-relaxed">
                        "Excelente comunicación y resultados tangibles en poco tiempo. El equipo entendió perfectamente nuestras necesidades y las implementó de manera eficiente."
                    </p>
                </div>

                <!-- Testimonio 3 -->
                <div class="testimonial-card bg-white rounded-xl shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 p-8">
                    <div class="flex items-center mb-6">
                        <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-green-600 rounded-full flex items-center justify-center text-white font-bold text-xl mr-4">
                            CR
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800">Carlos Ruiz</h4>
                            <p class="text-green-600 text-sm">Gerente IT, Empresa Z</p>
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="flex text-yellow-400 mb-2">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                        </div>
                    </div>
                    <p class="text-gray-600 italic leading-relaxed">
                        "Recomiendo Infrasoft para cualquier empresa que busque innovación y calidad. Su enfoque en la excelencia técnica es evidente en cada proyecto."
                    </p>
                </div>
            </div>

            <!-- CTA Testimonios -->
            <div class="text-center">
                <p class="text-xl text-gray-600 mb-8">¿Quieres ser nuestro próximo caso de éxito?</p>
                <a href="#contacto" class="cta-primary inline-flex items-center justify-center px-8 py-4 bg-blue-600 text-white font-semibold rounded-lg shadow-lg hover:bg-blue-700 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    Comenzar Proyecto
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- Contacto -->
    <section id="contacto" class="py-20 bg-gradient-to-br from-gray-900 via-blue-900 to-gray-900 text-white">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <!-- Información de Contacto -->
                <div>
                    <div class="mb-8">
                        <span class="inline-block px-4 py-2 bg-blue-600 text-white rounded-full text-sm font-semibold mb-4">Contacto</span>
                        <h2 class="text-4xl md:text-5xl font-bold mb-6">Hablemos de tu proyecto</h2>
                        <p class="text-xl text-blue-100 leading-relaxed">
                            Estamos aquí para ayudarte a transformar tu idea en realidad. 
                            Cuéntanos sobre tu proyecto y te responderemos en menos de 24 horas.
                        </p>
                    </div>

                    <!-- Información de Contacto -->
                    <div class="space-y-6 mb-8">
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-white mb-1">Email</h4>
                                <p class="text-blue-200">info@infrasoft.com</p>
                            </div>
                        </div>

                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-white mb-1">Teléfono</h4>
                                <p class="text-blue-200">+54 9 387 220-4925</p>
                            </div>
                        </div>

                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-white mb-1">Ubicación</h4>
                                <p class="text-blue-200">Salta, Argentina</p>
                            </div>
                        </div>

                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-white mb-1">Horarios</h4>
                                <p class="text-blue-200">Lun - Vie: 9:00 - 18:00</p>
                            </div>
                        </div>
                    </div>

                    <!-- Redes Sociales -->
                    <div class="flex space-x-4">
                        <a href="https://www.facebook.com/infrasofts/" target="_blank" class="w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center hover:bg-blue-700 transition-all duration-300 transform hover:scale-110">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M22.675 0h-21.35C.595 0 0 .592 0 1.326v21.348C0 23.406.595 24 1.326 24h11.495v-9.294H9.691v-3.622h3.13V8.413c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.797.143v3.24l-1.918.001c-1.504 0-1.797.715-1.797 1.763v2.313h3.587l-.467 3.622h-3.12V24h6.116C23.406 24 24 23.406 24 22.674V1.326C24 .592 23.406 0 22.675 0"></path>
                            </svg>
                        </a>
                        <a href="https://twitter.com/infra_soft" target="_blank" class="w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center hover:bg-blue-700 transition-all duration-300 transform hover:scale-110">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 4.557a9.93 9.93 0 0 1-2.828.775 4.932 4.932 0 0 0 2.165-2.724c-.951.564-2.005.974-3.127 1.195a4.92 4.92 0 0 0-8.384 4.482C7.691 8.095 4.066 6.13 1.64 3.161c-.542.929-.856 2.01-.857 3.17 0 2.188 1.115 4.117 2.823 5.247a4.904 4.904 0 0 1-2.229-.616c-.054 2.281 1.581 4.415 3.949 4.89a4.936 4.936 0 0 1-2.224.084c.627 1.956 2.444 3.377 4.6 3.417A9.867 9.867 0 0 1 0 21.543a13.94 13.94 0 0 0 7.548 2.209c9.057 0 14.009-7.496 14.009-13.986 0-.213-.005-.425-.014-.636A9.936 9.936 0 0 0 24 4.557z"></path>
                            </svg>
                        </a>
                        <a href="https://api.whatsapp.com/send?phone=5493872204925&text=-Consultas-" target="_blank" class="w-12 h-12 bg-green-600 rounded-full flex items-center justify-center hover:bg-green-700 transition-all duration-300 transform hover:scale-110">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M20.52 3.48A11.93 11.93 0 0 0 12 0C5.37 0 0 5.37 0 12c0 2.11.55 4.16 1.6 5.97L0 24l6.18-1.62A11.94 11.94 0 0 0 12 24c6.63 0 12-5.37 12-12 0-3.19-1.24-6.19-3.48-8.52zM12 22c-1.85 0-3.68-.5-5.26-1.44l-.38-.22-3.67.96.98-3.58-.25-.37A9.94 9.94 0 0 1 2 12c0-5.52 4.48-10 10-10s10 4.48 10 10-4.48 10-10 10zm5.2-7.6c-.28-.14-1.65-.81-1.9-.9-.25-.09-.43-.14-.61.14-.18.28-.7.9-.86 1.08-.16.18-.32.2-.6.07-.28-.14-1.18-.44-2.25-1.4-.83-.74-1.39-1.65-1.55-1.93-.16-.28-.02-.43.12-.57.13-.13.28-.34.42-.51.14-.17.18-.29.28-.48.09-.19.05-.36-.02-.5-.07-.14-.61-1.47-.84-2.01-.22-.53-.45-.46-.61-.47-.16-.01-.35-.01-.54-.01-.19 0-.5.07-.76.34-.26.27-1 1-1 2.43 0 1.43 1.02 2.81 1.16 3 .14.19 2.01 3.07 4.88 4.19.68.29 1.21.46 1.62.59.68.22 1.3.19 1.79.12.55-.08 1.65-.67 1.88-1.32.23-.65.23-1.2.16-1.32-.07-.12-.25-.19-.53-.33z"></path>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Formulario de Contacto -->
                <div class="bg-white rounded-xl shadow-2xl p-8">
                    <h3 class="text-2xl font-bold text-gray-800 mb-6">Envíanos tu consulta</h3>
                    
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                            {{ session('success') }}
                        </div>
                    @endif
                    
                    @if($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                            <ul class="list-disc pl-5">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('contact.submit') }}" class="space-y-6">
                        @csrf
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Nombre *</label>
                                <input type="text" name="name" required value="{{ old('name') }}" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300"
                                       placeholder="Tu nombre completo">
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                                <input type="email" name="email" required value="{{ old('email') }}"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300"
                                       placeholder="tu@email.com">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Teléfono</label>
                            <input type="tel" name="phone" value="{{ old('phone') }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300"
                                   placeholder="+54 9 387 123-4567">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Empresa</label>
                            <input type="text" name="company" value="{{ old('company') }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300"
                                   placeholder="Nombre de tu empresa">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Servicio de Interés</label>
                            <select name="service" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300">
                                <option value="">Selecciona un servicio</option>
                                <option value="desarrollo" {{ old('service') == 'desarrollo' ? 'selected' : '' }}>Desarrollo de Software</option>
                                <option value="datascience" {{ old('service') == 'datascience' ? 'selected' : '' }}>Data Science & Analytics</option>
                                <option value="seguridad" {{ old('service') == 'seguridad' ? 'selected' : '' }}>Ciberseguridad</option>
                                <option value="saas" {{ old('service') == 'saas' ? 'selected' : '' }}>SaaS & Cloud</option>
                                <option value="consultoria" {{ old('service') == 'consultoria' ? 'selected' : '' }}>Consultoría IT</option>
                                <option value="otro" {{ old('service') == 'otro' ? 'selected' : '' }}>Otro</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Mensaje *</label>
                            <textarea name="message" required rows="4" 
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300 resize-none"
                                      placeholder="Cuéntanos sobre tu proyecto, necesidades o consulta...">{{ old('message') }}</textarea>
                        </div>

                        <div class="flex items-center">
                            <input type="checkbox" name="newsletter" id="newsletter" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                            <label for="newsletter" class="ml-2 text-sm text-gray-600">
                                Suscribirme al newsletter para recibir novedades tecnológicas
                            </label>
                        </div>

                        <button type="submit" class="w-full bg-blue-600 text-white font-semibold py-4 px-6 rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 transition-all duration-300 transform hover:-translate-y-1">
                            <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                            </svg>
                            Enviar Consulta
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Clientes -->
    <section id="clientes" class="py-12 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-2xl font-bold text-center mb-8 text-blue-700">Clientes que confían en nosotros</h2>
            <div class="flex flex-wrap justify-center items-center gap-8">
                <img src="/media/img/logo-cliente1.png" alt="Cliente 1" class="h-12">
                <img src="/media/img/logo-cliente2.png" alt="Cliente 2" class="h-12">
                <img src="/media/img/logo-cliente3.png" alt="Cliente 3" class="h-12">
            </div>
        </div>
    </section>

    <!-- CTA Final -->
    <section class="py-20 bg-gradient-to-r from-blue-600 via-blue-700 to-cyan-600 text-white">
        <div class="container mx-auto px-4 text-center">
            <div class="max-w-4xl mx-auto">
                <h2 class="text-4xl md:text-5xl font-bold mb-6">¿Listo para transformar tu negocio?</h2>
                <p class="text-xl text-blue-100 mb-8 leading-relaxed">
                    Únete a las empresas que ya están aprovechando la tecnología para crecer y competir en el mercado digital. 
                    Nuestro equipo está listo para ayudarte a alcanzar tus objetivos.
                </p>
                
                <div class="flex flex-col sm:flex-row gap-4 justify-center mb-12">
                    <a href="#contacto" class="cta-primary inline-flex items-center justify-center px-10 py-4 bg-white text-blue-600 font-semibold rounded-lg shadow-lg hover:bg-gray-100 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 text-lg">
                        Comenzar Ahora
                        <svg class="w-6 h-6 ml-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                    <a href="#portfolio" class="inline-flex items-center justify-center px-10 py-4 border-2 border-white text-white font-semibold rounded-lg hover:bg-white hover:text-blue-600 transition-all duration-300 text-lg">
                        Ver Portfolio
                        <svg class="w-6 h-6 ml-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </a>
                </div>
                
                <!-- Estadísticas -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    <div class="text-center">
                        <div class="text-3xl md:text-4xl font-bold text-white mb-2 counter" data-target="50">0</div>
                        <p class="text-blue-100">Proyectos Completados</p>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl md:text-4xl font-bold text-white mb-2 counter" data-target="30">0</div>
                        <p class="text-blue-100">Clientes Satisfechos</p>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl md:text-4xl font-bold text-white mb-2 counter" data-target="5">0</div>
                        <p class="text-blue-100">Años de Experiencia</p>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl md:text-4xl font-bold text-white mb-2 counter" data-target="99">0</div>
                        <p class="text-blue-100">% de Satisfacción</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-16">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
                <!-- Información de la Empresa -->
                <div class="lg:col-span-2">
                    <div class="mb-6">
                        <h3 class="text-2xl font-bold text-white mb-4">Infrasoft</h3>
                        <p class="text-gray-300 leading-relaxed mb-6">
                            Somos una empresa de desarrollo de software especializada en crear soluciones tecnológicas 
                            innovadoras que transforman negocios y potencian el crecimiento empresarial.
                        </p>
                        <div class="flex space-x-4">
                            <a href="https://www.facebook.com/infrasofts/" target="_blank" class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center hover:bg-blue-700 transition-all duration-300 transform hover:scale-110">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M22.675 0h-21.35C.595 0 0 .592 0 1.326v21.348C0 23.406.595 24 1.326 24h11.495v-9.294H9.691v-3.622h3.13V8.413c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.797.143v3.24l-1.918.001c-1.504 0-1.797.715-1.797 1.763v2.313h3.587l-.467 3.622h-3.12V24h6.116C23.406 24 24 23.406 24 22.674V1.326C24 .592 23.406 0 22.675 0"></path>
                                </svg>
                            </a>
                            <a href="https://twitter.com/infra_soft" target="_blank" class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center hover:bg-blue-700 transition-all duration-300 transform hover:scale-110">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 4.557a9.93 9.93 0 0 1-2.828.775 4.932 4.932 0 0 0 2.165-2.724c-.951.564-2.005.974-3.127 1.195a4.92 4.92 0 0 0-8.384 4.482C7.691 8.095 4.066 6.13 1.64 3.161c-.542.929-.856 2.01-.857 3.17 0 2.188 1.115 4.117 2.823 5.247a4.904 4.904 0 0 1-2.229-.616c-.054 2.281 1.581 4.415 3.949 4.89a4.936 4.936 0 0 1-2.224.084c.627 1.956 2.444 3.377 4.6 3.417A9.867 9.867 0 0 1 0 21.543a13.94 13.94 0 0 0 7.548 2.209c9.057 0 14.009-7.496 14.009-13.986 0-.213-.005-.425-.014-.636A9.936 9.936 0 0 0 24 4.557z"></path>
                                </svg>
                            </a>
                            <a href="https://api.whatsapp.com/send?phone=5493872204925&text=-Consultas-" target="_blank" class="w-10 h-10 bg-green-600 rounded-full flex items-center justify-center hover:bg-green-700 transition-all duration-300 transform hover:scale-110">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M20.52 3.48A11.93 11.93 0 0 0 12 0C5.37 0 0 5.37 0 12c0 2.11.55 4.16 1.6 5.97L0 24l6.18-1.62A11.94 11.94 0 0 0 12 24c6.63 0 12-5.37 12-12 0-3.19-1.24-6.19-3.48-8.52zM12 22c-1.85 0-3.68-.5-5.26-1.44l-.38-.22-3.67.96.98-3.58-.25-.37A9.94 9.94 0 0 1 2 12c0-5.52 4.48-10 10-10s10 4.48 10 10-4.48 10-10 10zm5.2-7.6c-.28-.14-1.65-.81-1.9-.9-.25-.09-.43-.14-.61.14-.18.28-.7.9-.86 1.08-.16.18-.32.2-.6.07-.28-.14-1.18-.44-2.25-1.4-.83-.74-1.39-1.65-1.55-1.93-.16-.28-.02-.43.12-.57.13-.13.28-.34.42-.51.14-.17.18-.29.28-.48.09-.19.05-.36-.02-.5-.07-.14-.61-1.47-.84-2.01-.22-.53-.45-.46-.61-.47-.16-.01-.35-.01-.54-.01-.19 0-.5.07-.76.34-.26.27-1 1-1 2.43 0 1.43 1.02 2.81 1.16 3 .14.19 2.01 3.07 4.88 4.19.68.29 1.21.46 1.62.59.68.22 1.3.19 1.79.12.55-.08 1.65-.67 1.88-1.32.23-.65.23-1.2.16-1.32-.07-.12-.25-.19-.53-.33z"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Servicios -->
                <div>
                    <h4 class="text-lg font-semibold text-white mb-4">Servicios</h4>
                    <ul class="space-y-2">
                        <li><a href="#servicio-desarrollo" class="text-gray-300 hover:text-white transition">Desarrollo de Software</a></li>
                        <li><a href="#servicio-datascience" class="text-gray-300 hover:text-white transition">Data Science</a></li>
                        <li><a href="#servicio-seguridad" class="text-gray-300 hover:text-white transition">Ciberseguridad</a></li>
                        <li><a href="#servicio-saas" class="text-gray-300 hover:text-white transition">SaaS & Cloud</a></li>
                        <li><a href="#consultoria" class="text-gray-300 hover:text-white transition">Consultoría IT</a></li>
                    </ul>
                </div>

                <!-- Enlaces Rápidos -->
                <div>
                    <h4 class="text-lg font-semibold text-white mb-4">Enlaces</h4>
                    <ul class="space-y-2">
                        <li><a href="#portfolio" class="text-gray-300 hover:text-white transition">Portfolio</a></li>
                        <li><a href="#testimonios" class="text-gray-300 hover:text-white transition">Testimonios</a></li>
                        <li><a href="#contacto" class="text-gray-300 hover:text-white transition">Contacto</a></li>
                        <li><a href="#blog" class="text-gray-300 hover:text-white transition">Blog</a></li>
                        <li><a href="#about" class="text-gray-300 hover:text-white transition">Sobre Nosotros</a></li>
                    </ul>
                </div>
            </div>

            <!-- Línea Separadora -->
            <div class="border-t border-gray-700 pt-8">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <div class="text-gray-400 text-sm mb-4 md:mb-0">
                        © 2024 Infrasoft. Todos los derechos reservados.
                    </div>
                    <div class="flex space-x-6 text-sm">
                        <a href="#privacy" class="text-gray-400 hover:text-white transition">Política de Privacidad</a>
                        <a href="#terms" class="text-gray-400 hover:text-white transition">Términos de Servicio</a>
                        <a href="#cookies" class="text-gray-400 hover:text-white transition">Cookies</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
@endsection

@push('scripts')
    <!-- SwiperJS JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <!-- Custom Hero Slider JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOM loaded, initializing slider...');
            
            // Verificar que Swiper esté disponible
            if (typeof Swiper === 'undefined') {
                console.error('Swiper library not loaded');
                return;
            }

            console.log('Swiper found, creating slider...');

            try {
                const swiper = new Swiper('.hero-swiper', {
                    // Configuración básica
                    loop: true,
                    speed: 1000,
                    grabCursor: true,
                    
                    // Efecto de transición
                    effect: 'fade',
                    fadeEffect: {
                        crossFade: true
                    },
                    
                    // Paginación
                    pagination: {
                        el: '.swiper-pagination',
                        clickable: true,
                    },
                    
                    // Navegación
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev',
                    },
                    
                    // Autoplay
                    autoplay: {
                        delay: 4000,
                        disableOnInteraction: false,
                    },
                    
                    // Navegación por teclado
                    keyboard: {
                        enabled: true,
                    },
                    
                    // Eventos
                    on: {
                        init: function() {
                            console.log('Hero slider initialized successfully');
                        },
                        slideChange: function() {
                            console.log('Slide changed to:', this.realIndex);
                        }
                    }
                });

                console.log('Hero slider is ready');
                
            } catch (error) {
                console.error('Error initializing hero slider:', error);
            }

            // Portfolio Filtering System
            initializePortfolioFilter();
        });

        // Portfolio Filtering Functionality
        function initializePortfolioFilter() {
            const filterButtons = document.querySelectorAll('.portfolio-filter');
            const portfolioItems = document.querySelectorAll('.portfolio-item');

            if (!filterButtons.length || !portfolioItems.length) {
                console.log('Portfolio elements not found');
                return;
            }

            console.log('Initializing portfolio filter system...');

            filterButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const filter = this.getAttribute('data-filter');
                    
                    // Update active button
                    filterButtons.forEach(btn => btn.classList.remove('active'));
                    this.classList.add('active');
                    
                    // Filter portfolio items
                    filterPortfolioItems(filter);
                });
            });

            function filterPortfolioItems(filter) {
                portfolioItems.forEach((item, index) => {
                    const category = item.getAttribute('data-category');
                    const shouldShow = filter === 'all' || category === filter;
                    
                    if (shouldShow) {
                        // Show item with animation
                        item.classList.remove('hidden');
                        item.style.animationDelay = `${index * 0.1}s`;
                        item.style.animation = 'fadeInUp 0.6s ease forwards';
                    } else {
                        // Hide item
                        item.classList.add('hidden');
                    }
                });

                // Log filtering action
                console.log(`Portfolio filtered by: ${filter}`);
            }

            // Initialize with 'all' filter
            filterPortfolioItems('all');
        }

        // Smooth Scrolling for Anchor Links
        function initializeSmoothScrolling() {
            const links = document.querySelectorAll('a[href^="#"]');
            
            links.forEach(link => {
                link.addEventListener('click', function(e) {
                    const href = this.getAttribute('href');
                    
                    if (href === '#') return;
                    
                    const target = document.querySelector(href);
                    if (target) {
                        e.preventDefault();
                        
                        const offsetTop = target.offsetTop - 100; // Account for header
                        
                        window.scrollTo({
                            top: offsetTop,
                            behavior: 'smooth'
                        });
                        
                        // Update URL without page jump
                        history.pushState(null, null, href);
                    }
                });
            });
        }

        // Initialize smooth scrolling when DOM is ready
        document.addEventListener('DOMContentLoaded', function() {
            initializeSmoothScrolling();
        });

        // Intersection Observer for Animations
        function initializeIntersectionObserver() {
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate-in');
                    }
                });
            }, observerOptions);

            // Observe elements for animation
            const animateElements = document.querySelectorAll('.service-section, .portfolio-item, .feature-item');
            animateElements.forEach(el => observer.observe(el));
        }

        // Initialize intersection observer when DOM is ready
        document.addEventListener('DOMContentLoaded', function() {
            initializeIntersectionObserver();
        });

        // Performance Optimization: Lazy Loading for Images
        function initializeLazyLoading() {
            if ('IntersectionObserver' in window) {
                const imageObserver = new IntersectionObserver((entries, observer) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            const img = entry.target;
                            img.src = img.dataset.src;
                            img.classList.remove('lazy');
                            imageObserver.unobserve(img);
                        }
                    });
                });

                const lazyImages = document.querySelectorAll('img[data-src]');
                lazyImages.forEach(img => imageObserver.observe(img));
            }
        }

        // Initialize lazy loading when DOM is ready
        document.addEventListener('DOMContentLoaded', function() {
            initializeLazyLoading();
        });

        // Animated Counter for Statistics
        function initializeCounters() {
            const counters = document.querySelectorAll('.counter');
            
            if (!counters.length) return;

            const observerOptions = {
                threshold: 0.5,
                rootMargin: '0px 0px -50px 0px'
            };

            const counterObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const counter = entry.target;
                        const target = parseInt(counter.getAttribute('data-target'));
                        const duration = 2000; // 2 seconds
                        const increment = target / (duration / 16); // 60fps
                        let current = 0;

                        const updateCounter = () => {
                            current += increment;
                            if (current < target) {
                                counter.textContent = Math.floor(current);
                                requestAnimationFrame(updateCounter);
                            } else {
                                counter.textContent = target;
                            }
                        };

                        updateCounter();
                        counterObserver.unobserve(counter);
                    }
                });
            }, observerOptions);

            counters.forEach(counter => counterObserver.observe(counter));
        }

        // Form Validation and Enhancement
        function initializeFormEnhancement() {
            const forms = document.querySelectorAll('form');
            
            forms.forEach(form => {
                const inputs = form.querySelectorAll('input, select, textarea');
                
                inputs.forEach(input => {
                    // Add focus effects
                    input.addEventListener('focus', function() {
                        this.parentElement.classList.add('focused');
                    });
                    
                    input.addEventListener('blur', function() {
                        this.parentElement.classList.remove('focused');
                        validateField(this);
                    });
                    
                    // Real-time validation
                    input.addEventListener('input', function() {
                        if (this.classList.contains('form-input-error')) {
                            validateField(this);
                        }
                    });
                });
                
                // Form submission enhancement
                form.addEventListener('submit', function(e) {
                    if (!validateForm(this)) {
                        e.preventDefault();
                        showFormErrors(this);
                    } else {
                        showFormSuccess(this);
                    }
                });
            });
        }

        // Field validation
        function validateField(field) {
            const value = field.value.trim();
            let isValid = true;
            let errorMessage = '';

            // Remove existing error states
            field.classList.remove('form-input-error', 'form-input-success');

            // Validation rules
            if (field.hasAttribute('required') && !value) {
                isValid = false;
                errorMessage = 'Este campo es requerido';
            } else if (field.type === 'email' && value) {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(value)) {
                    isValid = false;
                    errorMessage = 'Email inválido';
                }
            } else if (field.type === 'tel' && value) {
                const phoneRegex = /^[\+]?[0-9\s\-\(\)]+$/;
                if (!phoneRegex.test(value)) {
                    isValid = false;
                    errorMessage = 'Teléfono inválido';
                }
            }

            // Apply validation state
            if (isValid) {
                field.classList.add('form-input-success');
                removeFieldError(field);
            } else {
                field.classList.add('form-input-error');
                showFieldError(field, errorMessage);
            }

            return isValid;
        }

        // Form validation
        function validateForm(form) {
            const inputs = form.querySelectorAll('input[required], select[required], textarea[required]');
            let isValid = true;

            inputs.forEach(input => {
                if (!validateField(input)) {
                    isValid = false;
                }
            });

            return isValid;
        }

        // Show field error
        function showFieldError(field, message) {
            removeFieldError(field);
            
            const errorDiv = document.createElement('div');
            errorDiv.className = 'field-error text-red-500 text-sm mt-1';
            errorDiv.textContent = message;
            
            field.parentElement.appendChild(errorDiv);
        }

        // Remove field error
        function removeFieldError(field) {
            const existingError = field.parentElement.querySelector('.field-error');
            if (existingError) {
                existingError.remove();
            }
        }

        // Show form errors
        function showFormErrors(form) {
            const errorDiv = document.createElement('div');
            errorDiv.className = 'form-errors bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4';
            errorDiv.innerHTML = '<strong>Error:</strong> Por favor, corrige los errores en el formulario.';
            
            form.insertBefore(errorDiv, form.firstChild);
            
            setTimeout(() => {
                errorDiv.remove();
            }, 5000);
        }

        // Show form success
        function showFormSuccess(form) {
            const submitBtn = form.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            
            submitBtn.classList.add('btn-loading');
            submitBtn.disabled = true;
            
            // Simulate loading state
            setTimeout(() => {
                submitBtn.classList.remove('btn-loading');
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalText;
            }, 2000);
        }

        // Smooth reveal animations
        function initializeRevealAnimations() {
            const revealElements = document.querySelectorAll('.reveal-on-scroll');
            
            if (!revealElements.length) return;

            const revealObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('revealed');
                    }
                });
            }, {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            });

            revealElements.forEach(element => revealObserver.observe(element));
        }

        // Parallax effect for hero section
        function initializeParallax() {
            const heroSection = document.querySelector('.hero-bg');
            if (!heroSection) return;

            window.addEventListener('scroll', () => {
                const scrolled = window.pageYOffset;
                const rate = scrolled * -0.5;
                
                heroSection.style.transform = `translateY(${rate}px)`;
            });
        }

        // Initialize all functionality when DOM is ready
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Initializing all site functionality...');
            
            initializeCounters();
            initializeFormEnhancement();
            initializeRevealAnimations();
            initializeParallax();
            
            console.log('Site functionality initialized successfully');
        });

        // Performance optimization: Debounce scroll events
        function debounce(func, wait) {
            let timeout;
            return function executedFunction(...args) {
                const later = () => {
                    clearTimeout(timeout);
                    func(...args);
                };
                clearTimeout(timeout);
                timeout = setTimeout(later, wait);
            };
        }

        // Optimized scroll handler
        const optimizedScrollHandler = debounce(() => {
            // Handle scroll-based animations here
        }, 16); // ~60fps

        window.addEventListener('scroll', optimizedScrollHandler);

        // Service Worker registration for PWA capabilities
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
                navigator.serviceWorker.register('/sw.js')
                    .then((registration) => {
                        console.log('SW registered: ', registration);
                    })
                    .catch((registrationError) => {
                        console.log('SW registration failed: ', registrationError);
                    });
            });
        }
    </script>
@endpush