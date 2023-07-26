<section class="bg-gray-50 min-h-screen flex items-center justify-center">
    <!-- login container -->
    <div
        class="bg-gray-100 flex rounded-2xl shadow-lg max-w-3xl p-5 items-center"
    >
        <!-- form -->
        <div class="md:w-1/2 px-8 md:px-16">
            <h2 class="font-bold text-2xl text-[#002D74]">Signup</h2>
            <p class="text-xs mt-4 text-[#002D74]">
                If you are not a member, easily signup
            </p>

            <form
                action=""
                id="signupForm"
                name="signupForm"
                class="flex flex-col gap-4"
            >
                <input
                    id="name"
                    class="p-2 mt-8 rounded-xl border"
                    type="text"
                    name="name"
                    placeholder="Name"
                />
                <input
                    id="email"
                    class="p-2 rounded-xl border"
                    type="email"
                    name="email"
                    placeholder="Email"
                />
                <div class="relative">
                    <input
                        id="password"
                        class="p-2 rounded-xl border w-full"
                        type="password"
                        name="password"
                        placeholder="Password"
                    />
                    <svg
                        onclick="visiblePass()"
                        xmlns="http://www.w3.org/2000/svg"
                        width="16"
                        height="16"
                        fill="gray"
                        class="bi bi-eye absolute top-1/2 right-3 -translate-y-1/2"
                        viewBox="0 0 16 16"
                    >
                        <path
                            d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"
                        />
                        <path
                            d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"
                        />
                    </svg>
                </div>
                <button
                    id="submit"
                    name="submit"
                    class="bg-[#002D74] rounded-xl text-white py-2 hover:scale-105 duration-300"
                >
                    Signup
                </button>
            </form>

            <div
                class="mt-5 text-xs border-b border-[#002D74] py-4 text-[#002D74]"
            >
                <a href="{{ url('forget-pass') }}">Forgot your password?</a>
            </div>

            <div
                class="mt-3 text-xs flex justify-between items-center text-[#002D74]"
            >
                <p>Already have an account?</p>
                <a href="{{ url('login') }}">
                    <button
                        class="py-2 px-5 bg-white border rounded-xl hover:scale-110 duration-300"
                    >
                        Login
                    </button>
                </a>
            </div>
        </div>

        <!-- image -->
        <div class="md:block hidden w-1/2">
            <img
                class="rounded-2xl"
                src="{{ asset('assets/signup-animation.gif') }}"
            />
        </div>
    </div>
</section>

<script>
    function visiblePass() {
        var x = document.getElementById("password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>

<script>
    let signupForm = document.getElementById("signupForm");
    let submit = document.getElementById("submit");

    signupForm.addEventListener("submit", async (event) => {
        let name = document.getElementById("name").value;
        let email = document.getElementById("email").value;
        let password = document.getElementById("password").value;

        if (name.length === 0) {
            errorToast("Name is required");
        } else if (email.length === 0) {
            errorToast("Email is required");
        } else if (password.length === 0) {
            errorToast("Password is required");
        } else {
            let formData = {
                name: name,
                email: email,
                password: password,
            };
            let URl = "/UserSignup";
            showLoader();
            let result = await axios.post(URl, formData);
            hideLoader();
            if (result.status === 200 && result.data["status"] === "success") {
                successToast(result.data["message"]);
                window.location.href = "/login";
            } else {
                errorToast(result.data["message"]);
            }
        }
    });
</script>
