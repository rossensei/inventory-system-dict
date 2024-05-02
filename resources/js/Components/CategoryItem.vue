<script setup>
import { computed, ref } from "vue"
import store from '../store.js';
import { useCollapse } from '@/composables/categories.js';
import { useForm, router } from '@inertiajs/vue3';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';

const props = defineProps({
    category: Object,
})

const isChild = computed(() => !!props.category.parent_id);
const isCollapsed = computed(() => store.collapsedCategories.includes(props.category.id));
const { toggleCollapse } = useCollapse();

// Edit
const form = useForm({
    category_name: props.category.category_name,
})

const isEdit = ref(false);

const editItem = () => {
    isEdit.value = true;
}

const cancelEdit = () => {
    isEdit.value = false;
    
    if(form.hasErrors) {
        form.clearErrors();
    }
}

const updateItem = () => {
    form.patch(route('category.update', props.category.id), {
        onSuccess: () => cancelEdit()
    })
}

// Delete
const deleteItem = () => {
    router.delete(route('category.destroy', props.category.id));
}
</script>

<template>
    <div :class="{ 'ml-10' : isChild }">
        <div class="flex items-start space-x-2 hover:bg-gray-50 rounded-lg">
            <div class="shrink-0 py-3 pl-3">
                <span v-show="category.children.length" class="w-8 h-8 flex justify-center items-center hover:bg-gray-200 rounded-lg cursor-pointer select-none" @click="toggleCollapse(category.id)">
                    <svg v-if="!isCollapsed" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    <svg v-else xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14" />
                    </svg>                                      
                </span>
            </div>
            <div class="flex-1 py-3">
                <span v-if="!isEdit" class="text-sm text-gray-700">{{ category.category_name }}</span>
                <div v-else>
                    <TextInput v-model="form.category_name" @keydown.enter="updateItem" type="text"  class="w-full text-sm rounded-lg" :class="[ form.errors.category_name ? 'border-red-600' : 'border-gray-300' ]" />
                    <InputError :message="form.errors.category_name" />
                </div>                
            </div>
            <div class="shrink-0 py-3 pr-3">
                <div v-if="!isEdit" class="flex items-center space-x-2">
                    <button type="button" @click="editItem" class="w-8 h-8 flex justify-center items-center hover:bg-gray-200 rounded-lg cursor-pointer select-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                          </svg>                          
                    </button>
                    <button type="button" @click="deleteItem" class="w-8 h-8 flex justify-center items-center hover:bg-gray-200 rounded-lg cursor-pointer select-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                        </svg>
                    </button>
                </div>

                <div v-else class="flex items-center divide-x divide-gray-300">
                    <div class="px-2">
                        <button type="button" @click="updateItem" class="w-8 h-8 flex justify-center items-center hover:bg-gray-200 rounded-lg cursor-pointer select-none">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>                                                   
                        </button>
                    </div>
                    <div class="px-2">
                        <button type="button" @click="cancelEdit" class="w-8 h-8 flex justify-center items-center hover:bg-gray-200 rounded-lg cursor-pointer select-none">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                              </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
        <template v-if="category.children.length && isCollapsed">
            <CategoryItem v-for="category in category.children" :key="category.id" :category="category" />
        </template>
    </div>
</template>
