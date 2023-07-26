<div class="mt-8">
    <h4 class="text-gray-600">Create New Customer</h4>

    <div class="mt-4">
        <div class="p-6 bg-white rounded-md shadow-md">
            <h2 class="text-lg text-gray-700 font-semibold capitalize">
                Enter New Customer's Information
            </h2>

            <form id="createCustomerForm">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mt-4">
                    <div>
                        <label class="text-gray-700" for="username"
                            >Customer's Name</label
                        >
                        <input id="name" name="name"
                            class="form-input w-full mt-2 rounded-md focus:border-indigo-600 border border-purple-500"
                            type="text"
                        />
                    </div>

                    <div>
                        <label class="text-gray-700" for="emailAddress"
                            >Customer's Email Address</label
                        >
                        <input id="email" name="email"
                            class="form-input w-full mt-2 rounded-md focus:border-indigo-600 border border-purple-500"
                            type="email"
                        />
                    </div>

                    <div>
                        <label class="text-gray-700" for="username"
                            >Customer's Mobile Number</label
                        >
                        <input id="mobile" name="mobile"
                            class="form-input w-full mt-2 rounded-md focus:border-indigo-600 border border-purple-500"
                            type="number"
                        />
                    </div>
                </div>

                <div class="flex justify-end mt-4">
                    <button
                    name="submit"
                    id="submit"
                    type="submit"
                        class="px-4 py-2 bg-gray-800 text-gray-200 rounded-md hover:bg-gray-700 focus:outline-none focus:bg-gray-700"
                    >
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>

    let createCustomerForm=document.getElementById('createCustomerForm');

    createCustomerForm.addEventListener('submit',async (event) => {
        let name = document.getElementById('name').value;
        let email = document.getElementById('email').value;
        let mobile = document.getElementById('mobile').value;

        let formData = {
                name: name,
                email: email,
                mobile: mobile
            }
            let URl = "/CustomerCreate";

            showLoader();
            let result=await axios.post(URl, formData);
            hideLoader();

    })


</script>
