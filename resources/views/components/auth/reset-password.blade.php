<section class="dark:bg-gray-900">
    <div
        class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0"
    >
        <div
            class="w-full p-6 bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md dark:bg-gray-800 dark:border-gray-700 sm:p-8"
        >
            <h2
                class="mb-1 text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white"
            >
                Set New Password
            </h2>
            <form
                id="resetPasswordForm"
                name="resetPasswordForm"
                class="mt-4 space-y-4 lg:mt-5 md:space-y-5"
                action="#"
            >
                <div>
                    <label
                        for="password"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                        >New Password</label
                    >
                    <input
                        type="password"
                        name="password"
                        id="password"
                        placeholder="••••••••"
                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    />
                </div>
                <div>
                    <label
                        for="confirm-password"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                        >Confirm password</label
                    >
                    <input
                        type="password"
                        name="confirm-password"
                        id="confirm-password"
                        placeholder="••••••••"
                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    />
                </div>

                <button
                    id="submit"
                    name="submit"
                    class="w-full py-3 font-medium text-white bg-indigo-600 hover:bg-indigo-500 rounded-lg border-indigo-500 hover:shadow inline-flex space-x-2 items-center justify-center"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="w-6 h-6"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M15.75 5.25a3 3 0 013 3m3 0a6 6 0 01-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1121.75 8.25z"
                        />
                    </svg>

                    <span>Reset Password</span>
                </button>
            </form>
        </div>
    </div>
</section>

<script>
    let resetPasswordForm = document.getElementById("resetPasswordForm");
    let submit = document.getElementById("submit");

    resetPasswordForm.addEventListener("submit", async (event) => {
        let password = document.getElementById("password").value;
        let confirmPassword = document.getElementById("confirm-password").value;

        if (password.length === 0) {
            errorToast("Password is required");
        } else if (confirmPassword.length === 0) {
            errorToast("Confirm Password is required");
        } else if (password !== confirmPassword) {
            errorToast("Password and Confirm Password must be same");
        } else {
            let formData = {
                password: password,
            };
            let URl = "/ResetPassword";
            showLoader();
            let result = await axios.post(URl, formData);
            hideLoader();
            if (result.status === 200 && result.data["status"] === "success") {
                successToast(result.data["message"]);
                debugger;
                window.location.href = "/login";
            } else {
                errorToast(result.data["message"]);
            }
        }
    });
</script>
