<template>
    <Head title="Invoices" />
    <!-- <pre>{{ invoices }}</pre> -->

    <AuthenticatedLayout>
        <template #header>
            <!-- <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Customer
            </h2> -->
            <Link
                href="/invoices/create"
                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600"
            >
                + Create Invoice
            </Link>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <table class="w-full table-auto border border-gray-200">
                            <thead>
                                <tr class="bg-gray-100 text-left">
                                    <th class="p-2 border">#</th>
                                    <th class="p-2 border">Customer</th>
                                    <th class="p-2 border">Product Name</th>
                                    <th class="p-2 border">Total Price (RM)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="(invoices, index) in invoices.data"
                                    :key="invoices.id"
                                >
                                    <td class="p-2 border">{{ index + 1 }}</td>
                                    <td class="p-2 border">
                                        {{ invoices.customer?.name ?? "" }}
                                    </td>
                                    <!-- <td class="p-2 border">
                                        {{ invoices.phone }}
                                    </td> -->
                                    <td class="p-2 border">
                                        <ul
                                            class="list-disc list-inside text-sm text-gray-700"
                                        >
                                            <li
                                                v-for="(
                                                    item, i
                                                ) in invoices.invoice_lines"
                                                :key="i"
                                            >
                                                {{ item.product_name }} (x{{
                                                    item.quantity
                                                }}) @ RM{{ item.price }}
                                            </li>
                                        </ul>
                                    </td>
                                    <td class="p-2 border">
                                        {{ invoices.total }}
                                    </td>
                                    <!-- <td class="p-2 border">
                                        <span class="text-gray-400 italic"
                                            >Coming soon</span
                                        >
                                    </td> -->
                                </tr>
                            </tbody>
                        </table>

                        <!-- Pagination (optional) -->
                        <div class="mt-4">
                            <!-- <span v-if="invoices.total > invoices.per_page"> -->
                            Showing {{ invoices.from }} to {{ invoices.to }} of
                            {{ invoices.total }}
                            <!-- </span> -->
                        </div>
                        <div class="mt-6 flex justify-center space-x-2">
                            <template
                                v-for="(link, index) in invoices.links"
                                :key="index"
                            >
                                <button
                                    v-if="link.url"
                                    :class="{
                                        'px-3 py-1 rounded border': true,
                                        'bg-blue-500 text-white': link.active,
                                        'bg-white text-gray-700': !link.active,
                                    }"
                                    @click="$inertia.visit(link.url)"
                                    v-html="link.label"
                                />
                            </template>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";

defineProps({
    invoices: Object,
});
// const customers = ref([]);
// const form = ref({
//     customer_id: "",
//     line_items: [{ product_name: "", quantity: 1, price: 0 }],
// });

// const addLineItem = () => {
//     form.value.line_items.push({ product_name: "", quantity: 1, price: 0 });
// };

// const submitCustomer = async () => {
//     await axios.post("/api/invoices", form.value);
//     alert("Invoice created!");
// };

// onMounted(async () => {
//     const res = await axios.get("/api/customers");
//     customers.value = res.data.data;
// });
</script>
