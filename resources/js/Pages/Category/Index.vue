<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import CategoryTree from '@/Components/CategoryTree.vue';
import { Head, Link } from '@inertiajs/vue3';
import store from '../../store.js';

const props = defineProps({
    categories: Object,
})

</script>

<template>
    <Head title="Categories" />

    <AppLayout>
        <template #header>
            <div class="flex space-x-2 items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Manage Categories</h2>
                <Link :href="route('category.create')" class="px-4 py-2 text-white text-sm font-medium bg-blue-600 hover:bg-blue-500 rounded-lg">Add Category</Link>
            </div>
        </template>

        <div class="py-4">
            <div class="w-full px-6">
                <div class="max-w-3xl w-full">
                    <h4 class="text-md text-gray-700 font-medium mb-2">All Categories</h4>
                    <div id="container">
                        <CategoryTree :categories="categories.data" />
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>