<template>
    <Head title="Customer" />
    <!-- <pre>{{ customers.data }}</pre> -->

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Invoice Management System
                </h2>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="flex items-center justify-between mb-4">
                            <h2
                                class="font-semibold text-xl text-gray-800 leading-tight"
                            >
                                Customer
                            </h2>
                            <Link
                                href="/customers/create"
                                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600"
                            >
                                + Create Customer
                            </Link>
                        </div>
                        <table class="w-full table-auto border border-gray-200">
                            <thead>
                                <tr class="bg-gray-100 text-left">
                                    <th class="p-2 border">#</th>
                                    <th class="p-2 border">Name</th>
                                    <th class="p-2 border">Email</th>
                                    <th class="p-2 border">Phone</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="(customers, index) in customers.data"
                                    :key="customers.id"
                                >
                                    <td class="p-2 border">{{ index + 1 }}</td>
                                    <td class="p-2 border">
                                        {{ customers.name }}
                                    </td>
                                    <td class="p-2 border">
                                        {{ customers.email }}
                                    </td>
                                    <td class="p-2 border">
                                        {{ customers.phone }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <!-- Pagination (optional) -->
                        <div class="mt-4">
                            <!-- <span v-if="customers.total > customers.per_page"> -->
                            Showing {{ customers.from }} to
                            {{ customers.to }} of {{ customers.total }}
                            <!-- </span> -->
                        </div>
                        <div class="mt-6 flex justify-center space-x-2">
                            <template
                                v-for="(link, index) in customers.links"
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
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";

defineProps({
    customers: Object,
});
</script>
