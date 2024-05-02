<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps({
    property: Object,
})

</script>

<template>
    <Head :title="property.item_name" />
    <AppLayout>
        <template #header>
            <div class="flex items-center divide-x divide-gray-200">
                <div class="px-2">
                    <Link :href="route('property.index')" class="h-8 w-8 rounded-lg hover:bg-gray-200 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75 3 12m0 0 3.75-3.75M3 12h18" />
                          </svg>                          
                    </Link>
                </div>
                <div class="px-2">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">More details about the property</h2>
                </div>
            </div>
        </template>
        
        <!-- <a :href="'/properties/view-pdf/' + props.property.id" target="_blank">{{ property.document }}</a> -->
        <div class="py-4 px-6 w-full">

            <!-- <h1 class="text-2xl font-semibold text-gray-700">{{ property.item_name }}</h1>

            <hr class="mt-2 mb-3"> -->

            <div class="flex flex-col space-y-3">
                <div class="h-[300px] w-[400px] overflow-hidden">
                    <img :src="property.photo_url" alt="item-photo" class="object-cover h-full w-full rounded-lg">
                </div>

                <div>
                    <h1 class="text-xl font-semibold text-gray-700">{{ property.item_name }}</h1>
                    <p class="text-sm text-gray-500">{{ property.description }}</p>
                </div>

                <div>
                    <h6 class="text-sm font-medium text-left text-gray-900">Property number</h6>
                    <p class="text-sm text-gray-900">{{ property.property_no }}</p>
                </div>

                <div>
                    <h6 class="text-sm font-medium text-left text-gray-900">Serial number</h6>
                    <p class="text-sm text-gray-900">{{ property.serial_no }}</p>
                </div>

                <div>
                    <h6 class="text-sm font-medium text-left text-gray-900">Category</h6>
                    <p class="text-sm text-gray-900">{{ property.category.category_name }}</p>
                </div>

                <div>
                    <h6 class="text-sm font-medium text-left text-gray-900">Units</h6>
                    <p class="text-sm text-gray-900">{{ property.unit_value }} {{ property.measurement_unit }}</p>
                </div>

                <div>
                    <h6 class="text-sm font-medium text-left text-gray-900">Received by</h6>
                    <p class="text-sm text-gray-900">{{ property.receiving_employee.fname }} {{ property.receiving_employee.lname }}</p>
                </div>

                <div>
                    <h6 class="text-sm font-medium text-left text-gray-900">Person Accountable</h6>
                    <p class="text-sm text-gray-900">{{ property.assigned_employee.fname }} {{ property.assigned_employee.lname }}</p>
                </div>

                <div>
                    <h6 class="text-sm font-medium text-left text-gray-900">Office</h6>
                    <p class="text-sm text-gray-900">{{ property.office.location }}</p>
                </div>

                <div>
                    <h6 class="text-sm font-medium text-left text-gray-900">Acquisition date</h6>
                    <p class="text-sm text-gray-900">{{ property.date_acquired }}</p>
                </div>

                <div>
                    <h6 class="text-sm font-medium text-left text-gray-900">Acquisition type</h6>
                    <p class="text-sm text-gray-900">{{ property.acquisition.name }}</p>
                </div>

                <div>
                    <h6 class="text-sm font-medium text-left text-gray-900">Status</h6>
                    <p class="text-sm text-gray-900">{{ property.status }}</p>
                </div>
                <div>
                    <h6 class="text-sm font-medium text-left text-gray-900">Property Document</h6>
                    <p class="text-sm text-gray-900">
                        <a :href="'/properties/view-pdf/' + property.document" target="_blank" class="inline-flex items-center text-blue-600 underline visited:text-indigo-600">
                            <!-- <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                            </svg> -->
                            {{ property.document }}
                        </a>
                    </p>
                </div>

                

                <!-- <div class="w-full">
                    <table class="w-full max-w-5xl border">
                        <thead>
                            <th colspan="2" class="px-4 py-2 text-gray-900 text-left border-b">Property Information</th>
                        </thead>
                        <tbody>
                            <tr class="odd:bg-white even:bg-gray-50 border-b">
                                <th class="text-sm font-medium text-left text-gray-900 w-52 px-4 py-2">Property number</th>
                                <td class="text-sm text-gray-900 px-4 py-2">{{ property.property_no }}</td>
                            </tr>
                            <tr class="odd:bg-white even:bg-gray-50 border-b">
                                <th class="text-sm font-medium text-left text-gray-900 w-52 px-4 py-2">Property name</th>
                                <td class="text-sm text-gray-900 px-4 py-2">{{ property.item_name }}</td>
                            </tr>
                            <tr class="odd:bg-white even:bg-gray-50 border-b">
                                <th class="text-sm font-medium text-left text-gray-900 w-52 px-4 py-2">Serial number</th>
                                <td class="text-sm text-gray-900 px-4 py-2">{{ property.serial_no }}</td>
                            </tr>
                            <tr class="odd:bg-white even:bg-gray-50 border-b">
                                <th class="text-sm font-medium text-left text-gray-900 w-52 px-4 py-2">Category</th>
                                <td class="text-sm text-gray-900 px-4 py-2">{{ property.category.category_name }}</td>
                            </tr>
                            <tr class="odd:bg-white even:bg-gray-50 border-b">
                                <th class="text-sm font-medium text-left text-gray-900 w-52 px-4 py-2">Description</th>
                                <td class="text-sm text-gray-900 px-4 py-2">Lorem ipsum dolor sit amet consectetur adipisicing elit.</td>
                            </tr>
                            <tr class="odd:bg-white even:bg-gray-50 border-b">
                                <th class="text-sm font-medium text-left text-gray-900 w-52 px-4 py-2">Units</th>
                                <td class="text-sm text-gray-900 px-4 py-2">{{ property.unit_value }} {{ property.measurement_unit }}</td>
                            </tr>
                            <tr class="odd:bg-white even:bg-gray-50 border-b">
                                <th class="text-sm font-medium text-left text-gray-900 w-52 px-4 py-2">Received from</th>
                                <td class="text-sm text-gray-900 px-4 py-2">{{ property.receiving_employee.fname }} {{ property.receiving_employee.lname }}</td>
                            </tr>
                            <tr class="odd:bg-white even:bg-gray-50 border-b">
                                <th class="text-sm font-medium text-left text-gray-900 w-52 px-4 py-2">Assigned to</th>
                                <td class="text-sm text-gray-900 px-4 py-2">{{ property.assigned_employee.fname }} {{ property.assigned_employee.lname }}</td>
                            </tr>
                            <tr class="odd:bg-white even:bg-gray-50 border-b">
                                <th class="text-sm font-medium text-left text-gray-900 w-52 px-4 py-2">Office</th>
                                <td class="text-sm text-gray-900 px-4 py-2">{{ property.office.office_name }}</td>
                            </tr>
                            <tr class="odd:bg-white even:bg-gray-50 border-b">
                                <th class="text-sm font-medium text-left text-gray-900 w-52 px-4 py-2">Date acquired</th>
                                <td class="text-sm text-gray-900 px-4 py-2">{{ property.date_acquired }}</td>
                            </tr>
                            <tr class="odd:bg-white even:bg-gray-50 border-b">
                                <th class="text-sm font-medium text-left text-gray-900 w-52 px-4 py-2">Acquisition type</th>
                                <td class="text-sm text-gray-900 px-4 py-2">{{ property.acquisition.name }}</td>
                            </tr>
                            <tr class="odd:bg-white even:bg-gray-50 border-b">
                                <th class="text-sm font-medium text-left text-gray-900 w-52 px-4 py-2">Status</th>
                                <td class="text-sm text-gray-900 px-4 py-2">{{ property.status }}</td>
                            </tr>
                            <tr class="odd:bg-white even:bg-gray-50 border-b">
                                <th class="text-sm font-medium text-left text-gray-900 w-52 px-4 py-2">Document</th>
                                <td class="text-sm text-gray-900 px-4 py-2"><a :href="'/properties/view-pdf/' + property.document" target="_blank" class="inline-flex items-center text-blue-600 underline visited:text-indigo-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-1">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                    </svg>
                                {{ property.document }}</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div> -->
            </div>

            <div class="mt-6 mb-4">
                <Link :href="route('property.edit', property.id)" class="px-4 py-2 text-sm text-white font-medium bg-blue-600 hover:bg-blue-500 rounded-lg ">Edit item details</Link>
            </div>
        </div>
    </AppLayout>
</template>