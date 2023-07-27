<h3 class="text-gray-700 text-3xl font-medium">Sales Management</h3>

<div class="mt-8"></div>

@include('components.sale.sale-create')

<h3 class="text-gray-700 text-xl font-semibold">Sales Record</h3>
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
                            Name
                        </th>
                        <th
                            class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                        >
                            Date
                        </th>
                        <th
                            class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                        >
                            Product
                        </th>
                        <th
                            class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                        >
                            Category
                        </th>


                        <th
                            class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                        >
                            Price (Unit)
                        </th>
                        <th
                            class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                        >
                            Qty
                        </th>
                        <th
                            class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                        >
                            Unit
                        </th>
                        <th
                            class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                        >
                            Price (Total)
                        </th>
                        <th
                            class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                        >
                            INVOICE
                        </th>
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
        let response = await axios.get("/getSalesInfo");
        hideLoader();

        let salesData = response.data.data;

        let tableList = $("#tableList");
        let tableData = $("#tableData");

        salesData.forEach((data, index) => {
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
                                            ${data["customer_name"]}
                                        </div>
                                        <div
                                            class="text-sm leading-5 text-gray-500"
                                        >
                                        ${data["customer_email"]}
                                        </div>
                                    </div>

                                </td>

                                <td
                                    class="px-6 py-4 whitespace-no-wrap border-b border-gray-200"
                                >
                                    <div class="text-sm leading-5 text-gray-900">
                                        ${data["sales_date"].slice(0, 10)}
                                    </div>
                                </td>

                                <td
                                    class="px-6 py-4 whitespace-no-wrap border-b border-gray-200"
                                >
                                    <div class="text-sm leading-5 text-gray-900">
                                        ${data["product_name"]}
                                    </div>
                                </td>

                                <td
                                    class="px-6 py-4 whitespace-no-wrap border-b border-gray-200"
                                >
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800"
                                        >${data["category_name"]}</span
                                    >
                                </td>

                                <td
                                    class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-red-600"
                                >
                                    $${data["unit_price"]}
                                </td>

                                <td
                                    class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-900"
                                >
                                    x${data["purchased_quantity"]}
                                </td>

                                <td
                                    class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-900"
                                >
                                ${data["product_unit"]}
                                </td>

                                <td
                                    class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-red-600"
                                >
                                    $${data["total_price"]}
                                </td>

                                <td
                                    class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-200 text-sm leading-5 font-medium"
                                >
                                    <button class="bg-transparent float-left hover:bg-blue-500 text-blue-700 font-semibold hover:text-white p-2 border border-blue-500 hover:border-transparent rounded">
                                        Print
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
