<?php

return [
    'articulos' => [
        'laravel-proximo-proyecto-web' => [
            'titulo' => 'Por qué elegir Laravel para tu próximo proyecto web',
            'resumen' => 'Descubre las ventajas del framework PHP más popular del mundo: seguridad integrada, ecosistema robusto y time-to-market reducido para PyMEs.',
            'categoria' => 'Desarrollo',
            'fecha' => '15 Ene 2026',
            'color' => 'blue',
            'contenido' => [
                'Laravel se consolidó como el framework PHP preferido para empresas que necesitan lanzar productos digitales con rapidez sin sacrificar calidad. Su arquitectura MVC, convenciones claras y documentación extensa permiten que equipos pequeños entreguen funcionalidades complejas en plazos acotados.',
                'Para PyMEs argentinas, Laravel ofrece ventajas concretas: autenticación lista para usar (como Breeze o Fortify), protección CSRF y validación de formularios, migraciones de base de datos versionadas y un ecosistema de paquetes que cubre pagos, colas, notificaciones y más.',
                'En Infrasoft utilizamos Laravel en proyectos de gestión comercial, portales de clientes y APIs REST. La curva de aprendizaje es razonable y el código resultante es mantenible a largo plazo, lo que reduce costos de soporte y evolución.',
                'Si estás evaluando tecnologías para un nuevo sistema web, Laravel es una opción sólida cuando buscás equilibrio entre velocidad de desarrollo, seguridad y escalabilidad.',
            ],
        ],
        'amenazas-ciberneticas-pymes-2026' => [
            'titulo' => '5 amenazas cibernéticas que toda PyME debe conocer en 2026',
            'resumen' => 'Ransomware, phishing dirigido y vulnerabilidades en APIs: las principales amenazas del año y cómo proteger tu empresa sin grandes inversiones.',
            'categoria' => 'Seguridad',
            'fecha' => '3 Ene 2026',
            'color' => 'red',
            'contenido' => [
                'Las PyMEs son cada vez más objetivo de ataques porque muchas veces carecen de políticas de seguridad formales. En 2026, las cinco amenazas más frecuentes son: ransomware, phishing por correo, credenciales robadas, software sin actualizar y APIs expuestas sin autenticación adecuada.',
                'El ransomware bloquea archivos críticos y exige un rescate. La prevención incluye copias de seguridad automáticas, segmentación de red y capacitación del personal para no abrir enlaces sospechosos.',
                'El phishing dirigido (spear phishing) imita proveedores o clientes conocidos. Implementar autenticación de dos factores (2FA) en correo y sistemas internos reduce drásticamente el riesgo de acceso no autorizado.',
                'Mantener sistemas operativos, frameworks y plugins actualizados cierra vulnerabilidades conocidas. En Infrasoft recomendamos auditorías periódicas y monitoreo básico sin necesidad de invertir en infraestructura enterprise desde el primer día.',
            ],
        ],
        'migrar-empresa-nube-paso-a-paso' => [
            'titulo' => 'Guía práctica: migrar tu empresa a la nube paso a paso',
            'resumen' => 'Desde la evaluación inicial hasta la migración de datos: un roadmap claro para digitalizar tu infraestructura con AWS, Azure o Google Cloud.',
            'categoria' => 'Cloud',
            'fecha' => '20 Dic 2025',
            'color' => 'cyan',
            'contenido' => [
                'Migrar a la nube no significa mover todo de un día para el otro. El proceso recomendado comienza con un inventario de aplicaciones, bases de datos y dependencias, seguido de una clasificación por criticidad y complejidad.',
                'La fase de evaluación define qué puede ir a infraestructura como servicio (IaaS), qué conviene como plataforma (PaaS) y qué debe permanecer on-premise temporalmente. Herramientas como AWS Migration Hub o Azure Migrate ayudan a estimar costos y tiempos.',
                'La migración de datos requiere ventanas de mantenimiento planificadas, pruebas de integridad y un plan de rollback. Para aplicaciones web, suele ser viable un enfoque por etapas: primero entornos de desarrollo y staging, luego producción con tráfico gradual.',
                'En Infrasoft acompañamos a PyMEs en assessments cloud, diseño de arquitectura y ejecución de la migración con proveedores como AWS, Azure y Google Cloud, priorizando continuidad operativa y control de costos.',
            ],
        ],
        'dashboards-bi-decisiones' => [
            'titulo' => 'Cómo los dashboards de BI pueden transformar tu toma de decisiones',
            'resumen' => 'Power BI y Tableau no son solo para grandes corporaciones. Te mostramos cómo una PyME puede visualizar sus datos y tomar decisiones basadas en evidencia.',
            'categoria' => 'Data Science',
            'fecha' => '5 Dic 2025',
            'color' => 'purple',
            'contenido' => [
                'Muchas PyMEs acumulan datos en planillas, sistemas de facturación y CRM sin explotarlos. Un dashboard de Business Intelligence centraliza indicadores clave (ventas, stock, morosidad, conversión) en una vista actualizada.',
                'Power BI y Tableau permiten conectar fuentes heterogéneas: Excel, bases SQL, Google Analytics y APIs. Con modelos simples, un gerente puede filtrar por período, sucursal o producto sin depender del área de sistemas.',
                'Los beneficios son tangibles: detectar productos de baja rotación, anticipar quiebres de stock, medir el retorno de campañas de marketing y comparar metas vs. resultados en tiempo casi real.',
                'No hace falta un data warehouse complejo para empezar. En Infrasoft diseñamos soluciones de BI escalables: comenzamos con los KPIs que más impacto tienen en el negocio y evolucionamos según la madurez de datos de la empresa.',
            ],
        ],
        'facturacion-electronica-afip' => [
            'titulo' => 'Facturación electrónica AFIP: todo lo que tu empresa necesita saber',
            'resumen' => 'Obligaciones, plazos y cómo implementar un sistema de facturación electrónica integrado con tu gestión comercial.',
            'categoria' => 'Negocios',
            'fecha' => '18 Nov 2025',
            'color' => 'green',
            'contenido' => [
                'La facturación electrónica en Argentina está regulada por AFIP y aplica a la mayoría de los contribuyentes según su categoría y facturación. Emitir comprobantes válidos implica usar un sistema autorizado o integrarse vía web services con el organismo.',
                'Los puntos clave son: tipo de comprobante (A, B, C, etc.), condición frente al IVA del emisor y receptor, numeración correlativa y conservación de registros durante el plazo legal.',
                'Integrar la facturación con un ERP o sistema de gestión evita doble carga de datos: al confirmar una venta, el comprobante se genera automáticamente y se envía al cliente por correo con el CAE correspondiente.',
                'En Infrasoft desarrollamos e integramos módulos de facturación electrónica adaptados a PyMEs, conectados con procesos de ventas, stock y cobranzas para cumplir normativa sin fricción operativa.',
            ],
        ],
        'inteligencia-artificial-pymes-2026' => [
            'titulo' => 'Inteligencia Artificial para PyMEs: oportunidades reales en 2026',
            'resumen' => 'Más allá del hype: casos de uso concretos de IA que una pequeña empresa puede implementar hoy para automatizar procesos y mejorar la atención al cliente.',
            'categoria' => 'Tendencias',
            'fecha' => '1 Nov 2025',
            'color' => 'amber',
            'contenido' => [
                'La inteligencia artificial dejó de ser exclusiva de grandes tecnológicas. En 2026, las PyMEs pueden adoptar IA en chatbots de atención, clasificación automática de consultas, extracción de datos de documentos y asistentes internos para búsqueda en bases de conocimiento.',
                'Un caso de uso accesible es el chatbot en el sitio web o WhatsApp Business: responde preguntas frecuentes, deriva casos complejos a un humano y opera 24/7 sin ampliar plantilla.',
                'Otra aplicación práctica es la automatización de reportes: modelos que resumen ventas semanales, detectan anomalías en facturación o sugieren acciones según histórico de clientes.',
                'La clave es empezar con un problema concreto y medible. En Infrasoft evaluamos qué procesos de tu empresa se benefician de IA sin requerir inversiones desproporcionadas, priorizando retorno rápido y datos que ya tenés disponibles.',
            ],
        ],
    ],
];
