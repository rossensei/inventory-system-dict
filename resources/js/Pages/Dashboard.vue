<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { useState } from '@/composables/counter.js'

const props = defineProps({
    categoriesCount: Number,
    acquisitionsCount: Number,
    employeesCount: Number,
    officesCount: Number,
    propertiesCount: Number,
    properties: Object,
})

const state = useState();
</script>

<template>
    <Head title="Dashboard" />

    <AppLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <div class="w-full px-6 py-4">
            <div class="flex justify-between flex-wrap gap-4">
                <Link href="/categories" class="bg-white rounded-lg shadow-sm flex items-center justify-start p-6 flex-grow basis-[200px] border">
                    <span class="w-12 h-12 rounded-full text-green-700 bg-green-100 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.75V12A2.25 2.25 0 0 1 4.5 9.75h15A2.25 2.25 0 0 1 21.75 12v.75m-8.69-6.44-2.12-2.12a1.5 1.5 0 0 0-1.061-.44H4.5A2.25 2.25 0 0 0 2.25 6v12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9a2.25 2.25 0 0 0-2.25-2.25h-5.379a1.5 1.5 0 0 1-1.06-.44Z" />
                        </svg>
                    </span>
                    
                    <div class="ml-3">
                        <h1 class="text-xl font-bold text-gray-700">{{ categoriesCount }}</h1>
                        <p class="text-sm text-gray-500">Categories</p>
                    </div>
                </Link>

                <Link href="/acquisitions" class="bg-white rounded-lg shadow-sm flex items-center justify-start p-6 flex-grow basis-[200px] border">
                    <span class="w-12 h-12 rounded-full text-purple-700 bg-purple-100 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 3.75H6.912a2.25 2.25 0 0 0-2.15 1.588L2.35 13.177a2.25 2.25 0 0 0-.1.661V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18v-4.162c0-.224-.034-.447-.1-.661L19.24 5.338a2.25 2.25 0 0 0-2.15-1.588H15M2.25 13.5h3.86a2.25 2.25 0 0 1 2.012 1.244l.256.512a2.25 2.25 0 0 0 2.013 1.244h3.218a2.25 2.25 0 0 0 2.013-1.244l.256-.512a2.25 2.25 0 0 1 2.013-1.244h3.859M12 3v8.25m0 0-3-3m3 3 3-3" />
                        </svg>                          
                    </span>
                    
                    <div class="ml-3">
                        <h1 class="text-xl font-bold text-gray-700">{{ acquisitionsCount }}</h1>
                        <p class="text-sm text-gray-500">Acquisitions</p>
                    </div>
                </Link>

                <Link href="/employees" class="bg-white rounded-lg shadow-sm flex items-center justify-start p-6 flex-grow basis-[200px] border">
                    <span class="w-12 h-12 rounded-full text-blue-700 bg-blue-100 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                          </svg>                                                   
                    </span>
                    
                    <div class="ml-3">
                        <h1 class="text-xl font-bold text-gray-700">{{ employeesCount }}</h1>
                        <p class="text-sm text-gray-500">Employees</p>
                    </div>
                </Link>

                <Link href="/offices" class="bg-white rounded-lg shadow-sm flex items-center justify-start p-6 flex-grow basis-[200px] border">
                    <span class="w-12 h-12 rounded-full text-orange-700 bg-orange-100 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0 0 12 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75Z" />
                        </svg>                                                 
                    </span>
                    
                    <div class="ml-3">
                        <h1 class="text-xl font-bold text-gray-700">{{ officesCount }}</h1>
                        <p class="text-sm text-gray-500">Offices</p>
                    </div>
                </Link>

                <Link href="/properties" class="bg-white rounded-lg shadow-sm flex items-center justify-start p-6 flex-grow basis-[200px] border">
                    <span class="w-12 h-12 rounded-full text-red-700 bg-red-100 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
                          </svg>                                                                          
                    </span>
                    
                    <div class="ml-3">
                        <h1 class="text-xl font-bold text-gray-700">{{ propertiesCount }}</h1>
                        <p class="text-sm text-gray-500">Properties</p>
                    </div>
                </Link>
            </div>

            <div class="mt-4 p-6 shadow-sm bg-white border rounded-lg">
                <h4 class="text-lg text-gray-600 font-semibold">Latest added properties</h4>
                <table class="w-full text-sm mt-3">
                    <thead class="text-gray-600 font-medium border-t border-b">
                        <th class="px-6 py-3 text-left w-8">Image</th>
                        <th class="px-6 py-3 text-left">Name</th>
                        <th class="px-6 py-3 text-left">Property number</th>
                        <th class="px-6 py-3 text-left">Category</th>
                        <th class="px-6 py-3 text-left">Unit Value</th>
                        <th class="px-6 py-3 text-left">Measurement Unit</th>
                        <th class="px-6 py-3 text-left">Status</th>
                        <th class="px-6 py-3 text-center">Action</th>
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
                            <td class="px-6 py-3 text-center">
                                <Link :href="route('property.show', property.id)" class="underline text-blue-700 text-sm font-medium">View more details</Link>
                            </td>
                        </tr>

                        <tr v-show="!props.properties.data.length" class="border-b">
                            <td colspan="7" class="px-6 py-4">No records found.</td>
                        </tr>
                    </tbody>
                </table>

                <div class="mt-4">
                    <Link href="/properties" class="underline text-blue-700 text-sm font-medium">See all properties</Link>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
@/composables/counter.js