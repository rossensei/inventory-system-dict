<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import TextInput from '@/Components/TextInput.vue';
import AcquisitionList from '@/Components/AcquisitionList.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    acquisitions: Array,
})

const form = useForm({
    name: ''
})

const submit = () => {
    form.post(route('acquisition.store'), {
        onSuccess: () => form.reset()
    })
}

</script>

<template>
    <Head title="Acquisition Types" />

    <AppLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Acquisitions</h2>
            <p class="text-sm text-gray-500">Manage list of acquisition types</p>
        </template>

        <div class="py-4">
            <div class="w-full px-6">
                <form @submit.prevent="submit" class="flex items-center space-x-3 max-w-xl py-2">
                    <label for="new-acquisition" class="relative w-full">

                        <span class="absolute left-3 text-gray-400 top-1/2 -translate-y-1/2">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                                <path d="M5.566 4.657A4.505 4.505 0 0 1 6.75 4.5h10.5c.41 0 .806.055 1.183.157A3 3 0 0 0 15.75 3h-7.5a3 3 0 0 0-2.684 1.657ZM2.25 12a3 3 0 0 1 3-3h13.5a3 3 0 0 1 3 3v6a3 3 0 0 1-3 3H5.25a3 3 0 0 1-3-3v-6ZM5.25 7.5c-.41 0-.806.055-1.184.157A3 3 0 0 1 6.75 6h10.5a3 3 0 0 1 2.683 1.657A4.505 4.505 0 0 0 18.75 7.5H5.25Z" />
                            </svg>
                        </span>

                        <TextInput
                        v-model="form.name"
                        id="new-acquisition"
                        class="w-full text-sm pl-8"
                        placeholder="Enter new acquisition type.."

                        />
                    </label>

                    <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-500 text-sm text-white font-medium rounded-md">Create</button>
                </form>

                <AcquisitionList :acquisitions="acquisitions" />
            </div>
        </div>
    </AppLayout>
</template>
