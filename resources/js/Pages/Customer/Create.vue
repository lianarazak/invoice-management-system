<template>
    <Head title="Create Customer" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create Customer
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white p-6 rounded shadow">
                    <form @submit.prevent="submit">
                        <div class="mb-4">
                            <label class="block text-sm font-medium"
                                >Name</label
                            >
                            <input
                                v-model="form.name"
                                type="text"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                required
                            />
                            <div
                                v-if="form.errors.name"
                                class="text-red-600 text-sm"
                            >
                                {{ form.errors.name }}
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium"
                                >Email</label
                            >
                            <input
                                v-model="form.email"
                                type="email"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                required
                            />
                            <div
                                v-if="form.errors.email"
                                class="text-red-600 text-sm"
                            >
                                {{ form.errors.email }}
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium"
                                >Phone</label
                            >
                            <input
                                v-model="form.phone"
                                type="tel"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                                required
                            />
                            <div
                                v-if="form.errors.phone"
                                class="text-red-600 text-sm"
                            >
                                {{ form.errors.phone }}
                            </div>
                        </div>

                        <div>
                            <button
                                type="submit"
                                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"
                                :disabled="form.processing"
                            >
                                Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import { Head, useForm, router } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

const form = useForm({
    name: "",
    email: "",
    phone: "",
});

const submit = () => {
    form.post("/customers", {
        onSuccess: () => {
            router.visit("/customers"); // Redirect to list
        },
    });
};
</script>
