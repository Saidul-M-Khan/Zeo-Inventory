<h3 class="text-gray-700 text-3xl font-medium">Products Management</h3>

<div class="mt-8"></div>

<h3 class="text-gray-700 text-xl font-semibold">Product Record</h3>
<div class="flex flex-col mt-8">
    <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
        <div
            class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200 bg-white p-5"
        >
            <table class="min-w-full" id="tableData">
                <thead>
                    <tr>
                        <th
                            class="px-2 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                        ></th>
                        <th
                            class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                        >
                            Product Name
                        </th>
                        <th
                            class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                        >
                            Category
                        </th>
                        <th
                            class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                        >
                            Price
                        </th>
                        <th
                            class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                        >
                            Unit
                        </th>
                        <th
                            class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                        >
                            Qty
                        </th>
                        <th
                            class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                        ></th>
                        <th
                            class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                        ></th>
                    </tr>
                </thead>

                <tbody class="bg-white" id="tableList"></tbody>
            </table>
        </div>
    </div>
</div>

<script>
    getRecentSalesData();
    async function getRecentSalesData() {
        showLoader();
        let response = await axios.get("/ProductList");
        hideLoader();

        let productData = response.data;

        console.log(productData)

        let tableList = $("#tableList");
        let tableData = $("#tableData");

        productData.forEach((data, index) => {
            let row = `
                    <tr>
                        <td
                                    class="px-6 py-4 whitespace-no-wrap border-b border-gray-200"
                                >
                                    <div class="text-sm leading-5 text-gray-900">
                                        ${index + 1}
                                    </div>
                                </td>
                                <td
                                    class="px-6 py-4 whitespace-no-wrap border-b border-gray-200"
                                >
                                    <div>
                                        <div
                                            class="text-sm leading-5 font-medium text-gray-900"
                                        >
                                            ${data["name"]}
                                        </div>
                                    </div>

                                </td>

                                <td
                                    class="px-6 py-4 whitespace-no-wrap border-b border-gray-200"
                                >
                                    <div>
                                        <div
                                            class="text-sm leading-5 text-gray-500"
                                        >
                                        ${data["category_id"]}
                                        </div>
                                    </div>

                                </td>

                                <td
                                    class="px-6 py-4 whitespace-no-wrap border-b border-gray-200"
                                >
                                    <div class="text-sm leading-5 text-gray-900">
                                        ${data["price"]}
                                    </div>
                                </td>

                                <td
                                    class="px-6 py-4 whitespace-no-wrap border-b border-gray-200"
                                >
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800"
                                        >${data["unit"]}</span
                                    >
                                </td>

                                <td
                                    class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-red-600"
                                >
                                    x${data["quantity"]}
                                </td>

                                <td
                                    class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-200 text-sm leading-5 font-medium"
                                >
                                    <button class="bg-transparent float-left hover:bg-green-500 text-green-700 font-semibold hover:text-black p-2 border border-green-500 hover:border-transparent rounded">
                                        Update
                                    </button>
                                </td>

                                <td
                                    class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-200 text-sm leading-5 font-medium"
                                >
                                    <button class="bg-transparent float-left hover:bg-red-500 text-red-700 font-semibold hover:text-white p-2 border border-red-500 hover:border-transparent rounded">
                                        Delete
                                    </button>
                                </td>
                            </tr>

                    `;

            tableList.append(row);
        });

        tableData.DataTable({
            order: [[0, "desc"]],
            lengthMenu: [5, 10, 15, 20, 25],
        });
    }
</script>
