<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Configuración de Servicios
    |--------------------------------------------------------------------------
    |
    | Aquí puedes configurar todos los servicios disponibles y sus tecnologías
    | asociadas. Esto facilita el mantenimiento y la actualización del contenido.
    |
    */

    'servicios' => [
        'data-science' => [
            'nombre' => 'Data Science',
            'descripcion_larga' => 'Analítica avanzada, dashboards y modelos predictivos para potenciar tu negocio. Transformamos datos en decisiones.',
            'tecnologias' => [
                'Python', 'R', 'SQL', 'Tableau', 'Power BI', 'TensorFlow', 'Scikit-learn', 'Pandas', 'NumPy'
            ],
            'icono' => 'fas fa-chart-line',
            'color' => '#10b981',
            'categoria' => 'analytics'
        ],
        
        'desarrollo-software' => [
            'nombre' => 'Desarrollo de Software',
            'descripcion_larga' => 'Creamos sistemas a medida, robustos y escalables para empresas y emprendedores. Integramos procesos, automatizamos tareas y potenciamos tu negocio.',
            'tecnologias' => [
                'PHP', 'Laravel', 'CodeIgniter', 'JavaScript', 'Vue.js', 'React', 'MySQL', 'PostgreSQL', 'Git', 'Docker'
            ],
            'icono' => 'fas fa-code',
            'color' => '#3b82f6',
            'categoria' => 'development'
        ],
        
        'seguridad-informatica' => [
            'nombre' => 'Seguridad Informática',
            'descripcion_larga' => 'Protege tus datos y sistemas con auditorías, consultoría y soluciones de ciberseguridad.',
            'tecnologias' => [
                'Nmap', 'Wireshark', 'Metasploit', 'Burp Suite', 'Kali Linux', 'Snort', 'OpenVAS', 'Nessus'
            ],
            'icono' => 'fas fa-shield-alt',
            'color' => '#ef4444',
            'categoria' => 'security'
        ],
        
        'saas' => [
            'nombre' => 'SaaS y Soluciones en la Nube',
            'descripcion_larga' => 'Implementación y venta de servicios SaaS para digitalizar y escalar tu empresa.',
            'tecnologias' => [
                'AWS', 'Azure', 'Google Cloud', 'Docker', 'Kubernetes', 'Terraform', 'Jenkins', 'GitLab CI/CD'
            ],
            'icono' => 'fas fa-cloud',
            'color' => '#8b5cf6',
            'categoria' => 'cloud'
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Configuración de Tecnologías
    |--------------------------------------------------------------------------
    |
    | Configuración específica para cada tecnología, incluyendo descripciones,
    | enlaces de documentación y categorías.
    |
    */

    'tecnologias_info' => [
        'PHP' => [
            'descripcion' => 'Lenguaje de programación del lado del servidor',
            'documentacion' => 'https://www.php.net/docs.php',
            'categoria' => 'backend'
        ],
        'Laravel' => [
            'descripcion' => 'Framework PHP elegante y expresivo',
            'documentacion' => 'https://laravel.com/docs',
            'categoria' => 'framework'
        ],
        'Python' => [
            'descripcion' => 'Lenguaje de programación versátil para data science',
            'documentacion' => 'https://docs.python.org/',
            'categoria' => 'programming'
        ],
        'Docker' => [
            'descripcion' => 'Plataforma de contenedores para desarrollo',
            'documentacion' => 'https://docs.docker.com/',
            'categoria' => 'devops'
        ],
        'AWS' => [
            'descripcion' => 'Servicios en la nube de Amazon',
            'documentacion' => 'https://aws.amazon.com/documentation/',
            'categoria' => 'cloud'
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Configuración de Categorías
    |--------------------------------------------------------------------------
    |
    | Categorías para organizar las tecnologías y servicios.
    |
    */

    'categorias' => [
        'backend' => 'Backend Development',
        'frontend' => 'Frontend Development',
        'database' => 'Base de Datos',
        'devops' => 'DevOps & CI/CD',
        'cloud' => 'Cloud Computing',
        'security' => 'Seguridad',
        'analytics' => 'Analytics & Data',
        'framework' => 'Frameworks',
        'programming' => 'Lenguajes de Programación'
    ],

    /*
    |--------------------------------------------------------------------------
    | Configuración de Colores por Categoría
    |--------------------------------------------------------------------------
    |
    | Colores específicos para cada categoría de tecnología.
    |
    */

    'colores_categoria' => [
        'backend' => '#3b82f6',
        'frontend' => '#10b981',
        'database' => '#f59e0b',
        'devops' => '#8b5cf6',
        'cloud' => '#06b6d4',
        'security' => '#ef4444',
        'analytics' => '#84cc16',
        'framework' => '#f97316',
        'programming' => '#6366f1'
    ],
]; 