<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Tooltip from '@/Components/Tooltip.vue';
import Dropdown from '@/Components/Dropdown.vue';
import Pagination from '@/Components/Pagination.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import { useRemoveEmptyKeys } from '@/composables/util.js';
import { watch, ref, computed } from 'vue';
import debounce from 'lodash/debounce';

const props = defineProps({
    offices: Object,
    filters: Object,
})

const perPage = ref(props.filters.perPage ?? props.offices.meta.per_page);

const filters = ref({
    search: props.filters?.search,
    classification: props.filters?.classification
});

watch([ () => filters.value.search, () => filters.value.classification], debounce(() => {

    const params = useRemoveEmptyKeys(filters.value);

    router.get(route('office.index'), params, { preserveState: true, replace: true });
}, 300))

watch(perPage, (newPerPageVal) => {
    filters.value.perPage = newPerPageVal;
    const params = useRemoveEmptyKeys(filters.value);

    router.get(route('office.index'), params, { preserveState: true, replace: true });
})
</script>

<template>
    <Head title="Manage Offices" />

    <AppLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Manage Offices</h2>
            <p class="text-sm text-gray-500">Manage list of existing offices</p>
        </template>
        <div class="py-4">
            <div class="w-full px-6">
                <Link :href="route('office.create')" class="px-4 py-2 bg-blue-600 hover:bg-blue-500 text-white text-sm font-medium rounded-lg shadow-sm">New Office</Link>

                <div class="relative overflow-hidden overflow-x-auto shadow-md sm:rounded-lg bg-white mt-4">

                    <div class="flex items-center justify-between p-4">
                        <label for="search" class="relative">
                            <input 
                            id="search"
                            type="search"
                            v-model="filters.search"
                            class="rounded-lg text-sm pl-8 w-[300px] focus:w-[400px] transition-[width] ease-out border-gray-300" 
                            placeholder="Search office by name, classification, location.."
                            >
                    
                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                                </svg>
                            </span>
                        </label>

                        <div class="flex items-center">
                            <div class="flex space-x-4">
                                <!-- <span class="text-sm text-gray-700 font-semibold">Employee Type:</span> -->
                                <label for="show-all" class="text-sm font-semibold text-gray-700 flex items-center">
                                    <input type="radio" v-model="filters.classification" value="" id="show-all" class="text-sm mr-1">
                                    Show All
                                </label>
                                <label for="DICT-DTC" class="text-sm font-semibold text-gray-700 flex items-center">
                                    <input type="radio" v-model="filters.classification" value="DICT-DTC" id="DICT-DTC" class="text-sm mr-1">
                                    DICT-DTC
                                </label>
                                <label for="ted-center" class="text-sm font-semibold text-gray-700 flex items-center">
                                    <input type="radio" v-model="filters.classification" value="Tech4ED Center" id="ted-center" class="text-sm mr-1">
                                    Tech4ED Center
                                </label>
                            </div>
                        </div>
                    </div>

                    <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Office Name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Location
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Date Created
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="office in offices.data" :key="office.id" class="bg-white hover:bg-gray-50 border-b">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                    <div>
                                        <div class="text-[1rem] font-medium text-gray-700">{{ office.office_name }}</div>
                                        <div class="text-sm text-gray-500">{{ office.classification }}</div>
                                    </div>
                                </th>
                                <td class="px-6 py-4">
                                    {{ office.location }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ office.created_at }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center space-x-2">
                                        <Tooltip text="Edit">
                                            <Link :href="route('office.edit', office.id)" class="w-8 h-8 flex justify-center items-center hover:bg-gray-200 rounded-lg">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                                </svg>
                                            </Link>
                                        </Tooltip>
                                        
                                        <Tooltip text="Delete">
                                            <Link :href="route('office.destroy', office.id)" method="DELETE" as="button" class="w-8 h-8 flex justify-center items-center hover:bg-gray-200 rounded-lg">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                </svg>
                                            </Link>
                                        </Tooltip>
                                    </div>
                                </td>
                            </tr>

                            <tr v-show="!props.offices.data.length" class="border-b">
                                <td colspan="6" class="px-6 py-4">No matching results found.</td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="flex items-center justify-between p-4">
                        <label for="per-page" class="text-sm flex items-center">
                            Rows per page:
                            <select id="per-page" v-model="perPage" class="text-sm rounded-lg shadow-sm ml-2">
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="200">200</option>
                            </select>
                    
                            <span class="ml-2">{{ offices.meta.from ?? 0 }} - {{ offices.meta.to ?? 0 }} entries of {{ offices.meta.total ?? 0 }}</span>
                        </label>

                        <Pagination :meta="offices.meta" :links="offices.links" />
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>