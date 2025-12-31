export interface Product {
    id: string;
    name: string;
    category: string;
    price: string;
    description: string;
    features: string[];
    guideFile: string;
    youtubeId: string;
}

export const products: Product[] = [
    {
        id: 'sik-sekolah',
        name: 'Sistem Informasi Keuangan Sekolah',
        category: 'Enterprise',
        price: 'Rp 15jt',
        description: 'Solusi manajemen keuangan terpadu untuk semua jenjang pendidikan (SD, SMP, SMA/K). Integrasi SPP, Tabungan, dan Pelaporan BOS.',
        features: [
            'Manajemen SPP Otomatis',
            'Sistem Tabungan Siswa',
            'Laporan Real-time untuk Yayasan',
            'Integrasi Pembayaran Digital',
            'Dashboard Multi-user (Admin & Guru)',
            'Backup Data Terenkripsi'
        ],
        guideFile: '/guides/sik-sekolah.pdf',
        youtubeId: 'dQw4w9WgXcQ' // Placeholder
    },
    {
        id: 'custom-web',
        name: 'Jasa Pembuatan Website Kustom',
        category: 'Creative',
        price: 'Nego',
        description: 'Pengembangan website eksklusif yang dirancang khusus untuk profil perusahaan, platform e-learning, atau aplikasi web kompleks.',
        features: [
            'Desain UI/UX Eksklusif',
            'Teknologi Modern (Astro/Next.js)',
            'Optimasi SEO & Performa',
            'Full Responsive di Semua Perangkat',
            'Gratis Maintenance 3 Bulan',
            'Konsultasi Arsitektur Kode'
        ],
        guideFile: '/guides/custom-web.pdf',
        youtubeId: 'dQw4w9WgXcQ' // Placeholder
    }
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
