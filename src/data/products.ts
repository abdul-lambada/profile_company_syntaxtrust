export interface Product {
    id: string;
    name: string;
    category: 'Basic' | 'Pro' | 'Enterprise';
    price: string;
    description: string;
    features: string[];
    guideFile: string;
    youtubeId: string;
    icon: string;
}

export const products: Product[] = [
    {
        id: 'syntax-lite',
        name: 'Syntax Lite',
        category: 'Basic',
        price: 'Rp 499.000',
        description: 'Solusi manajemen data sederhana untuk startup dan UMKM.',
        features: ['Manajemen Stok', 'Laporan Harian', 'Akses 1 User', 'Support Email'],
        guideFile: '/docs/syntax-lite-guide.pdf',
        youtubeId: 'dQw4w9WgXcQ',
        icon: 'Terminal',
    },
    {
        id: 'syntax-pro',
        name: 'Syntax Pro',
        category: 'Pro',
        price: 'Rp 1.499.000',
        description: 'Fitur lengkap untuk bisnis yang sedang berkembang pesat.',
        features: ['Multi-User Access', 'Analitik Real-time', 'Integrasi API', 'Priority Support'],
        guideFile: '/docs/syntax-pro-manual.pdf',
        youtubeId: 'dQw4w9WgXcQ',
        icon: 'Cpu',
    },
    {
        id: 'syntax-enterprise',
        name: 'Syntax Enterprise',
        category: 'Enterprise',
        price: 'Custom',
        description: 'Infrastruktur kustom untuk kebutuhan perusahaan skala besar.',
        features: ['Kustomisasi Penuh', 'Dedicted Server', 'SLA 99.9%', 'On-site Training'],
        guideFile: '/docs/enterprise-solution.pdf',
        youtubeId: 'dQw4w9WgXcQ',
        icon: 'ShieldCheck',
    },
];

export const partners = [
    { name: 'Google Cloud', logo: 'https://upload.wikimedia.org/wikipedia/commons/5/51/Google_Cloud_Logo.svg' },
    { name: 'Microsoft', logo: 'https://upload.wikimedia.org/wikipedia/commons/4/44/Microsoft_logo.svg' },
    { name: 'AWS', logo: 'https://upload.wikimedia.org/wikipedia/commons/9/93/Amazon_Web_Services_Logo.svg' },
    { name: 'DigitalOcean', logo: 'https://upload.wikimedia.org/wikipedia/commons/f/ff/DigitalOcean_logo.svg' },
    { name: 'Meta', logo: 'https://upload.wikimedia.org/wikipedia/commons/7/7b/Meta_Platforms_Inc._logo.svg' },
];

export const clients = [
    { name: 'TechCorp', logo: 'https://upload.wikimedia.org/wikipedia/commons/2/2f/Logo_TV_2015.svg' },
    { name: 'Finansialku', logo: 'https://upload.wikimedia.org/wikipedia/commons/5/5e/Visa_Inc._logo.svg' },
    { name: 'EduSmart', logo: 'https://upload.wikimedia.org/wikipedia/commons/4/42/Adobe_Systems_logo_and_wordmark.svg' },
    { name: 'GlobalLogistics', logo: 'https://upload.wikimedia.org/wikipedia/commons/b/b9/FedEx_Corporation_-_Logo.svg' },
    { name: 'HealthPlus', logo: 'https://upload.wikimedia.org/wikipedia/commons/1/1b/eBay_logo.svg' },
];
