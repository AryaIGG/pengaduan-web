<!DOCTYPE html>
<html lang="id" class="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#0a0a0a] min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-md">

        <div class="text-center mb-8">
            <div
                class="inline-flex justify-center items-center size-12 bg-white rounded-xl mb-4 shadow-[0_0_20px_rgba(255,255,255,0.15)]">
                <svg class="size-6 text-black" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5" />
                </svg>
            </div>
            <h1 class="text-xl font-semibold text-white tracking-tight">Reset Password</h1>
            <p class="text-sm text-neutral-500 mt-1">Masukkan email admin untuk menerima tautan reset</p>
        </div>

        <div class="bg-[#111111] border border-[#1f1f1f] rounded-2xl p-8 shadow-2xl">

            <h2 class="text-lg font-medium text-white mb-6">Lupa Password</h2>

            @if (session('status'))
                <div class="mb-4 p-3 rounded-lg bg-emerald-500/10 border border-emerald-500/20 text-emerald-300 text-sm">
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-4 p-3 rounded-lg bg-red-500/10 border border-red-500/20 text-red-400 text-sm">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('admin.password.email') }}" class="space-y-5">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-medium text-neutral-400 mb-1.5">Email Admin</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                        class="w-full px-4 py-2.5 bg-[#0a0a0a] border border-[#2a2a2a] rounded-xl text-sm text-white placeholder-neutral-600 focus:outline-none focus:border-white/30 focus:ring-1 focus:ring-white/10 transition-all"
                        placeholder="Masukkan email admin">
                </div>

                <button type="submit"
                    class="w-full py-3 px-4 mt-2 inline-flex justify-center items-center text-sm font-semibold rounded-xl bg-white text-black hover:bg-neutral-200 active:scale-[0.98] focus:outline-none transition-all shadow-lg shadow-white/5">
                    Kirim Link Reset
                </button>
            </form>
        </div>

        <p class="text-center mt-6 text-xs text-neutral-600">
            <a href="{{ route('admin.login') }}" class="underline underline-offset-4 hover:text-white transition-colors">
                Kembali ke Login
            </a>
        </p>

    </div>

</body>

</html>
