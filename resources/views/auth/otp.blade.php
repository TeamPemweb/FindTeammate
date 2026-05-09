<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>OTP - Find A Teammate</title>
        <script src="https://unpkg.com/lucide@latest"></script>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <main>
            <div class="flex items-center justify-center h-screen w-screen">
                <div class="flex flex-col gap-32 w-auto h-auto">
                    <div class="flex flex-col gap-6 w-full h-full">
                        <div class="flex items-center">
                            <x-back></x-back>
                        </div>
                        <div class="flex items-center justify-center">
                            <img class="size-26" src="/assets/otp_icon.png" alt="OTP Icon">
                        </div>
                        <div class="flex flex-col gap-2">
                            <h2 class="text-center text-4xl font-bold">Konfirmasi OTP</h2>
                            <p class="text-center text-lg font-normal">Kode OTP telah dikirimkan ke email Anda, silahkan cek inbox Anda.</p>
                        </div>
                    </div>
                    <form action="{{ route('otp.verify') }}" method="POST" class="flex flex-col gap-8 w-full h-full">
                        @csrf
                        <div>
                            <x-textField fieldType="text" label="Kode OTP" placeholder="Masukkan kode OTP" name="otp"></x-textField>
                        </div>
                        
                        <x-button variant="primary" type="submit">Konfirmasi OTP</x-button>
                    </form> 

                </div>
            </div>
        </main>
    </body>
</html>