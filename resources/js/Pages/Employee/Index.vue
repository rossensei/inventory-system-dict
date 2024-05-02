<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Tooltip from '@/Components/Tooltip.vue';
import Modal from '@/Components/Modal.vue';
import TextInput from '@/Components/TextInput.vue';
import FallbackUserPhoto from '@/Components/FallbackUserPhoto.vue';
import Pagination from '@/Components/Pagination.vue';
import debounce from 'lodash/debounce';
import { ref, watch, computed, onMounted, onUpdated } from 'vue';
import { Head, Link, router, usePage } from '@inertiajs/vue3';
import { useRemoveEmptyKeys } from '@/composables/util.js';

const props = defineProps({
    employees: Object,
    filters: Object
})

const perPage = ref(props.filters.perPage ?? props.employees.meta.per_page);

const filters = ref({
    search: props.filters.search,
    empType: props.filters.empType,
    status: props.filters.status,
    role: props.filters.role
});

watch([() => filters.value.search, () => filters.value.empType, () => filters.value.status, () => filters.value.role], debounce(() => {

    const params = useRemoveEmptyKeys(filters.value);

    router.get(route('employee.index'), params, { preserveState: true, replace: true })
}, 300), {
    deep: true
})

watch(perPage, (newPerPageVal) => {

    filters.value.perPage = newPerPageVal;
    const params = useRemoveEmptyKeys(filters.value);

    router.get(route('employee.index'), params, { preserveState: true, replace: true })
})

const clearAllFilters = () => {
    if(!filters.value.search && !filters.value.empType && !filters.value.status && !filters.value.role) {
        return;
    }
    filters.value.search = null;
    filters.value.empType = null;
    filters.value.status = null;
    filters.value.role = null;
}
</script>

<template>
    <Head title="Employees" />
    <AppLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Employees</h2>
            <p class="text-sm text-gray-500">Manage all the information of the employees.</p>
        </template>
        <div class="py-4">
            <div class="w-full px-6">
                <div class="flex justify-between items-center mb-4">

                    <Link href="/employees/create" class="px-4 py-2 bg-blue-600 hover:bg-blue-500 text-sm text-white font-medium rounded-md">Add Employee</Link>

                    <button type="button" @click="clearAllFilters" class="px-4 py-2 bg-transparent hover:bg-gray-200 rounded-lg text-sm font-medium border border-gray-300">Clear filters</button>
                </div>
    
                <div class="relative overflow-hidden overflow-x-auto shadow-md sm:rounded-lg bg-white">

                    <div class="flex items-center justify-between p-4">
                        <label for="search" class="relative">
                            <input 
                            id="search"
                            type="search"
                            v-model="filters.search"
                            class="rounded-lg text-sm pl-8 w-[200px] focus:w-[300px] transition-[width] ease-out border-gray-300" 
                            placeholder="Search for employee"
                            >
                    
                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                                </svg>
                            </span>
                        </label>

                        <div class="flex items-center divide-x divide-gray-300">
                            <div class="flex space-x-2 px-4">
                                <label for="plantilla" class="text-sm">
                                    <input type="radio" v-model="filters.empType" value="Plantilla" id="plantilla" class="text-sm">
                                    Plantilla
                                </label>
                                <label for="cos" class="text-sm">
                                    <input type="radio" v-model="filters.empType" value="Contract of Service" id="cos" class="text-sm">
                                    Contract of Service
                                </label>
                            </div>
    
                            <div class="flex space-x-2 px-4">
                                <label for="active" class="text-sm">
                                    <input type="radio" v-model="filters.status" value="Active" id="active" class="text-sm">
                                    Active
                                </label>
                                <label for="inactive" class="text-sm">
                                    <input type="radio" v-model="filters.status" value="Inactive" id="inactive" class="text-sm">
                                    Inactive
                                </label>
                            </div>
                            <div class="flex space-x-2 px-4">
                                <label for="user" class="text-sm">
                                    <input type="radio" v-model="filters.role" value="User" id="user" class="text-sm">
                                    User
                                </label>
                                <label for="administrator" class="text-sm">
                                    <input type="radio" v-model="filters.role" value="Administrator" id="administrator" class="text-sm">
                                    Administrator
                                </label>
                            </div>
                        </div>
                    </div>

                    <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    ID NO
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Address
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Status
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Role
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="emp in employees.data" :key="emp.id" class="bg-white hover:bg-gray-50 border-b">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                    {{ emp.id_no }}
                                </th>
                                <td class="px-6 py-4 flex items-center">
                                    <div v-show="emp.profile_photo_url" class="rounded-full w-10 h-10 overflow-hidden">
                                        <img :src="emp.profile_photo_url" class="object-cover h-full w-full" alt="profile pic">
                                    </div>
                                    <FallbackUserPhoto v-show="!emp.profile_photo_url" :firstname="emp.fname" :lastname="emp.lname" />

                                    <div class="ps-3">
                                        <div class="text-base font-medium text-gray-700">{{ `${emp.fname} ${emp.mname[0]}. ${emp.lname}` }}</div>
                                        <div class="font-normal text-gray-500">{{ emp.emp_type }}</div>
                                    </div> 
                                </td>
                                <td class="px-6 py-4">
                                    {{ emp.address }}
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1.5 font-medium text-white text-xs rounded-full"
                                    :class="{'bg-green-500' : emp.status === 'Active', 'bg-red-500' : emp.status === 'Inactive'}">{{ emp.status }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    {{ emp.role}}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center space-x-2">
                                        <Tooltip text="Edit">
                                            <Link :href="`/employees/edit/${emp.id}`" class="w-8 h-8 flex justify-center items-center hover:bg-gray-200 rounded-lg">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                                </svg>
                                            </Link>
                                        </Tooltip>
                                        
                                        <Tooltip text="Delete">
                                            <Link :href="route('employee.destroy', emp.id)" method="DELETE" as="button" class="w-8 h-8 flex justify-center items-center hover:bg-gray-200 rounded-lg">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                </svg>
                                            </Link>
                                        </Tooltip>
                                    </div>
                                </td>
                            </tr>

                            <tr v-show="!props.employees.data.length" class="border-b">
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
                    
                            <span class="ml-2">{{ employees.meta.from ?? 0 }} - {{ employees.meta.to ?? 0 }} entries of {{ employees.meta.total ?? 0 }}</span>
                        </label>

                        <Pagination :meta="employees.meta" :links="employees.links" />
                    </div>
                </div>

            </div>
        </div>
    </AppLayout>

    <Modal>

    </Modal>
</template>