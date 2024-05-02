<script setup>
const props = defineProps({
    maxWidth: {
        type: [String, null]
    }
})
</script>

<template>
    <div class="bg-white rounded-lg shadow-sm divide-y divide-gray-200" :style="'width:' + maxWidth + 'px' ">
        <div v-show="$slots.title" class="px-4 py-2">
            <slot name="title" />
        </div>

        <div class="p-2">
            <slot name="body" />
        </div>
    </div>
</template>