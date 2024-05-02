<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    href: {
        type: String,
        required: true
    },
    class: {
        type: String,
        default: 'px-4 py-2 text-sm text-white font-medium bg-blue-600 hover:bg-blue-500 rounded-lg shadow-md'
    }
})

</script>

<template>
    <Link :href="href" :class="class">
        <slot />
    </Link>
</template>