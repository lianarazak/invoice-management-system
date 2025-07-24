<template>
    <Head title="Create Invoice" />
    <!-- <pre>{{ customers.data }}</pre> -->

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create Invoice
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white p-8 rounded-lg shadow">
                    <form @submit.prevent="submitInvoice" class="space-y-6">
                        <div>
                            <label
                                class="block text-sm font-medium text-gray-700 mb-1"
                            >
                                Customer
                            </label>
                            <select
                                v-model="form.customer_id"
                                class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200"
                                required
                            >
                                <option value="" disabled>
                                    Select customer
                                </option>
                                <option
                                    v-for="c in customers"
                                    :value="c.id"
                                    :key="c.id"
                                >
                                    {{ c.name }}
                                </option>
                            </select>
                        </div>

                        <div class="space-y-6">
                            <div
                                v-for="(item, index) in form.line_items"
                                :key="index"
                                class="grid grid-cols-1 sm:grid-cols-4 gap-4"
                            >
                                <div>
                                    <label
                                        class="block text-sm font-medium text-gray-700 mb-1"
                                    >
                                        Product Name
                                    </label>
                                    <input
                                        v-model="item.product_name"
                                        placeholder="Product Name"
                                        class="w-full border-gray-300 rounded-md shadow-sm"
                                        required
                                    />
                                </div>
                                <div>
                                    <label
                                        class="block text-sm font-medium text-gray-700 mb-1"
                                    >
                                        Quantity
                                    </label>
                                    <input
                                        v-model.number="item.quantity"
                                        type="number"
                                        placeholder="Quantity"
                                        class="w-full border-gray-300 rounded-md shadow-sm"
                                        required
                                    />
                                </div>
                                <div>
                                    <label
                                        class="block text-sm font-medium text-gray-700 mb-1"
                                    >
                                        Price Per Unit
                                    </label>
                                    <input
                                        v-model.number="item.price_per_unit"
                                        type="number"
                                        step="any"
                                        placeholder="Price Per Unit"
                                        class="w-full border-gray-300 rounded-md shadow-sm"
                                        required
                                    />
                                </div>
                                <div>
                                    <label
                                        class="block text-sm font-medium text-gray-700 mb-1"
                                    >
                                        Price
                                    </label>
                                    <input
                                        :value="
                                            item.quantity * item.price_per_unit
                                        "
                                        type="number"
                                        step="any"
                                        class="w-full border-gray-200 bg-gray-100 rounded-md shadow-sm"
                                        readonly
                                    />
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center gap-4 mt-6">
                            <button
                                type="button"
                                @click="addLineItem"
                                class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md"
                            >
                                + Add Item
                            </button>
                            <button
                                type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-md"
                            >
                                Save Invoice
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, router } from "@inertiajs/vue3";

const customers = ref([]);
const form = ref({
    customer_id: "",
    line_items: [
        { product_name: "", quantity: 1, price_per_unit: 0, price: 0 },
    ],
});

const addLineItem = () => {
    form.value.line_items.push({
        product_name: "",
        quantity: 1,
        price_per_unit: 0,
        price: 0,
    });
};

const submitInvoice = async () => {
    try {
        // Calculate total price for each item before sending to backend
        form.value.line_items.forEach((item) => {
            item.price = item.quantity * item.price_per_unit;
        });

        const result = await axios.post("/invoices", form.value);

        if (result.status === 200 || result.status === 201) {
            alert("Invoice created!");
            router.visit("/invoices");
        }
    } catch (error) {
        console.error("Failed to create invoice:", error);
        alert("Something went wrong while creating the invoice.");
    }
};

onMounted(async () => {
    const res = await axios.get("/api/customers");

    customers.value = res.data.data;

    console.log("customers", customers.value);
});
</script>
