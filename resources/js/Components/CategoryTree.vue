<script setup>
import CategoryItem from '@/Components/CategoryItem.vue';

const props = defineProps({
    categories: Array,
})
</script>

<template>
    <div class="flex flex-col space-y-2 bg-white p-2 shadow-sm rounded-lg">
        <template v-if="categories.length">
            <CategoryItem v-for="category in categories" :key="category.id" :category="category" />
        </template>
        <template v-else>
            <div class="p-3 text-sm text-gray-600">
                <h4 class="text-md text-gray-700 font-medium">No records found</h4>
                <p class="text-sm text-gray-500">Add new category to see records here.</p>
            </div>
        </template>
    </div>
</template>
