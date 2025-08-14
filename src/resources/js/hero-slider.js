/**
 * Hero Slider Configuration
 * Configuración del slider principal del hero
 */
class HeroSlider {
    constructor() {
        this.swiper = null;
        this.init();
    }

    init() {
        // Esperar a que el DOM esté listo
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', () => this.createSwiper());
        } else {
            this.createSwiper();
        }
    }

    createSwiper() {
        const heroSwiperElement = document.querySelector('.hero-swiper');
        
        if (!heroSwiperElement) {
            console.warn('Hero slider element not found');
            return;
        }

        // Verificar que Swiper esté disponible
        if (typeof Swiper === 'undefined') {
            console.error('Swiper library not loaded');
            return;
        }

        try {
            this.swiper = new Swiper('.hero-swiper', {
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
                    dynamicBullets: true,
                },
                
                // Autoplay
                autoplay: {
                    delay: 4000,
                    disableOnInteraction: false,
                    pauseOnMouseEnter: true,
                },
                
                // Navegación por teclado
                keyboard: {
                    enabled: true,
                    onlyInViewport: true,
                },
                
                // Deshabilitar scroll del mouse
                mousewheel: false,
                
                // Breakpoints responsivos
                breakpoints: {
                    640: {
                        autoplay: {
                            delay: 5000,
                        }
                    },
                    1024: {
                        autoplay: {
                            delay: 6000,
                        }
                    }
                },
                
                // Eventos
                on: {
                    init: () => this.onSliderInit(),
                    slideChange: () => this.onSlideChange(),
                    beforeDestroy: () => this.onBeforeDestroy(),
                }
            });

            console.log('Hero slider initialized successfully');
            
        } catch (error) {
            console.error('Error initializing hero slider:', error);
        }
    }

    onSliderInit() {
        // Agregar clase para animaciones CSS
        const heroSection = document.querySelector('.hero-swiper');
        if (heroSection) {
            heroSection.classList.add('slider-ready');
        }
        
        // Log de inicialización
        console.log('Hero slider is ready');
    }

    onSlideChange() {
        // Aquí puedes agregar lógica adicional cuando cambie el slide
        // Por ejemplo, cambiar el título de la página, analytics, etc.
    }

    onBeforeDestroy() {
        // Cleanup antes de destruir
        if (this.swiper) {
            this.swiper.destroy(true, true);
            this.swiper = null;
        }
    }

    // Métodos públicos para control externo
    next() {
        if (this.swiper) this.swiper.slideNext();
    }

    prev() {
        if (this.swiper) this.swiper.slidePrev();
    }

    goTo(index) {
        if (this.swiper) this.swiper.slideTo(index);
    }

    startAutoplay() {
        if (this.swiper) this.swiper.autoplay.start();
    }

    stopAutoplay() {
        if (this.swiper) this.swiper.autoplay.stop();
    }

    destroy() {
        this.onBeforeDestroy();
    }
}

// Inicializar el slider cuando se cargue la página
document.addEventListener('DOMContentLoaded', () => {
    window.heroSlider = new HeroSlider();
});

// Exportar para uso en otros módulos (si es necesario)
if (typeof module !== 'undefined' && module.exports) {
    module.exports = HeroSlider;
} 