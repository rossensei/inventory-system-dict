<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import InputLabel from '@/Components/InputLabel.vue';
import SelectInput from '@/Components/SelectInput.vue';
import { Head, router, Link, } from '@inertiajs/vue3';
import { ref } from 'vue';
import axios from 'axios';

const props = defineProps({
    offices: Array,
    employees: Array,
})

const selectedOffice = ref('')

const downloadInventoryPerOffice = () => {
    if(selectedOffice.value === '') return alert("You haven't selected an office! Please select one.");

    const a = document.createElement('a');
    a.href = `/reports/inventory-per-office/${selectedOffice.value}`;
    document.body.appendChild(a);
    a.click();
}

const selectedEmployee = ref('')

const downloadInventoryPerEmployee = () => {
    if(selectedEmployee.value === '') return alert("You haven't selected an employee! Please select one.");

    const a = document.createElement('a');
    a.href = `/reports/inventory-per-employee/${selectedEmployee.value}`;
    document.body.appendChild(a);
    a.click();
}
</script>

<template>
    <Head title="Reports" />
    <AppLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Reports</h2>
            <p class="text-sm text-gray-500">Generate updated reports with the agency's properties</p>
        </template>
        <div class="py-4">
            <div class="w-full px-6">
                <div class="mt-3 space-y-4">
                    <div class="p-6 border bg-white shadow-sm rounded-lg flex justify-between items-center">
                        <div>
                            <h6 class="text-lg text-gray-900 font-semibold">Inventory Summary</h6>
                            <p class="text-sm text-gray-600">Download list of all properties</p>
                        </div>

                        <a href="/reports/inventory-summary" class="px-4 py-2 text-white text-sm bg-gray-600 rounded-lg inline-flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 mr-1">
                                <path fill-rule="evenodd" d="M12 2.25a.75.75 0 0 1 .75.75v11.69l3.22-3.22a.75.75 0 1 1 1.06 1.06l-4.5 4.5a.75.75 0 0 1-1.06 0l-4.5-4.5a.75.75 0 1 1 1.06-1.06l3.22 3.22V3a.75.75 0 0 1 .75-.75Zm-9 13.5a.75.75 0 0 1 .75.75v2.25a1.5 1.5 0 0 0 1.5 1.5h13.5a1.5 1.5 0 0 0 1.5-1.5V16.5a.75.75 0 0 1 1.5 0v2.25a3 3 0 0 1-3 3H5.25a3 3 0 0 1-3-3V16.5a.75.75 0 0 1 .75-.75Z" clip-rule="evenodd" />
                              </svg>                              
                            Download
                        </a>
                    </div>
                    
                    <div class="p-6 border bg-white shadow-sm rounded-lg flex justify-between items-center">
                        <div>
                            <h6 class="text-lg text-gray-900 font-semibold">Serviceable Inventory</h6>
                            <p class="text-sm text-gray-600">Download list of all serviceable properties</p>
                        </div>

                        <a href="/reports/serviceable-inventory" class="px-4 py-2 text-white text-sm bg-gray-600 rounded-lg inline-flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 mr-1">
                                <path fill-rule="evenodd" d="M12 2.25a.75.75 0 0 1 .75.75v11.69l3.22-3.22a.75.75 0 1 1 1.06 1.06l-4.5 4.5a.75.75 0 0 1-1.06 0l-4.5-4.5a.75.75 0 1 1 1.06-1.06l3.22 3.22V3a.75.75 0 0 1 .75-.75Zm-9 13.5a.75.75 0 0 1 .75.75v2.25a1.5 1.5 0 0 0 1.5 1.5h13.5a1.5 1.5 0 0 0 1.5-1.5V16.5a.75.75 0 0 1 1.5 0v2.25a3 3 0 0 1-3 3H5.25a3 3 0 0 1-3-3V16.5a.75.75 0 0 1 .75-.75Z" clip-rule="evenodd" />
                              </svg>                              
                            Download
                        </a>
                    </div>

                    <div class="p-6 border bg-white shadow-sm rounded-lg flex justify-between items-center">
                        <div>
                            <h6 class="text-lg text-gray-900 font-semibold">Unserviceable Inventory</h6>
                            <p class="text-sm text-gray-600">Download list of all serviceable properties</p>
                        </div>

                        <a href="/reports/unserviceable-inventory" class="px-4 py-2 text-white text-sm bg-gray-600 rounded-lg inline-flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 mr-1">
                                <path fill-rule="evenodd" d="M12 2.25a.75.75 0 0 1 .75.75v11.69l3.22-3.22a.75.75 0 1 1 1.06 1.06l-4.5 4.5a.75.75 0 0 1-1.06 0l-4.5-4.5a.75.75 0 1 1 1.06-1.06l3.22 3.22V3a.75.75 0 0 1 .75-.75Zm-9 13.5a.75.75 0 0 1 .75.75v2.25a1.5 1.5 0 0 0 1.5 1.5h13.5a1.5 1.5 0 0 0 1.5-1.5V16.5a.75.75 0 0 1 1.5 0v2.25a3 3 0 0 1-3 3H5.25a3 3 0 0 1-3-3V16.5a.75.75 0 0 1 .75-.75Z" clip-rule="evenodd" />
                              </svg>                              
                            Download
                        </a>
                    </div>

                    <div class="p-6 border bg-white shadow-sm rounded-lg flex justify-between items-center">
                        <div>
                            <h6 class="text-lg text-gray-900 font-semibold">Inventory per office</h6>
                            <p class="text-sm text-gray-600">Select and download inventory from an office</p>

                            <div class="mt-4">
                                <InputLabel value="Select an office" for="office" />
                                <SelectInput id="office" v-model="selectedOffice" class="text-sm w-full">
                                    <option value="" selected>---</option>
                                    <option v-for="office in offices" :key="office.id" :value="office.id">{{ office.office_name }}</option>
                                </SelectInput>
                            </div>
                        </div>

                        <button @click="downloadInventoryPerOffice" class="px-4 py-2 text-white text-sm bg-gray-600 rounded-lg inline-flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 mr-1">
                                <path fill-rule="evenodd" d="M12 2.25a.75.75 0 0 1 .75.75v11.69l3.22-3.22a.75.75 0 1 1 1.06 1.06l-4.5 4.5a.75.75 0 0 1-1.06 0l-4.5-4.5a.75.75 0 1 1 1.06-1.06l3.22 3.22V3a.75.75 0 0 1 .75-.75Zm-9 13.5a.75.75 0 0 1 .75.75v2.25a1.5 1.5 0 0 0 1.5 1.5h13.5a1.5 1.5 0 0 0 1.5-1.5V16.5a.75.75 0 0 1 1.5 0v2.25a3 3 0 0 1-3 3H5.25a3 3 0 0 1-3-3V16.5a.75.75 0 0 1 .75-.75Z" clip-rule="evenodd" />
                              </svg>                              
                            Download
                        </button>
                    </div>

                    <div class="p-6 border bg-white shadow-sm rounded-lg flex justify-between items-center">
                        <div>
                            <h6 class="text-lg text-gray-900 font-semibold">Inventory per employee</h6>
                            <p class="text-sm text-gray-600">Select and download inventory from an employee </p>

                            <div class="mt-4">
                                <InputLabel value="Select an employee" for="employee" />
                                <SelectInput id="employee" v-model="selectedEmployee" class="text-sm w-full">
                                    <option value="">---</option>
                                    <option v-for="employee in employees" :key="employee.id" :value="employee.id">{{ `${employee.fname} ${employee.lname}` }}</option>
                                </SelectInput>
                            </div>
                        </div>

                        <button @click="downloadInventoryPerEmployee" class="px-4 py-2 text-white text-sm bg-gray-600 rounded-lg inline-flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 mr-1">
                                <path fill-rule="evenodd" d="M12 2.25a.75.75 0 0 1 .75.75v11.69l3.22-3.22a.75.75 0 1 1 1.06 1.06l-4.5 4.5a.75.75 0 0 1-1.06 0l-4.5-4.5a.75.75 0 1 1 1.06-1.06l3.22 3.22V3a.75.75 0 0 1 .75-.75Zm-9 13.5a.75.75 0 0 1 .75.75v2.25a1.5 1.5 0 0 0 1.5 1.5h13.5a1.5 1.5 0 0 0 1.5-1.5V16.5a.75.75 0 0 1 1.5 0v2.25a3 3 0 0 1-3 3H5.25a3 3 0 0 1-3-3V16.5a.75.75 0 0 1 .75-.75Z" clip-rule="evenodd" />
                              </svg>                              
                            Download
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>