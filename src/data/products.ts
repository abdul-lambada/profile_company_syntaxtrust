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

export const schoolClients = [
    { name: 'SMK Negeri 1 Jakarta', city: 'Jakarta Pusat', coords: { lat: -6.1751, lng: 106.8650 } },
    { name: 'SMA Al-Azhar', city: 'Bekasi', coords: { lat: -6.2383, lng: 106.9756 } },
    { name: 'SMP Bintang Bangsa', city: 'Bandung', coords: { lat: -6.9175, lng: 107.6191 } },
    { name: 'Yayasan Pendidikan Mulia', city: 'Surabaya', coords: { lat: -7.2575, lng: 112.7521 } },
    { name: 'Pesantren Modern Risalah', city: 'Bogor', coords: { lat: -6.5971, lng: 106.7949 } },
];

export const webClients = [
    {
        id: 'indo-furniture',
        name: 'IndoFurniture Store',
        category: 'E-Commerce',
        year: '2025',
        description: 'Platform e-commerce furniture mewah dengan integrasi AR (Augmented Reality).',
        challenge: 'Menampilkan katalog ribuan produk dengan performa cepat.',
        solution: 'Implementasi Static Site Generation (SSG) dan optimasi gambar on-the-fly.',
        url: 'https://example.com/furniture'
    },
    {
        id: 'logistik-pro',
        name: 'Logistik Pro Express',
        category: 'Platform Logistik',
        year: '2024',
        description: 'Sistem pelacakan logistik real-time untuk armada nasional.',
        challenge: 'Sinkronisasi data GPS dari ribuan truk secara bersamaan.',
        solution: 'Arsitektur microservices dengan WebSockets untuk update tanpa latensi.',
        url: 'https://example.com/logistics'
    },
    {
        id: 'klinik-sehat',
        name: 'Klinik Sehat Utama',
        category: 'Company Profile',
        year: '2025',
        description: 'Situs profil kesehatan dengan sistem janji temu terpadu.',
        challenge: 'Meningkatkan konversi booking pasien online.',
        solution: 'Desain UI yang ramah pengguna dengan alur booking 3 langkah.',
        url: 'https://example.com/clinic'
    },
];
