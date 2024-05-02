<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import SelectInput from '@/Components/SelectInput.vue';
import TextInput from '@/Components/TextInput.vue';
import Breadcrumb from '@/Components/Breadcrumb.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm, Head, Link } from '@inertiajs/vue3';
import { onMounted, ref } from 'vue';

const props = defineProps({
    categories: Array,
})

// const categories = ref([]);

// function formatCategories(categories, path = '') {
//     let result = [];
//     categories.forEach(category => {
//         const newPath = path === '' ? category.category_name : `${path} / ${category.category_name}`;
//         if (category.children.length === 0) {
//             result.push({
//                 id: category.id,
//                 category_name: category.category_name,
//                 path: newPath
//             });
//         } else {
//             result = result.concat(formatCategories(category.children, newPath));
//         }
//     });
//     return result;
// }

// onMounted(() => categories.value = formatCategories(props.categories.data))


const form = useForm({
    parent_id: null,
    category_name: '',
})

const submit = () => {
    form.post(route('category.store'), {
        onSuccess: () => form.reset()
    })
}
</script>
<template>
    <Head title="New Category" />

    <AppLayout>
        <template #header>
            <div class="flex items-center divide-x divide-gray-200">
                <div class="px-2">
                    <Link :href="route('category.index')" class="h-8 w-8 rounded-lg hover:bg-gray-200 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75 3 12m0 0 3.75-3.75M3 12h18" />
                          </svg>                          
                    </Link>
                </div>
                <div class="px-2">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">Add new category</h2>
                </div>
            </div>
        </template>
        <div class="py-4">
            <div class="w-full px-6">
                <form @submit.prevent="submit" class="max-w-xl">
                    <div class="mb-4">
                        <InputLabel for="category_name" value="Category name" />
                        <TextInput v-model="form.category_name" id="category_name" class="w-full text-sm" />
                        <InputError :message="form.errors.category_name" />
                    </div>
                    <div class="mb-4">
                        <InputLabel for="parent_id" value="Parent Category (Optional)" />
                        <SelectInput id="parent_id" v-model="form.parent_id" class="w-full text-sm">
                            <option value="null">Select parent category</option>
                            <option v-for="category in categories" :key="category.id" :value="category.id">{{ category.category_name }}</option>
                        </SelectInput>
                    </div>

                    <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-500 text-sm text-white font-medium rounded-lg inline-flex items-center">
                        Submit
                    </button>
                </form>
            </div>
        </div>
    </AppLayout>
</template>