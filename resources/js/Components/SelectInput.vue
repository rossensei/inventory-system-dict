<script setup>
const model = defineModel({
    required: true,
});
</script>

<template>
    <select v-model="model" id="category" class="border-gray-300 hover:border-gray-400 focus:border-sky-500 focus:ring-sky-500 rounded-lg shadow-sm">
        <slot />
    </select>
</template>
