<div
    class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 via-cyan-50 to-teal-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <!-- Header -->
        <div class="text-center space-y-4">
            <div
                class="mx-auto h-16 w-16 bg-gradient-to-r from-cyan-500 to-teal-500 rounded-2xl flex items-center justify-center shadow-lg">
                <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                </svg>
            </div>
            <div>
                <h2 class="text-3xl font-bold text-gray-900">Welcome Back</h2>
                <p class="text-gray-600 text-sm mt-1">Sign in to your admin account</p>
            </div>
        </div>

        <!-- Session Status -->
        @if (session('status'))
            <div class="bg-green-50 border border-green-200 rounded-xl p-3">
                <p class="text-sm text-green-700 text-center">{{ session('status') }}</p>
            </div>
        @endif

        <!-- Login Form -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8 space-y-6">
            <form wire:submit.prevent="login">
                @csrf

                <!-- Email -->
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">Email Address</label>
                    <div class="relative">
                        <input id="email" type="email" wire:model.live="email" required autofocus
                            autocomplete="email" placeholder="Enter your email"
                            class="w-full px-4 py-3 pl-11 border  rounded-xl text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition-all duration-200 @error('email') border-red-300 ring-2 ring-red-200 @enderror" />
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">

                        </div>
                    </div>
                    @error('email')
                        <p class="text-red-600 text-xs mt-1 flex items-center">
                            <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="space-y-3">
                    <label class="block text-sm font-medium text-gray-700">Password</label>
                    <div class="relative">
                        <input id="password" type="password" wire:model="password" required
                            autocomplete="current-password" placeholder="Enter your password"
                            class="w-full px-4 py-3 pr-12 border border-gray-300 rounded-xl text-gray-900 placeholder-gray-500
                   focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent
                   transition-all duration-200 @error('password') ring-2 ring-red-200 @enderror" />

                        <!-- Eye Toggle Button -->
                        <button type="button" id="togglePassword"
                            class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500 hover:text-cyan-600">
                            <svg id="eye-icon" class="h-5 w-5" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943
                       9.542 7-1.274 4.057-5.064 7-9.542 7-4.477
                       0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                    </div>
                    @error('password')
                        <p class="text-red-600 text-xs mt-1 flex items-center">
                            <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="flex items-center">
                    <input id="remember" type="checkbox" wire:model.live="remember"
                        class="h-4 w-4 text-cyan-600 focus:ring-cyan-500 border-gray-300 rounded" />
                    <label for="remember" class="ml-2 block text-sm text-gray-700">Remember me</label>
                </div>

                <button type="submit"
                    class="w-full flex items-center justify-center py-3 px-4
           border border-gray-300 rounded-xl shadow-md
           text-sm font-semibold text-black
           bg-white hover:bg-gray-100
           focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500
           transition-all duration-200
           disabled:opacity-50 disabled:cursor-not-allowed"
                    wire:loading.attr="disabled">

                    <span wire:loading.remove wire:target="login" class="flex items-center space-x-2 ">
                        <svg class="h-4 w-4 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                        </svg>
                        <span>Sign In</span>
                    </span>

                    <span wire:loading wire:target="login" class="flex items-center space-x-2">
                        <svg class="animate-spin h-4 w-4 text-black" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4
                   zm2 5.291A7.962 7.962 0 014 12H0c0
                   3.042 1.135 5.824 3 7.938l3-2.647z">
                            </path>
                        </svg>
                        <span>Signing In...</span>
                    </span>
                </button>


            </form>
        </div>
    </div>
</div>
<script>
    const togglePassword = document.getElementById("togglePassword");
    const passwordInput = document.getElementById("password");
    const eyeIcon = document.getElementById("eye-icon");

    togglePassword.addEventListener("click", () => {
        const isPassword = passwordInput.type === "password";
        passwordInput.type = isPassword ? "text" : "password";

        // Đổi icon mắt (mở / đóng)
        if (isPassword) {
            eyeIcon.innerHTML = `
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478
                       0-8.268-2.943-9.542-7a9.97 9.97 0 012.448-4.362m3.31-2.348
                       A9.956 9.956 0 0112 5c4.478 0 8.268 2.943 9.542 7
                       a9.97 9.97 0 01-4.043 5.19M15 12a3 3 0
                       11-6 0 3 3 0 016 0z"/>
                <line x1="4" y1="4" x2="20" y2="20"
                      stroke="currentColor" stroke-width="2"/>
            `;
        } else {
            eyeIcon.innerHTML = `
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478
                       0 8.268 2.943 9.542 7-1.274 4.057-5.064
                       7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
            `;
        }
    });
</script>
