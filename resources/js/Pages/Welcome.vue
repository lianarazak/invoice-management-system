<script setup>
import { Head, Link } from "@inertiajs/vue3";

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});
</script>

<template>
    <Head title="Welcome" />

    <div
        class="min-h-screen flex items-center justify-center flex-col bg-gray-100 dark:bg-gray-900"
    >
        <!-- Title -->
        <h1
            class="text-5xl font-bold mb-8 text-gray-800 dark:text-white text-center"
        >
            Invoice Management System
        </h1>

        <!-- Buttons -->
        <div v-if="canLogin" class="flex gap-4">
            <template v-if="$page.props.auth.user">
                <Link
                    :href="route('customers.index')"
                    class="bg-blue-600 text-white px-6 py-3 rounded hover:bg-blue-700 font-semibold"
                >
                    Go to Customers
                </Link>
            </template>

            <template v-else>
                <Link
                    :href="route('login')"
                    class="bg-blue-600 text-white px-6 py-3 rounded hover:bg-blue-700 font-semibold"
                >
                    Log in
                </Link>

                <Link
                    v-if="canRegister"
                    :href="route('register')"
                    class="bg-green-600 text-white px-6 py-3 rounded hover:bg-green-700 font-semibold"
                >
                    Register
                </Link>
            </template>
        </div>
    </div>
</template>

<style>
.bg-dots-darker {
    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E");
}
@media (prefers-color-scheme: dark) {
    .dark\:bg-dots-lighter {
        background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
    }
}
</style>
