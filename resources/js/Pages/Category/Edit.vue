<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm, Head, Link } from '@inertiajs/vue3';

const props = defineProps({
    category: Object,
})

const form = useForm({
    category_name: props.category.category_name,
})

const submit = () => {
    form.patch(route('category.update', props.category.id))
}

</script>
<template>
    <Head :title="`Edit ${props.category.category_name}`" />

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
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit category</h2>
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

                    <button type="submit" class="px-4 py-2 bg-blue-700 hover:bg-blue-600 text-sm text-white rounded-lg inline-flex items-center" :disabled="form.processing">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 mr-1">
                        <path fill-rule="evenodd" d="M19.916 4.626a.75.75 0 0 1 .208 1.04l-9 13.5a.75.75 0 0 1-1.154.114l-6-6a.75.75 0 0 1 1.06-1.06l5.353 5.353 8.493-12.74a.75.75 0 0 1 1.04-.207Z" clip-rule="evenodd" />
                        </svg>
                        Save
                    </button>
                </form>
            </div>
        </div>
    </AppLayout>
</template>