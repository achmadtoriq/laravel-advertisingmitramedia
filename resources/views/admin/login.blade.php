<x-layout-auth>

    <div x-data="{ show: false, loading: false }" class="w-full max-w-md mx-auto">

        <!-- logo -->
        <div class="text-center mb-8">

            <h1 class="text-3xl font-bold tracking-tight text-gray-800">
                CMS Admin
            </h1>

            <p class="text-gray-500 text-sm mt-2">
                Secure access to dashboard
            </p>

        </div>

        {{-- ERROR MESSAGE --}}
        @if ($errors->any())
            <div class="mb-4 p-3 rounded-lg bg-red-50 text-red-600 text-sm text-center border border-red-200">
                {{ $errors->first() }}
            </div>
        @endif


        <form method="POST" action="/login" @submit="loading=true" class="space-y-6">

            @csrf

            <!-- EMAIL -->
            <div class="relative">

                <input type="email" name="email" required placeholder=" "
                    class="peer w-full px-4 pt-6 pb-2 border rounded-xl focus:ring-2 focus:ring-red-500 outline-none" />

                <label
                    class="absolute left-4 top-2 text-xs text-gray-500 
    peer-placeholder-shown:top-4 peer-placeholder-shown:text-sm
    peer-placeholder-shown:text-gray-400
    transition-all">
                    Email Address
                </label>

            </div>


            <!-- PASSWORD -->
            <div class="relative">

                <input :type="show ? 'text' : 'password'" name="password" required placeholder=" "
                    class="peer w-full px-4 pt-6 pb-2 border rounded-xl focus:ring-2 focus:ring-red-500 outline-none" />

                <label
                    class="absolute left-4 top-2 text-xs text-gray-500
                    peer-placeholder-shown:top-4 peer-placeholder-shown:text-sm
                    peer-placeholder-shown:text-gray-400 transition-all">
                    Password
                </label>

                <button type="button" @click="show = !show"
                    class="absolute right-4 top-4 text-gray-400 hover:text-gray-600 transition">

                    <!-- eye -->
                    <i x-show="!show" class="fa-regular fa-eye"></i>

                    <!-- eye slash -->
                    <i x-show="show" class="fa-regular fa-eye-slash"></i>

                </button>

            </div>


            <!-- REMEMBER -->
            <div class="flex items-center justify-between text-sm">

                <label class="flex items-center gap-2 text-gray-600">

                    <input type="checkbox" class="rounded">

                    Remember me

                </label>

                <a href="#" class="text-red-500 hover:underline">
                    Forgot password
                </a>

            </div>


            <!-- BUTTON -->
            <button type="submit"
                class="w-full py-3 rounded-xl bg-gradient-to-r from-red-500 to-orange-500
    text-white font-medium shadow-lg hover:scale-[1.02] transition
    flex items-center justify-center gap-2">

                <span x-show="!loading">Login</span>

                <span x-show="loading" class="flex items-center gap-2">

                    <svg class="animate-spin h-5 w-5" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10" stroke="white" stroke-width="4" fill="none" />
                    </svg>

                    Loading...

                </span>

            </button>

        </form>


        <div class="text-center text-xs text-gray-400 mt-8">
            Mitramedia Advertising CMS
        </div>

    </div>

</x-layout-auth>
