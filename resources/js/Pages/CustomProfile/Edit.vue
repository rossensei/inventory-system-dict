<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import Modal from '@/Components/Modal.vue';
import { Head, useForm, router } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    userInfo: Object,
    // credentials: Object
});

const form = useForm({
    fname: props.userInfo.fname,
    mname: props.userInfo.mname,
    lname: props.userInfo.lname,
    address: props.userInfo.address,
});

const isEdit = ref(false);

const submit = () => {
    form.patch(route('profile.update'), {
        onSuccess: () => {
            isEdit.value = false;
        }
    })
}

// PROFILE PICTURE
const photoForm = useForm({
    _method: 'PATCH',
    photo: null
});

const photoInput = ref(null);
const photoPreview = ref(null);

const selectNewPhoto = () => {
    photoInput.value.click();
};

const updatePhotoPreview = () => {

    const photo = photoInput.value.files[0];

    if (! photo) return;

    const reader = new FileReader();

    reader.onload = (e) => {
        photoPreview.value = e.target.result;
    };

    reader.readAsDataURL(photo);
}

const deletePhoto = () => {
    router.delete('/user/profile/delete-photo', {
        preserveScroll: true,
        onSuccess: () => {
            photoPreview.value = null;
            clearPhotoFileInput();
        },
    });
};

const clearPhotoFileInput = () => {
    if (photoInput.value?.value) {
        photoInput.value.value = null;
        photoPreview.value = null;
    }
};

const setProfilePicture = () => {
    console.log("here")
    if (photoInput.value) {
        photoForm.photo = photoInput.value.files[0];

        photoForm.post(route('profile.photoUpdate'), {
            onSuccess: () => clearPhotoFileInput()
        })
    }
};

</script>

<template>
    <Head title="My Profile" />
    <AppLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-600 leading-tight">My Profile</h2>
            <p class="text-sm text-gray-500">Update your photo and personal details here.</p>
        </template>

        <div class="py-4">
            <div class="w-full px-6">

                <div class="block">
                    <div class="relative w-44 h-44 bg-blue-100 rounded-lg shrink-0">
                        <img v-show="props.userInfo.profile_photo_url && !photoPreview" :src="props.userInfo.profile_photo_url" alt="user-photo" class="rounded-lg h-full w-full object-cover">

                        <img v-show="photoPreview" :src="photoPreview" alt="user-photo" class="rounded-lg object-cover h-full w-full">

                        <input
                        id="userphoto"
                        ref="photoInput"
                        type="file"
                        class="hidden"
                        @change="updatePhotoPreview"
                        >
                    </div>

                    <button v-if="!photoPreview" type="button" @click="selectNewPhoto" class="px-4 py-2 rounded-md text-sm text-gray-700 font-medium bg-gray-100 hover:bg-gray-200 border mt-4">Change photo</button>
                    <button v-else type="button" @click="setProfilePicture" class="px-4 py-2 rounded-md text-sm text-white font-medium bg-blue-600 hover:bg-blue-500 mt-4">Save photo</button>
                </div>

                <div class="mt-4 max-w-xl w-full">
                    <ul class="text-sm divide-y divide-gray-300">
                        <li>
                            <div class="p-4 flex items-center justify-between">
                                <p class="text-gray-500">Employee ID</p>
                                <p class="text-gray-500 font-medium">{{ props.userInfo.id_no }}</p>
                            </div>
                        </li>
                        <li>
                            <div class="p-4 flex items-center justify-between">
                                <p class="text-gray-500">Employee type</p>
                                <p class="text-gray-500 font-medium">{{ props.userInfo.emp_type }}</p>
                            </div>
                        </li>
                        <li>
                            <div class="p-4 flex items-center justify-between">
                                <p class="text-gray-500">First name</p>
                                <p class="text-gray-700 font-medium">{{ props.userInfo.fname }}</p>
                            </div>
                        </li>
                        <li>
                            <div class="p-4 flex items-center justify-between">
                                <p class="text-gray-500">Middle name</p>
                                <p class="text-gray-700 font-medium">{{ props.userInfo.mname }}</p>
                            </div>
                        </li>
                        <li>
                            <div class="p-4 flex items-center justify-between">
                                <p class="text-gray-500">Last name</p>
                                <p class="text-gray-700 font-medium">{{ props.userInfo.lname }}</p>
                            </div>
                        </li>
                        <li>
                            <div class="p-4 flex items-center justify-between">
                                <p class="text-gray-500">Address</p>
                                <p class="text-gray-700 font-medium">{{ props.userInfo.address }}</p>
                            </div>
                        </li>
                    </ul>
                </div>

                <button type="button" @click="isEdit = true" class="inline-flex items-center px-4 py-2 rounded-md text-sm text-gray-700 font-medium bg-gray-100 hover:bg-gray-200 border mt-4">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 mr-1">
                        <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32l8.4-8.4Z" />
                        <path d="M5.25 5.25a3 3 0 0 0-3 3v10.5a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3V13.5a.75.75 0 0 0-1.5 0v5.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5V8.25a1.5 1.5 0 0 1 1.5-1.5h5.25a.75.75 0 0 0 0-1.5H5.25Z" />
                    </svg>                      
                    Edit profile
                </button>


                <Modal maxWidth="xl" :show="isEdit" @close="isEdit = false">
                    <div class="p-6">
                        <h1 class="text-lg font-semibold text-gray-600">Edit profile details</h1>

                        <form @submit.prevent="submit" class="w-full mt-2">
                            <div class="mt-4 w-full">
                                <InputLabel value="First name" />
                                <TextInput type="text" v-model="form.fname" class="text-sm w-full" />
                                <InputError :message="form.errors.fname" />
                            </div>
        
                            <div class="mt-4 w-full">
                                <InputLabel value="Middle name" />
                                <TextInput type="text" v-model="form.mname" class="text-sm w-full" />
                                <InputError :message="form.errors.mname" />
                            </div>
        
                            <div class="mt-4 w-full">
                                <InputLabel value="Last name" />
                                <TextInput type="text" v-model="form.lname" class="text-sm w-full" />
                                <InputError :message="form.errors.lname" />
                            </div>
        
                            <div class="mt-4 w-full">
                                <InputLabel value="Address" />
                                <TextInput type="text" v-model="form.address" class="text-sm w-full" />
                                <InputError :message="form.errors.address" />
                            </div>

                            <div class="mt-4 flex items-center justify-end space-x-2">
                                <button type="button" @click="isEdit = false" class="px-4 py-2 rounded-md text-sm text-gray-700 font-medium bg-gray-200 hover:bg-gray-300">Cancel</button>
                                <button type="submit" class="px-4 py-2 rounded-md text-sm text-white font-medium bg-blue-600 hover:bg-blue-500" :disabled="form.processing">Save changes</button>
                            </div>
                        </form>
                    </div>
                </Modal>

            </div>
        </div>
    </AppLayout>
</template>
