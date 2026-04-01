<div class="flex flex-col gap-4 items-center justify-center pl-10 pr-6 pt-8">
    <img class="size-16" src="/assets/logo.png" alt="Icon">

    <div class="flex flex-col w-full">
        <h2 class="text-gray-400 text-base">
            Main Menu
        </h2>

        <div class="flex flex-col text-lg text-primary-8">
            <x-sidebar.sidebar-menu class="bg-primary-1 rounded-lg">
                <i data-lucide="house"></i>
                <h1>Beranda</h1>
            </x-sidebar.sidebar-menu>

            <x-sidebar.sidebar-menu>
                <i data-lucide="search"></i>
                <h1>Cari Proyek</h1>
            </x-sidebar.sidebar-menu>

            <x-sidebar.sidebar-menu>
                <i data-lucide="folder"></i>
                <h1>Proyek Saya</h1>
            </x-sidebar.sidebar-menu>

            <x-sidebar.sidebar-menu>
                <i data-lucide="clipboard"></i>
                <h1>Lamaran Saya</h1>
            </x-sidebar.sidebar-menu>
        </div>
    </div>
</div>

<script>
    lucide.createIcons()
</script>