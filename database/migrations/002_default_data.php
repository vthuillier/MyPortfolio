<?php

// Insert default settings
$settings = [
    ['site_title', 'Valentin Thuillier'],
    ['user_name', 'Valentin Thuillier'],
    ['user_job', 'Développeur DevOps & Sapeur-Pompier Volontaire'],
    ['user_job_en', 'DevOps Developer & Volunteer Firefighter'],
    ['site_bio', 'Passionné par le Machine Learning, l\'Innovation & le Code.'],
    ['site_bio_en', 'Passionate about Machine Learning, Innovation & Code.'],
    ['is_available', '1'],
    ['social_linkedin', 'https://www.linkedin.com/in/luxferrevt/'],
    ['social_github', 'https://github.com/vthuillier/'],
    ['social_cv', 'https://valentin-thuillier.fr/CV-Valentin_THUILLIER.pdf'],
    [
        'about_text',
        'Diplômé d\'un BUT Informatique et expert en infrastructure cloud et automatisation. Passionné par l\'innovation et le code, j\'allie mes compétences techniques à mon engagement de sapeur-pompier volontaire, ce qui me confère une grande fiabilité et une expertise en gestion de crise et travail sous pression.'
    ],
    [
        'about_text_en',
        'Graduated with a BUT in Computer Science and expert in cloud infrastructure and automation. Passionate about innovation and code, I combine my technical skills with my commitment as a volunteer firefighter, which gives me great reliability and expertise in crisis management and working under pressure.'
    ],
    ['hero_image', ''],
    ['about_exp1_title', 'Automation'],
    ['about_exp1_title_en', 'Automation'],
    ['about_exp1_tags', 'CI/CD, Docker, Kubernetes, Ansible'],
    ['about_exp1_tags_en', 'CI/CD, Docker, Kubernetes, Ansible'],
    ['about_exp2_title', 'Rescue Ops'],
    ['about_exp2_title_en', 'Rescue Ops'],
    ['about_exp2_tags', 'Crisis Management, Courage & Dedication'],
    ['about_exp2_tags_en', 'Crisis Management, Courage & Dedication'],
];

foreach ($settings as $s) {
    if ($driver === 'mysql') {
        $stmt = $db->prepare("INSERT IGNORE INTO settings (setting_key, value) VALUES (?, ?)");
    } else {
        // Postgres and SQLite handle ON CONFLICT
        $stmt = $db->prepare("INSERT INTO settings (setting_key, value) VALUES (?, ?) ON CONFLICT (setting_key) DO NOTHING");
    }
    $stmt->execute($s);
}

// Default Projects
$stmt = $db->query("SELECT COUNT(*) FROM projects");
if ($stmt->fetchColumn() == 0) {
    $projects = [
        [
            'title' => 'Infrastructures Cloud & Kubernetes',
            'title_en' => 'Cloud & Kubernetes Infrastructures',
            'description' => 'Optimisation et déploiement d\'architectures cloud-native avec focus sur la scalabilité et la haute disponibilité.',
            'description_en' => 'Optimization and deployment of cloud-native architectures with a focus on scalability and high availability.',
            'image_url' => 'https://images.unsplash.com/photo-1667372393119-3d4c48d07fc9?auto=format&fit=crop&q=80&w=800',
            'category' => 'DevOps',
            'project_link' => 'https://github.com/vthuillier/'
        ],
        [
            'title' => 'GitLab CI/CD & Automation',
            'title_en' => 'GitLab CI/CD & Automation',
            'description' => 'Mise en place de pipelines complets pour l\'intégration et le déploiement continu (Ansible, Jenkins).',
            'description_en' => 'Implementation of complete pipelines for continuous integration and deployment (Ansible, Jenkins).',
            'image_url' => 'https://images.unsplash.com/photo-1618401471353-b98aadebc25a?auto=format&fit=crop&q=80&w=800',
            'category' => 'Automation',
            'project_link' => 'https://github.com/vthuillier/'
        ],
        [
            'title' => 'Database Management (PostgreSQL/MongoDB)',
            'title_en' => 'Database Management (PostgreSQL/MongoDB)',
            'description' => 'Administration et optimisation de bases de données relationnelles et NoSQL pour des applications critiques.',
            'description_en' => 'Administration and optimization of relational and NoSQL databases for critical applications.',
            'image_url' => 'https://images.unsplash.com/photo-1544383835-bda2bc66a55d?auto=format&fit=crop&q=80&w=800',
            'category' => 'Infrastructure',
            'project_link' => 'https://github.com/vthuillier/'
        ]
    ];
    foreach ($projects as $p) {
        $stmt = $db->prepare("INSERT INTO projects (title, title_en, description, description_en, image_url, category, project_link) VALUES (:title, :title_en, :description, :description_en, :image_url, :category, :project_link)");
        $stmt->execute($p);
    }
}

