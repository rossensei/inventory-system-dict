<script setup>
const props = defineProps({
    property: Object,
})
</script>
<template>
    <div class="w-full max-w-md flex shadow-md rounded-lg">
        <a href="#">
            <img class="rounded-l-lg" src="https://cdn.shopify.com/s/files/1/0070/7032/files/image5_4578a9e6-2eff-4a5a-8d8c-9292252ec848.jpg?v=1620247043" alt="product image" />
        </a>
        <div>
            <a href="#">
                <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">{{ property.item_name }}</h5>
            </a>
            <div class="flex items-center mt-2.5 mb-5">
                {{ property.property_no }}
            </div>
            <div class="flex items-center justify-between">
                <span class="text-3xl font-bold text-gray-900 dark:text-white">{{ property.unit_value }} {{ property.measurement_unit }}</span>
                <!-- <a href="#" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Add to cart</a> -->
            </div>
        </div>
    </div>
</template>