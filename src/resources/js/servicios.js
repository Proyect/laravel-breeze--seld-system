/**
 * Funcionalidades específicas para la sección de servicios
 * Infrasoft - Servicios Informáticos
 */

class ServiciosManager {
    constructor() {
        this.init();
    }

    init() {
        this.setupEventListeners();
        this.initializeAnimations();
        this.setupTechnologyCards();
    }

    setupEventListeners() {
        // Event listeners para las tarjetas de tecnologías
        document.addEventListener('DOMContentLoaded', () => {
            this.setupTechnologyCardInteractions();
            this.setupScrollAnimations();
        });
    }

    setupTechnologyCardInteractions() {
        const technologyCards = document.querySelectorAll('.tecnologia-tarjeta');
        
        technologyCards.forEach(card => {
            // Efecto hover mejorado
            card.addEventListener('mouseenter', (e) => {
                this.enhanceCardHover(e.target);
            });

            card.addEventListener('mouseleave', (e) => {
                this.resetCardHover(e.target);
            });

            // Click para mostrar información adicional
            card.addEventListener('click', (e) => {
                this.showTechnologyInfo(e.target);
            });

            // Efecto de presión al hacer click
            card.addEventListener('mousedown', (e) => {
                this.addPressEffect(e.target);
            });

            card.addEventListener('mouseup', (e) => {
                this.removePressEffect(e.target);
            });
        });
    }

    enhanceCardHover(card) {
        card.style.transform = 'translateY(-4px) scale(1.02)';
        card.style.boxShadow = '0 20px 40px -10px rgba(59, 130, 246, 0.3)';
        card.style.borderColor = '#3b82f6';
        
        // Agregar efecto de brillo
        card.style.background = 'linear-gradient(135deg, #ffffff 0%, #f8fafc 100%)';
    }

    resetCardHover(card) {
        card.style.transform = 'translateY(0) scale(1)';
        card.style.boxShadow = '0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06)';
        card.style.borderColor = '#e5e7eb';
        card.style.background = '#ffffff';
    }

    addPressEffect(card) {
        card.style.transform = 'translateY(0) scale(0.98)';
        card.style.transition = 'all 0.1s ease-in-out';
    }

    removePressEffect(card) {
        card.style.transform = 'translateY(-4px) scale(1.02)';
        card.style.transition = 'all 0.2s ease-in-out';
    }

    showTechnologyInfo(card) {
        const technologyName = card.querySelector('.tecnologia-nombre').textContent;
        
        // Crear tooltip con información de la tecnología
        this.createTechnologyTooltip(card, technologyName);
        
        // Log para debugging
        console.log(`Tecnología seleccionada: ${technologyName}`);
    }

    createTechnologyTooltip(card, technologyName) {
        // Remover tooltip existente si hay uno
        const existingTooltip = document.querySelector('.technology-tooltip');
        if (existingTooltip) {
            existingTooltip.remove();
        }

        // Crear nuevo tooltip
        const tooltip = document.createElement('div');
        tooltip.className = 'technology-tooltip';
        tooltip.innerHTML = `
            <div class="tooltip-content">
                <h4>${technologyName}</h4>
                <p>Haz click para más información sobre esta tecnología</p>
            </div>
        `;

        // Estilos del tooltip
        tooltip.style.cssText = `
            position: absolute;
            background: #1f2937;
            color: white;
            padding: 0.75rem;
            border-radius: 0.5rem;
            font-size: 0.875rem;
            max-width: 200px;
            z-index: 1000;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            opacity: 0;
            transform: translateY(10px);
            transition: all 0.3s ease;
        `;

        // Posicionar tooltip
        const cardRect = card.getBoundingClientRect();
        tooltip.style.left = `${cardRect.left + (cardRect.width / 2) - 100}px`;
        tooltip.style.top = `${cardRect.bottom + 10}px`;

        // Agregar al DOM
        document.body.appendChild(tooltip);

        // Animar entrada
        setTimeout(() => {
            tooltip.style.opacity = '1';
            tooltip.style.transform = 'translateY(0)';
        }, 10);

        // Remover tooltip después de 3 segundos
        setTimeout(() => {
            if (tooltip.parentNode) {
                tooltip.style.opacity = '0';
                tooltip.style.transform = 'translateY(10px)';
                setTimeout(() => tooltip.remove(), 300);
            }
        }, 3000);
    }

    initializeAnimations() {
        // Configurar Intersection Observer para animaciones de scroll
        if ('IntersectionObserver' in window) {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate-in');
                    }
                });
            }, {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            });

            // Observar elementos que necesitan animación
            const animatedElements = document.querySelectorAll('.tecnologias-seccion, .tecnologia-tarjeta');
            animatedElements.forEach(el => observer.observe(el));
        }
    }

    setupScrollAnimations() {
        // Efecto parallax sutil para el fondo
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            const parallaxElements = document.querySelectorAll('.tecnologias-seccion');
            
            parallaxElements.forEach(element => {
                const speed = 0.5;
                element.style.transform = `translateY(${scrolled * speed}px)`;
            });
        });
    }

    // Método para agregar nuevas tecnologías dinámicamente
    addTechnology(technologyName) {
        const grid = document.querySelector('.tecnologias-grid');
        if (!grid) return;

        const newCard = document.createElement('div');
        newCard.className = 'tecnologia-tarjeta';
        newCard.innerHTML = `<span class="tecnologia-nombre">${technologyName}</span>`;
        
        // Agregar con animación
        newCard.style.opacity = '0';
        newCard.style.transform = 'translateY(20px)';
        
        grid.appendChild(newCard);
        
        // Animar entrada
        setTimeout(() => {
            newCard.style.transition = 'all 0.6s ease-out';
            newCard.style.opacity = '1';
            newCard.style.transform = 'translateY(0)';
        }, 100);

        // Configurar eventos para la nueva tarjeta
        this.setupTechnologyCardInteractions();
    }

    // Método para obtener estadísticas de uso
    getUsageStats() {
        const technologyCards = document.querySelectorAll('.tecnologia-tarjeta');
        const totalTechnologies = technologyCards.length;
        
        return {
            total: totalTechnologies,
            visible: Array.from(technologyCards).filter(card => {
                const rect = card.getBoundingClientRect();
                return rect.top >= 0 && rect.bottom <= window.innerHeight;
            }).length
        };
    }
}

// Inicializar cuando el DOM esté listo
document.addEventListener('DOMContentLoaded', () => {
    window.serviciosManager = new ServiciosManager();
    
    // Exponer métodos útiles globalmente
    window.addTechnology = (name) => window.serviciosManager.addTechnology(name);
    window.getUsageStats = () => window.serviciosManager.getUsageStats();
});

// Exportar para uso en módulos
if (typeof module !== 'undefined' && module.exports) {
    module.exports = ServiciosManager;
} 