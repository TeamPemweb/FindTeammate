<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 Not Found</title>
    @vite('resources/css/app.css','resources/js/app.js')
</head>
<body>
    <div class="flex flex-col items-center justify-center w-screen min-h-screen bg-primary-0 relative">
        <div class="absolute top-0 left-0 z-0 w-full h-64 bg-linear-to-r from-primary-0 from-50% via-primary-5 via-60% to-secondary-5 blur-[100px] opacity-50"></div>
        
        <div class="'flex flex-col space-y-8 w-180 p-12 items-center justify-center z-20 rounded-4xl bg-white">
            <div class="w-full flex items-center justify-center">
                <img class="w-[349px] h-[288px]" draggable="false" src="assets/empty.png" alt="empty">
            </div>    

            <div class="text-primary-8 text-center space-y-2">
                <h1 class="text-4xl font-bold">404 Not Found</h1>
                <p class="text-2xl font-medium">Halaman yang Anda cari tidak ditemukan!</p>
            </div>
        </div>
    </div>

    </div>
</body>
</html>