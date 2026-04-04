<div class="flex flex-col gap-4 items-center justify-center pl-10 pr-6 pt-8">
    <img class="size-16" src="/assets/logo.png" alt="Icon">

    <div class="flex flex-col w-full">
        <h2 class="text-gray-400 text-base">
            Main Menu
        </h2>

        <div class="flex flex-col text-lg text-primary-8">
            <x-sidebar.sidebar-menu 
                link="{{ route('admin.dashboard') }}"
                :active="request()->routeIs('admin.dashboard')">
                <i data-lucide="house"></i>
                <h1>Beranda</h1>
            </x-sidebar.sidebar-menu>

            <x-sidebar.sidebar-menu 
                link="{{ route('admin.pengguna') }}"
                :active="request()->routeIs('admin.pengguna')">
                <i data-lucide="users"></i>
                <h1>Pengguna</h1>
            </x-sidebar.sidebar-menu>
        </div>
    </div>
</div>

<script>
    lucide.createIcons()
</script>