// Default Timeline
$stmt = $db->query("SELECT COUNT(*) FROM timeline");
if ($stmt->fetchColumn() == 0) {
    $timeline = [
        [
            'type' => 'experience',
            'title' => 'Sapeur-Pompier Volontaire',
            'title_en' => 'Volunteer Firefighter',
            'organization' => 'SDIS 59',
            'organization_en' => 'SDIS 59',
            'period' => '2022 - Présent',
            'period_en' => '2022 - Present',
            'description' => 'Gestion de crise, leadership opérationnel et secours à personnes.',
            'description_en' => 'Crisis management, operational leadership and personal rescue.',
            'order_index' => 1
        ],
        [
            'type' => 'experience',
            'title' => 'Alternant DevOps',
            'title_en' => 'DevOps Apprentice',
            'organization' => 'Extern-SN',
            'organization_en' => 'Extern-SN',
            'period' => '2022 - 2024',
            'period_en' => '2022 - 2024',
            'description' => 'Spécialisation dans l\'automatisation des infrastructures et pipelines CI/CD.',
            'description_en' => 'Specialization in infrastructure automation and CI/CD pipelines.',
            'order_index' => 2
        ],
        [
            'type' => 'education',
            'title' => 'BUT Informatique',
            'title_en' => 'BUT in Computer Science',
            'organization' => 'IUT de Lille',
            'organization_en' => 'University of Lille',
            'period' => '2021 - 2024',
            'period_en' => '2021 - 2024',
            'description' => 'Expertise en développement logiciel et gestion de systèmes.',
            'description_en' => 'Expertise in software development and systems management.',
            'order_index' => 3
        ]
    ];
    foreach ($timeline as $t) {
        $stmt = $db->prepare("INSERT INTO timeline (type, title, title_en, organization, organization_en, period, period_en, description, description_en, order_index) VALUES (:type, :title, :title_en, :organization, :organization_en, :period, :period_en, :description, :description_en, :order_index)");
        $stmt->execute($t);
    }
}

// Default Skills
$stmt = $db->query("SELECT COUNT(*) FROM skills");
if ($stmt->fetchColumn() == 0) {
    $skills = [
        ['DevOps & CI/CD', 'DevOps & CI/CD', 'GitLab CI', 90, 1],
        ['DevOps & CI/CD', 'DevOps & CI/CD', 'Jenkins', 85, 2],
        ['DevOps & CI/CD', 'DevOps & CI/CD', 'Ansible', 80, 3],
        ['DevOps & CI/CD', 'DevOps & CI/CD', 'Docker/K8s', 75, 4],
        ['DevOps & CI/CD', 'DevOps & CI/CD', 'IaC', 80, 5],
        ['Databases & Ops', 'Databases & Ops', 'PostgreSQL', 85, 6],
        ['Databases & Ops', 'Databases & Ops', 'MongoDB', 80, 7],
        ['Databases & Ops', 'Databases & Ops', 'Redis', 75, 8],
        ['Databases & Ops', 'Databases & Ops', 'Elasticsearch', 70, 9],
        ['Databases & Ops', 'Databases & Ops', 'Linux SysAdmin', 90, 10],
    ];
    foreach ($skills as $s) {
        $stmt = $db->prepare("INSERT INTO skills (category, category_en, name, level, order_index) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute($s);
    }
}

// Initial admin account setup
$stmt = $db->query("SELECT COUNT(*) FROM users");
if ($stmt->fetchColumn() == 0) {
    $password = password_hash('admin123', PASSWORD_BCRYPT);
    $stmt = $db->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->execute(['admin', $password]);
    if (php_sapi_name() === 'cli') {
        echo "Default admin account created with username 'admin' and password 'admin123'.\n";
    }
}
