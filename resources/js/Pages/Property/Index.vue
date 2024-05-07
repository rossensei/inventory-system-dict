<script setup>
import Pagination from '@/Components/Pagination.vue';
import TextInput from '@/Components/TextInput.vue';
import Dropdown from '@/Components/Dropdown.vue';
import PropertyComponent from '@/Components/PropertyComponent.vue';
import LinkButton from '@/Components/LinkButton.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import { watch, ref, reactive } from 'vue';
import { useRemoveEmptyKeys } from '@/composables/util.js';
import debounce from 'lodash/debounce';

const props = defineProps({
    properties: Object,
    filters: Object
})

const filters = reactive({
    search: props.filters?.search,
    status: props.filters?.status
});

watch([() => filters.search, () => filters.status], debounce(() => {

    const params = useRemoveEmptyKeys(filters);

    router.get(route('property.index'), params, { preserveState: true, replace: true });
}, 300))

const perPage = ref(props.filters.perPage ?? props.properties.meta.per_page);

watch(perPage, (newPerPageVal) => {
    filters.perPage = newPerPageVal;
    const params = useRemoveEmptyKeys(filters);

    router.get(route('property.index'), params, { preserveState: true, replace: true });
})
</script>
<template>
    <Head title="All Properties" />
    <AppLayout>
        <template #header>
            <div class="flex items-end justify-between">
                <div>
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">Properties</h2>
                    <p class="text-sm text-gray-500">Manage list of owned assets/properties of DICT.</p>
                </div>

                <Link :href="route('property.create')" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-500 text-sm text-white font-medium rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 mr-1">
                        <path fill-rule="evenodd" d="M12 3.75a.75.75 0 0 1 .75.75v6.75h6.75a.75.75 0 0 1 0 1.5h-6.75v6.75a.75.75 0 0 1-1.5 0v-6.75H4.5a.75.75 0 0 1 0-1.5h6.75V4.5a.75.75 0 0 1 .75-.75Z" clip-rule="evenodd" />
                        </svg>
                        
                    Create property
                </Link>
            </div>
        </template>

        <div class="py-4 px-6 w-full">
            <div class="flex items-start mb-8">
                <!-- Category Filter -->
                <!-- <div class="shrink-0 bg-white shadow-sm p-4 w-[14rem] rounded-lg">
                    <h1 class="text-sm font-medium text-gray-700">Category Filter</h1>

                    <ul class="text-sm">
                        <li>
                            <a href="#">Electronics</a>
                            <ul class="ml-3">
                                <li><a href="#">Computers</a></li>
                                <li><a href="#">Tablets</a></li>
                                <li><a href="#">Laptops</a></li>
                            </ul>
                        </li>
                        <li>Furnitures</li>
                        <li>Machinery/Equipments</li>
                        <li>Vehicles</li>
                    </ul>
                </div> -->

                <div class="flex-1 bg-white p-4 shadow-sm rounded-lg">
                    <div class="mb-4">
                        <div class="flex justify-between items-center">
                            <label for="search" class="relative">
                                <input 
                                id="search"
                                type="search"
                                v-model="filters.search"
                                class="rounded-lg text-sm pl-8 w-[300px] focus:w-[400px] transition-[width] ease-out border-gray-300" 
                                placeholder="Search keyword"
                                >
                        
                                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                                    </svg>
                                </span>
                            </label>
                            
                            <div class="flex space-x-4">
                                <label for="show-all" class="text-sm font-semibold text-gray-700 flex items-center">
                                    <input type="radio" v-model="filters.status" value="" id="show-all" class="text-sm mr-1">
                                    Show All
                                </label>
                                <label for="serviceable" class="text-sm font-semibold text-gray-700 flex items-center">
                                    <input type="radio" v-model="filters.status" value="Serviceable" id="serviceable" class="text-sm mr-1">
                                    Serviceable
                                </label>
                                <label for="unserviceable" class="text-sm font-semibold text-gray-700 flex items-center">
                                    <input type="radio" v-model="filters.status" value="Unserviceable" id="unserviceable" class="text-sm mr-1">
                                    Unserviceable
                                </label>
                            </div>
                        </div>
                    </div>
                    <table class="w-full text-sm">
                        <thead class="text-gray-600 font-medium border-t border-b">
                            <th class="px-6 py-3 text-left w-8">Image</th>
                            <th class="px-6 py-3 text-left">Name</th>
                            <th class="px-6 py-3 text-left">Property number</th>
                            <th class="px-6 py-3 text-left">Category</th>
                            <th class="px-6 py-3 text-left">Unit Value</th>
                            <th class="px-6 py-3 text-left">Measurement Unit</th>
                            <th class="px-6 py-3 text-left">Status</th>
                            <th class="px-6 py-3 text-center w-28">Action</th>
                        </thead>
                        <tbody>
                            <tr v-for="property in properties.data" :key="property.id" class="border-b">
                                <td class="px-6 py-3">
                                    <div class="h-14 w-20 overflow-hidden bg-gray-400 rounded-lg">
                                        <img v-if="property.photo" :src="property.photo" alt="" class="bg-cover h-full w-full">
                                        <img v-else src="https://primefaces.org/cdn/primevue/images/product/bamboo-watch.jpg" alt="" class="bg-cover h-full w-full">
                                    </div>
                                </td>
                                <td class="px-6 py-3">
                                    {{ property.item_name }}
                                </td>
                                <td class="px-6 py-3">
                                    {{ property.property_no }}
                                </td>
                                <td class="px-6 py-3">
                                    {{ property.category.category_name}}
                                </td>
                                <td class="px-6 py-3">
                                    {{ property.unit_value }}
                                </td>
                                <td class="px-6 py-3">
                                    {{ property.measurement_unit }}
                                </td>
                                <td class="px-6 py-3">
                                    {{ property.status }}
                                </td>
                                <td class="px-6 py-3">
                                    <div class="flex items-center justify-center">
                                        <Dropdown align="right">
                                            <template #trigger>
                                                <span class="w-8 h-8 flex justify-center items-center hover:bg-gray-200 rounded-lg cursor-pointer">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM12.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM18.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                                                    </svg>                                                  
                                                </span>
                                            </template>
    
                                            <template #content>
                                                <div class="flex flex-col py-1 text-left">
                                                    <Link :href="route('property.show', property.id)" class="px-3 py-2 text-sm hover:bg-gray-50">View more details</Link>
                                                    <Link :href="route('property.edit', property.id)" class="px-3 py-2 text-sm hover:bg-gray-50">Edit item details</Link>
                                                    <Link :href="route('property.destroy', property.id)" as="button" method="DELETE" class="text-left px-3 py-2 text-sm hover:bg-gray-50">Delete</Link>
                                                </div>
                                            </template>
                                        </Dropdown>
                                    </div>
                                    
                                </td>
                            </tr>

                            <tr v-show="!props.properties.data.length" class="border-b">
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
                    
                            <span class="ml-2">{{ properties.meta.from ?? 0 }} - {{ properties.meta.to ?? 0 }} entries of {{ properties.meta.total ?? 0 }}</span>
                        </label>

                        <Pagination :meta="properties.meta" :links="properties.links" />
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>