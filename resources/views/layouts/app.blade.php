<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Find A Teammate</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="flex min-h-screen bg-primary-0 pr-10">
        
        <aside class="w-1/6">
        </aside>

        <div class="flex flex-col w-5/6 relative">
            <div class="bg-primary-0 flex justify-start relative overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-64 
                            bg-linear-to-r from-primary-0 from-50% via-primary-5 via-60% to-secondary-5 
                            blur-[100px] opacity-50">
                </div>
        
                <main class="ps-0 p-6">
                    <h1 class="w-4xl font-bold">Selamat Datang, Aurel!</h1>
                </main> 
            </div>

            <div class="bg-white p-6 h-screen rounded-t-2xl">
                
            </div>
        </div>
    </div>
</body>
</html>