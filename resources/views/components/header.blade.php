<nav class="bg-white py-2 md:py-4 sticky top-0 z-50">
    <div class="container px-4 mx-auto md:flex md:items-center">
        <div class="flex justify-between items-center">
            <a href="{{ url('/') }}" class="font-bold text-xl text-indigo-600"
                >ZEO INVENTORY</a
            >
            <button
                class="border border-solid border-gray-600 px-3 py-1 rounded text-gray-600 opacity-50 hover:opacity-75 md:hidden"
                id="navbar-toggle"
            >
                <i class="fas fa-bars"></i>
            </button>
        </div>

        <div
            class="hidden md:flex flex-col md:flex-row md:ml-auto mt-3 md:mt-0"
            id="navbar-collapse"
        >
            <a
                href="{{ url('/') }}"
                class="p-2 lg:px-4 md:mx-2 text-white rounded bg-indigo-600"
                >Home</a
            >
            <a
                href="{{ url('/about-us') }}"
                class="p-2 lg:px-4 md:mx-2 text-gray-600 rounded hover:bg-gray-200 hover:text-gray-700 transition-colors duration-300"
                >About</a
            >
            <a
                href="{{ url('/contact-us') }}"
                class="p-2 lg:px-4 md:mx-2 text-gray-600 rounded hover:bg-gray-200 hover:text-gray-700 transition-colors duration-300"
                >Contact</a
            >
            <a
                id="login"
                href="{{ url('/login') }}"
                class="p-2 lg:px-4 md:mx-2 text-indigo-600 text-center border border-transparent rounded hover:bg-indigo-100 hover:text-indigo-700 transition-colors duration-300"
                >Login</a
            >
            <a
                id="signup"
                href="{{ url('/signup') }}"
                class="p-2 lg:px-4 md:mx-2 text-indigo-600 text-center border border-solid border-indigo-600 rounded hover:bg-indigo-600 hover:text-white transition-colors duration-300 mt-1 md:mt-0 md:ml-1"
                >Signup</a
            >

            <div
                id="profile-menu"
                style="display: none"
                x-data="{ dropdownOpen: false }"
                class="relative"
            >
                <button
                    @click="dropdownOpen = ! dropdownOpen"
                    class="relative block w-8 h-8 overflow-hidden rounded-full shadow focus:outline-none"
                >
                    <img
                        class="object-cover w-full h-full"
                        src="{{ asset('/assets/user.webp') }}"
                        alt="Your avatar"
                    />
                </button>

                <div
                    x-cloak
                    x-show="dropdownOpen"
                    @click="dropdownOpen = false"
                    class="fixed inset-0 z-10 w-full h-full"
                ></div>

                <div
                    x-cloak
                    x-show="dropdownOpen"
                    class="absolute right-0 z-10 w-48 mt-2 overflow-hidden bg-white rounded-md shadow-xl"
                >
                    <a
                        href="/profile"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-600 hover:text-white"
                        >Profile</a
                    >
                    <a
                        href="{{ url('/UserLogout') }}"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-600 hover:text-white"
                        >Logout</a
                    >
                </div>
            </div>
        </div>
    </div>
</nav>
