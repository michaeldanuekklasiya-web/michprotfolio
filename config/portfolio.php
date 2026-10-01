<?php

/*
 * Static content for the public site. Blog posts and portfolio projects are
 * managed from /admin; everything else lives here.
 */
return [

    'name' => 'Michael Danu Ekklasiya',
    'short_name' => 'Michael D E',
    'role' => 'Product Designer & Visual Developer',
    'location' => 'Indonesia',
    'email' => null, // set a public contact email to show it in the footer

    'socials' => [
        'LinkedIn' => 'https://www.linkedin.com/in/michaeldanuekklasiya/',
        'GitHub' => '#',
        'Instagram' => '#',
    ],

    'stats' => [
        ['value' => 200, 'suffix' => '+', 'label' => 'Projects completed'],
        ['value' => 72, 'suffix' => '', 'label' => 'Happy clients'],
        ['value' => 6, 'suffix' => '+', 'label' => 'Years of practice'],
        ['value' => 12, 'suffix' => '', 'label' => 'Design awards'],
    ],

    'services' => [
        ['title' => 'Product & UI/UX Design', 'text' => 'Research-led interfaces, design systems and prototypes that turn complex flows into calm, usable products.'],
        ['title' => 'Web Development', 'text' => 'Fast, responsive websites and web apps built with Laravel, Node.js and modern front-end tooling.'],
        ['title' => 'Brand Identity', 'text' => 'Logos, visual language and collateral that give businesses a consistent and memorable presence.'],
        ['title' => 'Digital Marketing', 'text' => 'Campaign creative and performance ads across Meta and Google that bring the right people in.'],
    ],

    'tools' => [
        'Figma', 'Adobe XD', 'Photoshop', 'Illustrator', 'After Effects', 'Premiere Pro', 'Webflow',
        'JavaScript', 'TypeScript', 'PHP', 'Python', 'Laravel', 'Next.js', 'React', 'Vue.js', 'Node.js',
        'Express', 'Tailwind', 'MySQL', 'MongoDB', 'Docker', 'Git', 'Firebase', 'Vercel',
    ],

    'clients' => [
        ['logo' => 'img/opt/client-alluneed.webp', 'name' => 'All U Need'],
        ['logo' => 'img/opt/client-bidan.webp', 'name' => 'Bidan Nova'],
        ['logo' => 'img/opt/client-bunny.webp', 'name' => 'Bunny'],
        ['logo' => 'img/opt/client-chu.webp', 'name' => 'Chu'],
        ['logo' => 'img/opt/client-siburju2.webp', 'name' => 'Siburju'],
        ['logo' => 'img/opt/client-waroenk.webp', 'name' => 'Waroenk'],
        ['logo' => 'img/opt/client-dirtyshoes.webp', 'name' => 'Dirty Shoes'],
        ['logo' => 'img/opt/client-moeka.webp', 'name' => 'Halaman Moeka'],
    ],

    'experience' => [
        [
            'company' => 'M-Knows Consulting', 'role' => 'Backend Developer', 'period' => 'Mar 2025 — Present',
            'summary' => 'Leading backend development for enterprise consulting solutions.',
            'highlights' => ['Improved API response time by 40%', 'Reduced query time by 60% with Redis caching', 'Deployed a microservices architecture'],
            'stack' => ['Node.js', 'Express', 'MongoDB', 'Redis', 'Docker'],
        ],
        [
            'company' => 'Jiwa Kreatif Indonesia', 'role' => 'Chief Executive Officer', 'period' => 'Nov 2023 — Present',
            'summary' => 'Leading a creative agency focused on digital transformation and brand development.',
            'highlights' => ['Developed 15+ brand identities', 'Delivered 20+ web projects', 'Established brand guidelines for clients'],
            'stack' => ['Figma', 'Laravel', 'Vue.js', 'Brand Strategy'],
        ],
        [
            'company' => 'PT Timah Industri', 'role' => 'Fullstack Developer', 'period' => 'Sep 2024 — Feb 2025',
            'summary' => 'Built web applications for industrial operations and inventory management.',
            'highlights' => ['Streamlined operations by 50%', 'Reduced inventory errors by 75%', 'Built reporting dashboards'],
            'stack' => ['Laravel', 'MySQL', 'Chart.js', 'jQuery'],
        ],
        [
            'company' => 'Kejaksaan Republik Indonesia', 'role' => 'Graphic Designer', 'period' => 'Aug 2022 — Aug 2023',
            'summary' => 'Created visual materials and branding for a government institution.',
            'highlights' => ['Built a consistent visual identity', 'Created 100+ digital assets'],
            'stack' => ['Photoshop', 'Illustrator'],
        ],
        [
            'company' => 'Klinik Bidan Nova', 'role' => 'Graphic Designer', 'period' => 'Mar 2023 — Jun 2023',
            'summary' => 'Designed marketing materials and visual assets for a healthcare clinic.',
            'highlights' => ['Increased patient inquiries by 30%'],
            'stack' => ['Photoshop', 'Illustrator', 'Figma'],
        ],
        [
            'company' => 'Halaman Moeka Publishing', 'role' => 'Graphic Designer', 'period' => 'Oct 2022 — Feb 2023',
            'summary' => 'Book covers, interior layouts and typography for literary works.',
            'highlights' => ['Designed 25+ book covers'],
            'stack' => ['Illustrator', 'InDesign'],
        ],
        [
            'company' => 'PT United Teknologi Integrasi', 'role' => 'Technical Support Specialist', 'period' => 'Aug 2022 — Oct 2022',
            'summary' => 'Technical support and system administration for IT infrastructure.',
            'highlights' => ['Resolved 200+ technical issues'],
            'stack' => ['Linux', 'Windows Server'],
        ],
        [
            'company' => 'Alluneed Digital Indonesia', 'role' => 'Digital Marketing', 'period' => 'Jan 2020 — Jan 2022',
            'summary' => 'Managed digital campaigns and social media presence for clients.',
            'highlights' => ['Increased engagement by 150%', 'Generated 500+ leads'],
            'stack' => ['Meta Ads', 'Google Ads', 'Analytics'],
        ],
        [
            'company' => 'CyberLabs Official', 'role' => 'Fullstack Developer', 'period' => 'Aug 2021 — Nov 2021',
            'summary' => 'Web platform and security dashboard for a cybersecurity company.',
            'highlights' => ['Built a secure client portal'],
            'stack' => ['PHP', 'JavaScript', 'MySQL'],
        ],
        [
            'company' => 'Kejar.Id', 'role' => 'Fullstack Developer', 'period' => 'Jan 2021 — Mar 2021',
            'summary' => 'Learning management system and educational platform.',
            'highlights' => ['Implemented course tracking'],
            'stack' => ['PHP', 'JavaScript', 'MySQL'],
        ],
    ],

    // NOTE: placeholder quotes carried over from the old site — replace with real client feedback.
    'testimonials' => [
        ['name' => 'Sarah Johnson', 'role' => 'CEO, TechStart', 'quote' => 'Michael delivered an exceptional website that exceeded our expectations. His attention to detail and creative approach made our vision come to life.'],
        ['name' => 'David Chen', 'role' => 'Founder, DesignLab', 'quote' => 'Working with Michael was a game-changer for our brand. His design and technical expertise produced a site that perfectly represents us.'],
        ['name' => 'Maria Rodriguez', 'role' => 'Marketing Director, InnovateCo', 'quote' => 'He understood our needs perfectly and delivered a website that actually drives results.'],
    ],
];
