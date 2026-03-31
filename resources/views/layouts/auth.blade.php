<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Find A Teammate</title>
    <script src="https://unpkg.com/lucide@latest"></script>
    @vite('resources/css/app.css')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body>
    <main class="flex min-h-screen w-full"> 

    <section class="relative w-3/5 bg-cover bg-top min-h-screen" style="background-image: url('{{ asset('assets/auth.png') }}')">
        
        <div class="w-full p-10 bg-slate-950/75 h-full"> 
            <div class="flex flex-col gap-75 text-white"> <div class="flex gap-4">
                    <img class="w-16 h-14" src="{{ asset('icon.png') }}" alt="Icon">
                    <div class="flex flex-col justify-center">
                        <h1 class="text-xl font-black">Find A Teammate</h1>
                        <p class="text-sm">by FILKOM UB</p>
                    </div>
                </div>

                <div class="flex flex-col gap-4 mt-20">
                    <h1 class="text-5xl font-bold leading-tight">
                        Temukan rekan kolaborasimu di Find A Teammate!
                    </h1>
                    <p class="text-2xl font-light">
                        Kolaborasi dalam Tim, Cari Anggota, dan Sukseskan Proyekmu!
                    </p>
                </div>

            </div>
        </div>
    </section>

    <div class="w-2/5 min-h-screen flex items-center justify-center bg-white">
        @yield('content')
    </div>

    </main>
</body>
</html>