<script setup>
const model = defineModel({
    type: String,
    required: true,
});

</script>

<template>
    <textarea 
    class="border-gray-300 hover:border-gray-400 focus:border-sky-500 focus:ring-sky-500 rounded-lg shadow-sm"
    v-model="model"
    ></textarea>
</template>
