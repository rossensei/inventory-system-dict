<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import TextInput from '@/Components/TextInput.vue';
import SelectInput from '@/Components/SelectInput.vue';
import FileInput from '@/Components/FileInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import { Head, useForm, Link } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    employee: Object
})

const form = useForm({
    _method: 'PUT',
    profile_photo: null,
    fname: props.employee.data.fname, 
    mname: props.employee.data.mname, 
    lname: props.employee.data.lname,
    address: props.employee.data.address, 
    id_no: props.employee.data.id_no,
    emp_type: props.employee.data.emp_type, 
    status: props.employee.data.status,
    role: props.employee.data.role
})

const photoPreview = ref(null);

const handlePhotoUpload = (file) => {
    form.profile_photo = file;
    const photo = file;

    if (! photo) return;

    const reader = new FileReader();

    reader.onload = (e) => {
        photoPreview.value = e.target.result;
    };

    reader.readAsDataURL(photo);
}

const submit = () => {
    form.post(route('employee.update', props.employee.data.id))
}
</script>

<template>
    <Head :title="`${props.employee.data.lname}, ${props.employee.data.fname}, ${props.employee.data.mname[0]}.`" />

    <AppLayout>
        <template #header>
            <div class="flex items-center divide-x divide-gray-200">
                <div class="px-2">
                    <Link :href="route('employee.index')" class="h-8 w-8 rounded-lg hover:bg-gray-200 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75 3 12m0 0 3.75-3.75M3 12h18" />
                          </svg>                          
                    </Link>
                </div>
                <div class="px-2">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit employee</h2>
                </div>
            </div>
        </template>
        <div class="py-4">
            <div class="w-full px-6">
                <form @submit.prevent="submit" class="max-w-5xl w-full">
                    <p class="text-md font-medium text-gray-700 mb-3">Employee information</p>
                    <div class="flex sm:flex-col sm:space-y-2 md:space-y-0 md:flex-row md:space-x-4">
                        <div class="w-full">
                            <div class="mb-4">
                                <InputLabel for="id-number" value="ID number" />
                                <TextInput id="id-number" type="text" v-model="form.id_no" maxlength="6" class="w-full text-sm" :class="{ 'border-red-600' : form.errors.id_no }" />
                                <InputError :message="form.errors.id_no" />
                            </div>
                            <div class="mb-4">
                                <InputLabel for="fname" value="First name" />
                                <TextInput id="fname" type="text" v-model="form.fname" class="w-full text-sm" :class="{ 'border-red-600' : form.errors.fname }" />
                                <InputError :message="form.errors.fname" />
                            </div>
                            <div class="mb-4">
                                <InputLabel for="mname" value="Middle name" />
                                <TextInput id="mname" type="text" v-model="form.mname" class="w-full text-sm" :class="{ 'border-red-600' : form.errors.mname }" />
                                <InputError :message="form.errors.mname" />
                            </div>
                            <div class="mb-4">
                                <InputLabel for="lname" value="Last name" />
                                <TextInput id="lname" type="text" v-model="form.lname" class="w-full text-sm" :class="{ 'border-red-600' : form.errors.lname }" />
                                <InputError :message="form.errors.lname" />
                            </div>
                            <div class="mb-4">
                                <InputLabel for="address" value="Address" />
                                <TextInput id="address" type="text" v-model="form.address" class="w-full text-sm" :class="{ 'border-red-600' : form.errors.address }" />
                                <InputError :message="form.errors.address" />
                            </div>
                            <div class="mb-4">
                                <InputLabel for="emp_type" value="Employee Type" />
                                <SelectInput id="emp_type" v-model="form.emp_type" class="w-full text-sm" :class="{ 'border-red-600' : form.errors.emp_type }">
                                    <option value="">Select type</option>
                                    <option value="Plantilla">Plantilla</option>
                                    <option value="Contract of Service">Contract of Service</option>
                                </SelectInput>
                                <InputError :message="form.errors.emp_type" />
                            </div>
                        </div>
                        <div class="w-full">
                            <div class="mb-4">
                                <InputLabel for="status" value="Status" />
                                <SelectInput id="status" v-model="form.status" class="w-full text-sm" :class="{ 'border-red-600' : form.errors.status }">
                                    <option value="">Select status</option>
                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>
                                </SelectInput>
                                <InputError :message="form.errors.id_no" />
                            </div>
                            <div class="mb-4">
                                <h3 class="font-medium text-sm text-gray-900">Role</h3>
                                <ul class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex">
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r">
                                        <div class="flex items-center ps-3">
                                            <input id="horizontal-list-radio-user" type="radio" v-model="form.role" value="User" name="list-radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                            <label for="horizontal-list-radio-user" class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">User </label>
                                        </div>
                                    </li>
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r">
                                        <div class="flex items-center ps-3">
                                            <input id="horizontal-list-radio-admin" type="radio" v-model="form.role" value="Administrator" name="list-radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                            <label for="horizontal-list-radio-admin" class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Administrator</label>
                                        </div>
                                    </li>
                                </ul>
                                <InputError :message="form.errors.role" />
                            </div>
                            <div class="mb-4">
                                <InputLabel for="photo" value="Photo" />
                                <FileInput @change="handlePhotoUpload" mimeType="image/png, image/jpeg, image/jpg" />
                                <div v-show="photoPreview || props.employee.data.profile_photo_url" class="w-[150px] h-[150px] mt-4 overflow-hidden">
                                    <img v-if="props.employee.data.profile_photo_url && !photoPreview" :src="props.employee.data.profile_photo_url" alt="user-photo" class="object-cover w-full h-full rounded-lg">
                                    <img v-else :src="photoPreview" alt="user-photo" class="object-cover w-full h-full rounded-lg">
                                </div>
                                <InputError :message="form.errors.profile_photo" />
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="px-4 py-2 text-sm text-white font-semibold rounded-lg shadow-sm bg-blue-600 hover:bg-blue-500" :disabled="form.processing">Save changes</button>
                </form>
            </div>
        </div>
    </AppLayout>
</template>