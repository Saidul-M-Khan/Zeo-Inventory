<div class="h-full">
    <div class="border-b-2 block md:flex">
        <div class="w-full md:w-2/5 p-4 sm:p-6 lg:p-8 bg-white shadow-md">
            <div class="flex justify-between">
                <span class="text-xl font-semibold block">User Profile</span>
                <button id="edit-btn"
                    onclick="toggle()"
                    class="-mt-2 text-md font-bold text-white bg-gray-700 rounded-full px-5 py-2 hover:bg-gray-800"
                >
                    Edit
                </button>
            </div>

            <span class="text-gray-600"
                >This information is secret so be careful</span
            >
            <div class="w-full p-8 mx-2 flex justify-center">
                <img
                    id="showImage"
                    class="max-w-xs w-64 items-center border"
                    src="{{ asset('/assets/user.webp') }}"
                    alt=""
                />
            </div>
        </div>

        <div class="w-full md:w-3/5 p-8 bg-white lg:ml-4 shadow-md">
            <form id="profileUpdateForm">
                <div class="rounded shadow p-6">

                    <div class="pb-6">
                        <label
                            for="email"
                            class="font-semibold text-gray-700 block pb-1"
                            >Business Owner's Email</label
                        >
                        <input
                            readonly
                            id="email"
                            class="border-1 rounded-r px-4 py-2 w-full"
                            type="email"
                        />
                    </div>

                    <div class="pb-4">
                        <label
                            for="name"
                            class="font-semibold text-gray-700 block pb-1"
                            >Business Name</label
                        >
                        <div class="flex">
                            <input
                            disabled
                                id="name"
                                class="border-1 rounded-r px-4 py-2 w-full"
                                type="text"
                            />
                        </div>
                    </div>

                    <div class="pb-4">
                        <label
                            for="mobile"
                            class="font-semibold text-gray-700 block pb-1"
                            >Business Owner's Mobile No.</label
                        >
                        <input
                        disabled
                            id="mobile"
                            class="border-1 rounded-r px-4 py-2 w-full"
                            type="monile"
                        />
                    </div>

                    <div class="pb-4">
                        <label
                            for="password"
                            class="font-semibold text-gray-700 block pb-1"
                            >Password</label
                        >
                        <div class="flex">
                            <input
                            disabled
                                id="password"
                                class="border-1 rounded-r px-4 py-2 w-full"
                                type="text"
                            />
                        </div>
                    </div>

                        <div class="flex justify-between">
                            <div class="text-gray-600 pt-4 block opacity-70">
                                Personal login information of your account
                            </div>
                            <button disabled
                                type="submit"
                                name="submit"
                                id="update-btn"
                                class="-mt-2 text-md font-bold text-white bg-gray-700 rounded-full px-5 py-2 hover:bg-gray-800"
                            >
                                Update
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    ProfileDetails();
    async function ProfileDetails() {
        showLoader();
        let res = await axios.get("/UserProfile");
        console.log(res);
        hideLoader();
        if (res.status === 200 && res.data["status"] === "success") {
            let data = res.data["data"];
            document.getElementById("name").value = data["name"];
            document.getElementById("email").value = data["email"];
            document.getElementById("mobile").value = data["mobile"];
            document.getElementById("password").value = data["password"];
        } else {
            errorToast(res.data["message"]);
        }
    }

    function toggle() {
        document.getElementById("name").disabled = !document.getElementById("name").disabled;
        document.getElementById("mobile").disabled = !document.getElementById("mobile").disabled;
        document.getElementById("password").disabled = !document.getElementById("password").disabled;
        document.getElementById("edit-btn").disabled = !document.getElementById("edit-btn").disabled;
        document.getElementById("update-btn").disabled = !document.getElementById("update-btn").disabled;
    }

    let profileUpdateForm = document.getElementById("profileUpdateForm");

    profileUpdateForm.addEventListener("submit", async (event) => {
        event.preventDefault();
        let name = document.getElementById("name").value;
        let mobile = document.getElementById("mobile").value;
        let password = document.getElementById("password").value;

        if (name.length === 0) {
            errorToast("First Name is required");
        } else if (mobile.length === 0) {
            errorToast("Mobile is required");
        } else if (password.length === 0) {
            errorToast("Password is required");
        } else {
            showLoader();
            let res = await axios.post("/UpdateProfile", {
                name: name,
                mobile: mobile,
                password: password,
            });
            hideLoader();
            if (res.status === 200 && res.data["status"] === "success") {
                successToast(res.data["message"]);
                await getProfile();
                toggle();
            } else {
                errorToast(res.data["message"]);
            }
        }
    });
</script>
