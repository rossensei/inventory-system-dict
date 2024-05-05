<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import CategoryTree from '@/Components/CategoryTree.vue';
import Dropdown from '@/Components/Dropdown.vue';
import Pagination from '@/Components/Pagination.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import store from '../../store.js';
import { watch, ref, reactive } from 'vue';
import debounce from 'lodash/debounce.js';
import { useRemoveEmptyKeys } from '@/composables/util.js'

const props = defineProps({
    categories: Object,
    filters: Object
})

const query = reactive({
    search: props.filters?.search
})

const perPage = ref(props.filters?.perPage ?? 10);

watch(() => query.search, debounce(() => {

    console.log(query)
    const params = useRemoveEmptyKeys(query);

    router.get(route('category.index'), params, {
        preserveState: true,
        replace: true
    });

}, 300), {
    deep: true
})

watch(perPage, (newValue) => {

    query.perPage = newValue;
    const params = useRemoveEmptyKeys(query);

    router.get(route('category.index'), params, {
        preserveState: true,
        replace: true
    });
})
</script>

<template>
    <Head title="Categories" />

    <AppLayout>
        <template #header>
            <div class="flex space-x-2 items-center justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Manage Categories</h2>
                <Link :href="route('category.create')" class="inline-flex items-center px-4 py-2 text-white text-sm font-medium bg-blue-600 hover:bg-blue-500 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 mr-1">
                        <path fill-rule="evenodd" d="M19.5 21a3 3 0 0 0 3-3V9a3 3 0 0 0-3-3h-5.379a.75.75 0 0 1-.53-.22L11.47 3.66A2.25 2.25 0 0 0 9.879 3H4.5a3 3 0 0 0-3 3v12a3 3 0 0 0 3 3h15Zm-6.75-10.5a.75.75 0 0 0-1.5 0v2.25H9a.75.75 0 0 0 0 1.5h2.25v2.25a.75.75 0 0 0 1.5 0v-2.25H15a.75.75 0 0 0 0-1.5h-2.25V10.5Z" clip-rule="evenodd" />
                    </svg>
                      
                    Add Category
                </Link>
            </div>
        </template>

        <div class="py-4">
            <div class="w-full px-6">
                <div class="flex-1 bg-white p-4 shadow-sm rounded-lg">
                    <div class="mb-4">
                        <div class="flex justify-between items-center">
                            <label for="search" class="relative">
                                <input 
                                id="search"
                                type="search"
                                v-model="query.search"
                                class="rounded-lg text-sm pl-8 w-[300px] focus:w-[400px] transition-[width] ease-out border-gray-300" 
                                placeholder="Search keyword"
                                >
                        
                                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                                    </svg>
                                </span>
                            </label>
                            
                            <!-- <div class="flex space-x-4">
                                <label for="show-all" class="text-sm font-semibold text-gray-700 flex items-center">
                                    <input type="radio" value="" id="show-all" class="text-sm mr-1">
                                    Show All
                                </label>
                                <label for="serviceable" class="text-sm font-semibold text-gray-700 flex items-center">
                                    <input type="radio" value="Serviceable" id="serviceable" class="text-sm mr-1">
                                    Serviceable
                                </label>
                                <label for="unserviceable" class="text-sm font-semibold text-gray-700 flex items-center">
                                    <input type="radio" value="Unserviceable" id="unserviceable" class="text-sm mr-1">
                                    Unserviceable
                                </label>
                            </div> -->
                        </div>
                    </div>
                    <table class="w-full text-sm">
                        <thead class="text-gray-600 font-medium border-t border-b">
                            <th class="px-6 py-4 text-left w-28">ID</th>
                            <th class="px-6 py-4 text-left">Name</th>
                            <th class="px-6 py-4 text-left">Parent Category</th>
                            <th class="px-6 py-4 text-center w-44">Action</th>
                        </thead>
                        <tbody>
                            <tr v-for="category in categories.data" :key="category.id" class="border-b">
                                <td class="px-6 py-4">
                                    {{ category.id }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ category.category_name }}
                                </td>
                                <td class="px-6 py-4 text-left">
                                    {{ category.parent?.category_name ?? '-' }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-center space-x-3">
                                        <Link :href="route('category.edit', category.id)" class="w-8 h-8 flex justify-center items-center hover:bg-gray-200 rounded-lg cursor-pointer">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                              </svg>                                                                                               
                                        </Link>

                                        <Link :href="route('category.destroy', category.id)" as="button" method="DELETE" class="w-8 h-8 flex justify-center items-center hover:bg-gray-200 rounded-lg cursor-pointer">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                            </svg>                                                                                              
                                        </Link>
                                    </div>
                                    
                                </td>
                            </tr>

                            <tr v-show="!props.categories.data.length" class="border-b">
                                <td colspan="7" class="px-6 py-4">No matching results found.</td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="flex items-center justify-between mt-4">
                        <label for="per-page" class="text-sm flex items-center">
                            Rows per page:
                            <select id="per-page" v-model="perPage" class="text-sm rounded-lg shadow-sm ml-2">
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="200">200</option>
                            </select>
                    
                            <span class="ml-2">{{ categories.meta.from ?? 0 }} - {{ categories.meta.to ?? 0 }} entries of {{ categories.meta.total ?? 0 }}</span>
                        </label>

                        <Pagination :meta="categories.meta" :links="categories.links" />
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>