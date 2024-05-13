<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps({
    property: Object,
})

</script>

<template>
    <Head :title="property.data.item_name" />
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
        
        <div class="py-4 px-6 w-full">

            <div class="flex flex-col space-y-3">
                <div class="h-[300px] w-[400px] overflow-hidden">
                    <img :src="property.data.photo" alt="item-photo" class="object-cover h-full w-full rounded-lg">
                </div>

                <div>
                    <h1 class="text-xl font-semibold text-gray-700">{{ property.data.item_name }}</h1>
                    <p class="text-sm text-gray-500">{{ property.data.description }}</p>
                </div>

                <div>
                    <h6 class="text-sm font-medium text-left text-gray-900">Property number</h6>
                    <p class="text-sm text-gray-900">{{ property.data.property_no }}</p>
                </div>

                <div>
                    <h6 class="text-sm font-medium text-left text-gray-900">Serial number</h6>
                    <p class="text-sm text-gray-900">{{ property.data.serial_no }}</p>
                </div>

                <div>
                    <h6 class="text-sm font-medium text-left text-gray-900">Category</h6>
                    <p class="text-sm text-gray-900">{{ property.data.category.path }}</p>
                </div>

                <div>
                    <h6 class="text-sm font-medium text-left text-gray-900">Unit Value</h6>
                    <p class="text-sm text-gray-900">{{ property.data.unit_value }}</p>
                </div>
                
                <div>
                    <h6 class="text-sm font-medium text-left text-gray-900">Unit of measurement</h6>
                    <p class="text-sm text-gray-900">{{ property.data.measurement_unit }}</p>
                </div>

                <div>
                    <h6 class="text-sm font-medium text-left text-gray-900">Received from</h6>
                    <p class="text-sm text-gray-900">{{ property.data.received_from }}</p>
                </div>

                <div>
                    <h6 class="text-sm font-medium text-left text-gray-900">Received by</h6>
                    <p class="text-sm text-gray-900">{{ property.data.received_by.name }}</p>
                </div>

                <div>
                    <h6 class="text-sm font-medium text-left text-gray-900">Person Accountable</h6>
                    <p class="text-sm text-gray-900">{{ property.data.assigned_to.name }}</p>
                </div>

                <div>
                    <h6 class="text-sm font-medium text-left text-gray-900">Office</h6>
                    <p class="text-sm text-gray-900">{{ property.data.office.office_name }} | {{ property.data.office.location }}</p>
                </div>

                <div>
                    <h6 class="text-sm font-medium text-left text-gray-900">Acquisition date</h6>
                    <p class="text-sm text-gray-900">{{ property.data.date_acquired }}</p>
                </div>

                <div>
                    <h6 class="text-sm font-medium text-left text-gray-900">Acquisition type</h6>
                    <p class="text-sm text-gray-900">{{ property.data.acquisition.name }}</p>
                </div>

                <div>
                    <h6 class="text-sm font-medium text-left text-gray-900">Status</h6>
                    <p class="text-sm text-gray-900">{{ property.data.status }}</p>
                </div>
                <div>
                    <h6 class="text-sm font-medium text-left text-gray-900">Property Document</h6>
                    <p class="text-sm text-gray-900">
                        <a :href="'/properties/view-pdf/' + property.data.document" target="_blank" class="inline-flex items-center text-blue-600 underline visited:text-indigo-600">
                            {{ property.data.document }}
                        </a>
                    </p>
                </div>
            </div>

            <div class="mt-6 mb-4">
                <Link :href="route('property.edit', property.data.id)" class="px-4 py-2 text-sm text-white font-medium bg-blue-600 hover:bg-blue-500 rounded-lg ">Edit item details</Link>
            </div>
        </div>
    </AppLayout>
</template>