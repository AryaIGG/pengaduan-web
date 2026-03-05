<!DOCTYPE html>
<html lang="id" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#0a0a0a] min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-md">

        <div class="text-center mb-8">
            <div class="inline-flex justify-center items-center size-12 bg-white rounded-xl mb-4">
                <svg class="size-6 text-black" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                </svg>
            </div>
            <h1 class="text-xl font-semibold text-white">Admin Panel</h1>
            <p class="text-sm text-neutral-400 mt-1">Pengaduan Sarana Sekolah</p>
        </div>

        <div class="bg-[#111111] border border-[#1f1f1f] rounded-2xl p-8 shadow-2xl">

            <h2 class="text-lg font-medium text-white mb-6">Masuk ke Dashboard</h2>

            @if($errors->any())
                <div class="mb-4 p-3 rounded-lg bg-red-500/10 border border-red-500/20 text-red-400 text-sm">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login.post') }}" class="space-y-4">
                @csrf

                <div>
                    <label for="username" class="block text-sm font-medium text-neutral-300 mb-1.5">Username</label>
                    <input type="text" id="username" name="username" value="{{ old('username') }}" required autofocus
                        class="w-full px-3.5 py-2.5 bg-[#0a0a0a] border border-[#2a2a2a] rounded-lg text-sm text-white placeholder-neutral-500 focus:outline-none focus:border-white/30 focus:ring-1 focus:ring-white/10 transition-colors"
                        placeholder="Masukkan username">
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-neutral-300 mb-1.5">Password</label>
                    <input type="password" id="password" name="password" required
                        class="w-full px-3.5 py-2.5 bg-[#0a0a0a] border border-[#2a2a2a] rounded-lg text-sm text-white placeholder-neutral-500 focus:outline-none focus:border-white/30 focus:ring-1 focus:ring-white/10 transition-colors"
                        placeholder="Masukkan password">
                </div>

                <div class="flex items-center gap-x-2">
                    <input type="checkbox" id="remember" name="remember" class="size-4 rounded border-[#2a2a2a] bg-[#0a0a0a]">
                    <label for="remember" class="text-sm text-neutral-400 cursor-pointer">Ingat saya</label>
                </div>

                <button type="submit"
                    class="w-full py-2.5 px-4 mt-2 inline-flex justify-center items-center text-sm font-medium rounded-lg bg-white text-black hover:bg-neutral-200 focus:outline-none transition-colors">
                    Masuk
                </button>
            </form>
        </div>

    </div>

</body>
</html>