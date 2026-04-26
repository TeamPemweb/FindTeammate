<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Find A Teammate</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        .hover-lift { transition: transform 0.3s ease, box-shadow 0.3s ease; }
        .hover-lift:hover { transform: translateY(-10px); }
        .nav-blur { transition: all 0.3s ease; }
        
        @keyframes pulse-glow {
            0% { opacity: 0.3; transform: scale(1); }
            50% { opacity: 0.6; transform: scale(1.1); }
            100% { opacity: 0.3; transform: scale(1); }
        }
        .animate-glow { animation: pulse-glow 5s infinite ease-in-out; }
    </style>
</head>

<body class="overflow-x-hidden">
    <div class="flex flex-col">

        <nav class="fixed top-0 left-0 w-full z-50 flex flex-row justify-between items-center py-6 px-10 bg-white/80 backdrop-blur-md border-b border-slate-100 nav-blur">
            <div class="flex flex-row items-center gap-2" data-aos="fade-right">
                <img src="/assets/logo_complete.png" alt="Logo" draggable="false">
            </div>
            <div data-aos="fade-left">
                <x-button onclick="window.location.href='{{ route('login') }}'" variant="primary">Masuk/Daftar</x-button>
            </div>
        </nav>

        <div class="flex flex-col gap-[185px] px-10 pt-32">

            <div class="relative w-full min-h-screen rounded-4xl overflow-hidden flex items-center justify-center p-10 mt-4 shadow-lg" data-aos="zoom-out" data-aos-duration="1500">
                <img src="/assets/photo_landing.png" draggable="false" alt="Landing Page" class="absolute inset-0 w-full h-full object-cover">
                <div class="absolute inset-0 bg-slate-900/50"></div>
                <div class="relative z-10 flex flex-col items-center text-center max-w-4xl gap-6">
                    <h1 class="text-5xl font-bold text-white leading-tight" data-aos="fade-up" data-aos-delay="300">
                        Temukan rekan kolaborasimu di <br>Find A Teammate!
                    </h1>
                    <p class="text-xl font-medium text-slate-100" data-aos="fade-up" data-aos-delay="500">
                        Kolaborasi dalam Tim, Cari Anggota, dan Sukseskan Proyekmu!
                    </p>
                    <div class="flex flex-row gap-4 mt-4" data-aos="fade-up" data-aos-delay="700">
                        <x-button variant="secondary">Tentang Kami</x-button>
                        <x-button variant="primary">Mulai Sekarang</x-button>
                    </div>
                </div>
            </div>

            <div class="flex flex-col gap-[136px]">
                <div data-aos="fade-right">
                    <h1 class="text-6xl font-bold">Solusi Strategis untuk</h1>
                    <h1 class="text-6xl font-bold text-primary-8">Pencarian SDM</h1>
                </div>

                <div class="grid grid-cols-3 gap-x-6 gap-y-10">
                    <div class="w-fit px-4 py-2 bg-primary-0.5 text-primary-8 font-semibold text-5xl rounded-lg hover-lift" data-aos="fade-up" data-aos-delay="100">Organisasi</div>
                    <div class="w-fit px-4 py-2 bg-primary-0.5 text-primary-8 font-semibold text-5xl rounded-lg hover-lift" data-aos="fade-up" data-aos-delay="200">Proyek</div>
                    <div class="w-fit px-4 py-2 bg-primary-0.5 text-primary-8 font-semibold text-5xl rounded-lg hover-lift" data-aos="fade-up" data-aos-delay="300">Penelitian</div>
                    <div class="w-fit px-4 py-2 bg-primary-0.5 text-primary-8 font-semibold text-5xl rounded-lg hover-lift" data-aos="fade-up" data-aos-delay="400">Tugas</div>
                    <div class="w-fit px-4 py-2 bg-primary-0.5 text-primary-8 font-semibold text-5xl rounded-lg hover-lift" data-aos="fade-up" data-aos-delay="500">Lomba</div>
                    <div class="w-fit px-4 py-2 bg-primary-0.5 text-primary-8 font-semibold text-5xl rounded-lg hover-lift" data-aos="fade-up" data-aos-delay="600">Startup</div>
                </div>
            </div>

            <div class="flex flex-row items-center gap-12" data-aos="fade-up">
                <h1 class="text-4xl font-semibold text-primary-8">Dengan kami, Anda dapat dengan mudah mendapatkan teman kelompok untuk berbagai keperluan Anda!</h1>
                <img src="/assets/photo_landing1.png" alt="" class="hover-lift">
            </div>

            <div class="-mx-10 flex flex-row justify-center items-center bg-secondary-0.5 py-12 gap-40" data-aos="slide-up">
                <div class="text-center" data-aos="zoom-in" data-aos-delay="200">
                    <h1 class="text-5xl text-primary-8 font-bold">3,445++</h1>
                    <p class="text-lg font-semibold text-black mt-2">Pengguna aktif</p>
                </div>
                <div class="text-center" data-aos="zoom-in" data-aos-delay="400">
                    <h1 class="text-5xl text-primary-8 font-bold">500++</h1>
                    <p class="text-lg font-semibold text-black mt-2">Proyek aktif saat ini</p>
                </div>
                <div class="text-center" data-aos="zoom-in" data-aos-delay="600">
                    <h1 class="text-5xl text-primary-8 font-bold">10,000++</h1>
                    <p class="text-lg font-semibold text-black mt-2">Mahasiswa terbantu</p>
                </div>
            </div>

            <div class="flex flex-col gap-12">
                <h1 class="text-5xl font-bold text-primary-8" data-aos="fade-right">Apa kata mereka?</h1>
                <div class="flex flex-row gap-6">
                    <div class="flex flex-col bg-slate-100 p-6 rounded-4xl items-start gap-8 hover-lift" data-aos="flip-left" data-aos-duration="1000">
                        <p>Omo omo sangat membantu diriku menemukan partner untuk lomba ataupun proyek-proyek</p>
                        <x-pfp-name name="Budi Santoso"></x-pfp-name>
                    </div>
                    <div class="flex flex-col bg-slate-100 p-6 rounded-4xl items-start gap-8 hover-lift" data-aos="flip-left" data-aos-duration="1000" data-aos-delay="200">
                        <p>Omo omo sangat membantu diriku menemukan partner untuk lomba ataupun proyek-proyek</p>
                        <x-pfp-name name="Budi Santoso"></x-pfp-name>
                    </div>
                </div>
            </div>

            <footer class="relative flex flex-col justify-center items-center pt-32 gap-40 -mx-10 overflow-hidden">
                <div class="relative z-10 flex flex-col justify-center items-center gap-6" data-aos="fade-up">
                    <h1 class="text-4xl font-bold text-primary-8">Gabung Bersama Kami!</h1>
                    <x-button variant="primary">Mulai Sekarang</x-button>
                </div>
                <h1 class="relative z-10 text-9xl font-bold text-primary-8 text-center leading-none translate-y-[15%]" data-aos="zoom-out-up" data-aos-duration="1200">FIND A TEAMMATE</h1>
                <div class="absolute bottom-0 right-0 z-0 w-3/4 h-64 bg-linear-to-r from-primary-0 from-50% via-primary-5 via-60% to-secondary-5 blur-[100px] opacity-50 animate-glow"></div>
            </footer>
        </div>
    </div>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800, 
            once: false,   
            offset: 100,   
            easing: 'ease-in-out',
        });
    </script>
</body>

</html>