<?php

return [
    'servicios' => [
        'data-science' => [
            'nombre' => 'Data Science',
            'descripcion_corta' => 'Transformamos datos en decisiones estratégicas para tu negocio.',
            'descripcion_larga' => 'Ofrecemos servicios integrales de ciencia de datos: desde la recolección y limpieza de información hasta el desarrollo de modelos predictivos y dashboards interactivos. Ayudamos a empresas de todos los tamaños a tomar decisiones basadas en evidencia, identificar patrones de consumo, optimizar operaciones y anticipar tendencias del mercado.',
            'tecnologias' => [
                'Python', 'R', 'SQL', 'Tableau', 'Power BI', 'TensorFlow', 'Scikit-learn', 'Pandas', 'NumPy', 'Apache Spark',
            ],
            'icono' => 'fas fa-chart-line',
            'color' => '#10b981',
            'categoria' => 'analytics',
            'beneficios' => [
                'Dashboards en tiempo real con KPIs personalizados',
                'Modelos predictivos para ventas y demanda',
                'Automatización de reportes ejecutivos',
                'Integración con fuentes de datos existentes',
                'Capacitación del equipo en herramientas de BI',
            ],
            'incluye' => [
                'Relevamiento de fuentes de datos',
                'Diseño e implementación de pipelines ETL',
                'Desarrollo de dashboards interactivos',
                'Modelos de machine learning a medida',
                'Documentación y transferencia de conocimiento',
            ],
            'proceso' => [
                ['titulo' => 'Descubrimiento', 'descripcion' => 'Identificamos qué datos tiene su empresa y qué preguntas de negocio necesita responder.'],
                ['titulo' => 'Preparación', 'descripcion' => 'Limpiamos, transformamos e integramos datos de múltiples fuentes.'],
                ['titulo' => 'Análisis', 'descripcion' => 'Desarrollamos modelos y visualizaciones que revelan insights accionables.'],
                ['titulo' => 'Despliegue', 'descripcion' => 'Implementamos dashboards y automatizamos reportes para uso continuo.'],
            ],
        ],

        'desarrollo-software' => [
            'nombre' => 'Desarrollo de Software',
            'descripcion_corta' => 'Sistemas a medida, robustos y escalables para su empresa.',
            'descripcion_larga' => 'Diseñamos y desarrollamos aplicaciones web, sistemas de gestión, APIs y plataformas empresariales adaptadas a los procesos únicos de su organización. Utilizamos metodologías ágiles con entregas iterativas, pruebas automatizadas y documentación completa. Desde el relevamiento inicial hasta el mantenimiento post-lanzamiento.',
            'tecnologias' => [
                'PHP', 'Laravel', 'JavaScript', 'Vue.js', 'React', 'MySQL', 'PostgreSQL', 'Git', 'Docker', 'Redis',
            ],
            'icono' => 'fas fa-code',
            'color' => '#3b82f6',
            'categoria' => 'development',
            'beneficios' => [
                'Software 100% adaptado a sus procesos',
                'Arquitectura escalable y mantenible',
                'Integración con sistemas existentes (ERP, AFIP, pagos)',
                'Interfaz intuitiva diseñada para sus usuarios',
                'Código fuente y documentación incluidos',
            ],
            'incluye' => [
                'Relevamiento funcional y técnico',
                'Diseño UX/UI de pantallas',
                'Desarrollo frontend y backend',
                'Pruebas funcionales y de carga',
                'Capacitación y manual de usuario',
                '3 meses de soporte post-lanzamiento',
            ],
            'proceso' => [
                ['titulo' => 'Relevamiento', 'descripcion' => 'Entendemos su negocio, usuarios y requerimientos funcionales.'],
                ['titulo' => 'Diseño', 'descripcion' => 'Prototipamos interfaces y definimos la arquitectura técnica.'],
                ['titulo' => 'Desarrollo', 'descripcion' => 'Construimos en sprints de 2 semanas con demos regulares.'],
                ['titulo' => 'Entrega', 'descripcion' => 'Desplegamos en producción, capacitamos y brindamos soporte.'],
            ],
        ],

        'seguridad-informatica' => [
            'nombre' => 'Seguridad Informática',
            'descripcion_corta' => 'Protección integral de datos, sistemas y redes empresariales.',
            'descripcion_larga' => 'Brindamos servicios de ciberseguridad para proteger su empresa contra amenazas digitales. Realizamos auditorías de vulnerabilidades, pruebas de penetración, implementación de políticas de seguridad, monitoreo de redes y respuesta ante incidentes. Cumplimos con estándares OWASP y buenas prácticas de la industria.',
            'tecnologias' => [
                'Nmap', 'Wireshark', 'Metasploit', 'Burp Suite', 'Kali Linux', 'Snort', 'OpenVAS', 'Nessus', 'pfSense',
            ],
            'icono' => 'fas fa-shield-alt',
            'color' => '#ef4444',
            'categoria' => 'security',
            'beneficios' => [
                'Identificación proactiva de vulnerabilidades',
                'Cumplimiento normativo y auditorías',
                'Reducción del riesgo de filtración de datos',
                'Políticas de seguridad documentadas',
                'Capacitación en conciencia de seguridad',
            ],
            'incluye' => [
                'Escaneo de vulnerabilidades (interno y externo)',
                'Pruebas de penetración controladas',
                'Revisión de configuración de servidores',
                'Análisis de políticas de acceso y contraseñas',
                'Informe ejecutivo con plan de remediación',
                'Seguimiento post-auditoría',
            ],
            'proceso' => [
                ['titulo' => 'Evaluación', 'descripcion' => 'Mapeamos su infraestructura y superficie de ataque.'],
                ['titulo' => 'Pruebas', 'descripcion' => 'Ejecutamos escaneos y pruebas de penetración controladas.'],
                ['titulo' => 'Informe', 'descripcion' => 'Entregamos hallazgos priorizados por criticidad.'],
                ['titulo' => 'Remediación', 'descripcion' => 'Acompañamos la corrección de vulnerabilidades detectadas.'],
            ],
        ],

        'saas' => [
            'nombre' => 'SaaS y Soluciones en la Nube',
            'descripcion_corta' => 'Digitalice y escale su empresa con tecnología cloud.',
            'descripcion_larga' => 'Diseñamos, implementamos y administramos soluciones en la nube que permiten a su empresa operar con mayor flexibilidad, reducir costos de infraestructura y escalar según la demanda. Migración a AWS, Azure o Google Cloud, contenedorización con Docker/Kubernetes, CI/CD automatizado y monitoreo 24/7.',
            'tecnologias' => [
                'AWS', 'Azure', 'Google Cloud', 'Docker', 'Kubernetes', 'Terraform', 'Jenkins', 'GitLab CI/CD', 'Nginx',
            ],
            'icono' => 'fas fa-cloud',
            'color' => '#8b5cf6',
            'categoria' => 'cloud',
            'beneficios' => [
                'Reducción de costos de infraestructura on-premise',
                'Escalabilidad automática según demanda',
                'Alta disponibilidad (99.9% uptime)',
                'Backups automáticos y recuperación ante desastres',
                'Despliegues continuos sin tiempo de inactividad',
            ],
            'incluye' => [
                'Evaluación de infraestructura actual',
                'Diseño de arquitectura cloud',
                'Migración de servidores y bases de datos',
                'Configuración de CI/CD pipelines',
                'Monitoreo y alertas automatizadas',
                'Optimización continua de costos cloud',
            ],
            'proceso' => [
                ['titulo' => 'Assessment', 'descripcion' => 'Evaluamos su infraestructura y estimamos costos de migración.'],
                ['titulo' => 'Arquitectura', 'descripcion' => 'Diseñamos la solución cloud óptima para su caso.'],
                ['titulo' => 'Migración', 'descripcion' => 'Movemos servicios con mínimo downtime.'],
                ['titulo' => 'Operación', 'descripcion' => 'Monitoreamos, optimizamos y damos soporte continuo.'],
            ],
        ],
    ],

    'tecnologias_info' => [
        'PHP' => ['descripcion' => 'Lenguaje de programación del lado del servidor, ampliamente utilizado en aplicaciones web empresariales.', 'documentacion' => 'https://www.php.net/docs.php', 'categoria' => 'backend'],
        'Laravel' => ['descripcion' => 'Framework PHP elegante y expresivo, ideal para aplicaciones web robustas y escalables.', 'documentacion' => 'https://laravel.com/docs', 'categoria' => 'framework'],
        'Python' => ['descripcion' => 'Lenguaje versátil para data science, automatización y desarrollo backend.', 'documentacion' => 'https://docs.python.org/', 'categoria' => 'programming'],
        'Docker' => ['descripcion' => 'Plataforma de contenedores que estandariza el despliegue de aplicaciones.', 'documentacion' => 'https://docs.docker.com/', 'categoria' => 'devops'],
        'AWS' => ['descripcion' => 'Plataforma líder de servicios en la nube de Amazon Web Services.', 'documentacion' => 'https://aws.amazon.com/documentation/', 'categoria' => 'cloud'],
        'Vue.js' => ['descripcion' => 'Framework JavaScript progresivo para interfaces de usuario interactivas.', 'documentacion' => 'https://vuejs.org/guide/', 'categoria' => 'frontend'],
        'Power BI' => ['descripcion' => 'Herramienta de Microsoft para business intelligence y visualización de datos.', 'documentacion' => 'https://docs.microsoft.com/power-bi/', 'categoria' => 'analytics'],
    ],

    'categorias' => [
        'backend' => 'Backend Development',
        'frontend' => 'Frontend Development',
        'database' => 'Base de Datos',
        'devops' => 'DevOps & CI/CD',
        'cloud' => 'Cloud Computing',
        'security' => 'Seguridad',
        'analytics' => 'Analytics & Data',
        'framework' => 'Frameworks',
        'programming' => 'Lenguajes de Programación',
    ],

    'colores_categoria' => [
        'backend' => '#3b82f6',
        'frontend' => '#10b981',
        'database' => '#f59e0b',
        'devops' => '#8b5cf6',
        'cloud' => '#06b6d4',
        'security' => '#ef4444',
        'analytics' => '#84cc16',
        'framework' => '#f97316',
        'programming' => '#6366f1',
    ],
];
