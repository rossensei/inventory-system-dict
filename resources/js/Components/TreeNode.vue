<script setup>
import { computed, ref } from 'vue';
import store from '../store.js';
import { useCollapse } from '@/composables/categories.js';

const props = defineProps({
    node: Object,
})

const { toggleCollapse, selectNode } = useCollapse();
const isChild = computed(() => !!props.node.parent_id);
const isCollapsed = computed(() => store.collapsedNodes.includes(props.node.id))
</script>

<template>
    <div :class="{ 'ml-10' : isChild }">
        <div class="flex items-center hover:bg-gray-100 rounded-lg">

            <div class="shrink-0 p-3">
                <span class="text-gray-500">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                        <path d="M19.5 21a3 3 0 0 0 3-3v-4.5a3 3 0 0 0-3-3h-15a3 3 0 0 0-3 3V18a3 3 0 0 0 3 3h15ZM1.5 10.146V6a3 3 0 0 1 3-3h5.379a2.25 2.25 0 0 1 1.59.659l2.122 2.121c.14.141.331.22.53.22H19.5a3 3 0 0 1 3 3v1.146A4.483 4.483 0 0 0 19.5 9h-15a4.483 4.483 0 0 0-3 1.146Z" />
                      </svg>                      
                </span>
            </div>
            
            <div class="flex-1 text-sm py-3" @click="selectNode(node)">
                <span :class="[ store.selectedNode.id == node.id ? 'font-medium text-gray-900' : 'text-gray-600' ]">{{ node.category_name }}</span>
            </div>
            <div class="w-[30px] shrink-0">
                <span v-show="node.children.length" class="w-6 h-6 flex justify-center items-center hover:bg-gray-200 rounded-lg cursor-pointer select-none" @click="toggleCollapse(node.id)">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 transition-transform" :class="{ 'rotate-90' : isCollapsed }">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                    </svg>                               
                </span>                    
            </div>
        </div>


        <template v-if="node.children.length && isCollapsed">
            <TreeNode v-for="node in node.children" :key="node.id" :node="node" />
        </template>
    </div>
</template>