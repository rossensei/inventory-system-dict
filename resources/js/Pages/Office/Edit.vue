<script setup>
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head, useForm, Link } from '@inertiajs/vue3';

const props = defineProps({
    office: Object,
})

const form = useForm({
    office_name: props.office.data.office_name,
    location: props.office.data.location,
    classification: props.office.data.classification,
})

const submit = () => {
    form.patch(route('office.update', props.office.data.id), {
        onSuccess: () => form.reset()
    })
}
</script>

<template>
    <Head title="Edit Office" />

    <AppLayout>
        <template #header>
            <div class="flex items-center divide-x divide-gray-200">
                <div class="px-2">
                    <Link :href="route('office.index')" class="h-8 w-8 rounded-lg hover:bg-gray-200 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75 3 12m0 0 3.75-3.75M3 12h18" />
                          </svg>                          
                    </Link>
                </div>
                <div class="px-2">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit office details</h2>
                </div>
            </div>
        </template>

        <div class="py-4">
            <div class="w-full px-6">

                <form @submit.prevent="submit" class="w-full max-w-xl mt-4">
                    <div class="mb-4">
                        <InputLabel for="office-name" value="Office name" />
                        <TextInput id="office-name" v-model="form.office_name" class="w-full text-sm" />
                        <InputError :message="form.errors.office_name" />
                    </div>

                    <div class="mb-4">
                        <InputLabel for="location" value="Location" />
                        <TextInput id="location" v-model="form.location" class="w-full text-sm" />
                        <InputError :message="form.errors.location" />
                    </div>

                    <div class="mb-4">
                        <InputLabel for="classification" value="Classification" />
                        <!-- <TextInput id="office-name" v-model="form.classification" class="w-full text-sm" /> -->
                        <select v-model="form.classification" id="classification" class="w-full text-sm rounded-lg border border-gray-300 shadow-sm">
                            <option value="">Select classification</option>
                            <option value="DICT-DTC">DICT-DTC</option>
                            <option value="Tech4ED Center">Tech4ED Center</option>
                        </select>
                        <InputError :message="form.errors.classification" />
                    </div>

                    <button type="submit" class="px-4 py-2 text-white text-sm font-medium bg-blue-600 hover:bg-blue-500 rounded-lg" :disabled="form.processing">Save changes</button>
                </form>
            </div>
        </div>
    </AppLayout>
</template>