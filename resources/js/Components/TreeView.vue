<script setup>
import TreeNode from '@/Components/TreeNode.vue';
import { ref } from 'vue';

const props = defineProps({
    categories: Array,
})
</script>

<template>
    <div class="flex flex-col space-y-2">
        <TreeNode v-for="node in categories" :key="node.id" :node="node" />
    </div>
</template>