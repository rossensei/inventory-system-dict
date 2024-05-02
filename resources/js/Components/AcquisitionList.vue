<script setup>
import AcquisitionItem from '@/Components/AcquisitionItem.vue';
import Modal from '@/Components/Modal.vue';
import InputError from '@/Components/InputError.vue';
import { useForm, Link, router } from '@inertiajs/vue3';
import { ref, watch, } from 'vue';

const props = defineProps({
    acquisitions: Array,
})

const editForm = useForm({
    name: null,
})

const acquisitionItem = ref({});

const actionType = ref(null);

const isModalShown = ref(false);

const closeModal = () => {
    isModalShown.value = false;
}

const editAcquisitionItem = (acquisition) => {
    if(editForm.hasErrors) {
        editForm.clearErrors();
    }
    actionType.value = 'edit';
    isModalShown.value = true;
    acquisitionItem.value = acquisition;
    editForm.name = acquisition.name
}

const updateAcquisitionItem = () => {
    if(!acquisitionItem.value.id) return;

    editForm.patch(route('acquisition.update', acquisitionItem.value.id), {
        onSuccess: () => closeModal()
    })
}

const deleteAcquisitionItem = (acquisition) => {
    acquisitionItem.value = acquisition;
    actionType.value = 'delete';
    isModalShown.value = true;
}

const confirmDeletion = () => {
    router.delete(route('acquisition.destroy', acquisitionItem.value.id), {
        onFinish: () => closeModal()
    })
}
</script>

<template>
    <ul class="max-w-xl bg-white shadow-md rounded-lg p-2 space-y-2">
        <li v-for="acquisition in acquisitions" :key="acquisition.id">
            <AcquisitionItem :acquisition="acquisition" @edit-item="editAcquisitionItem" @delete-item="deleteAcquisitionItem" />
        </li>
        <li v-show="!acquisitions.length">
            <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg">
                <div class="text-sm text-gray-500">
                    There are no available acquisition types. Create one!
                </div>
            </div>
        </li>
    </ul>

    <Modal :show="isModalShown" maxWidth="md" @close="closeModal">
        <div v-if="actionType === 'edit'" class="p-5">
            <h4 class="text-lg font-semibold text-gray-700">Edit acquisition name</h4>
            <label for="edit-form" class="text-sm text-gray-600">
                Acquisition name
                <input v-model="editForm.name" @keyup.enter="updateAcquisitionItem" type="text" class="w-full text-sm border-gray-300 rounded-lg" id="edit-form">
                <InputError :message="editForm.errors.name" />
            </label>

            <div class="flex justify-end space-x-2">
                <button type="button" @click="closeModal" class="mt-3 text-sm text-white font-medium bg-gray-400 hover:bg-gray-300 px-4 py-2 rounded-lg">Close</button>
                <button type="button" @click="updateAcquisitionItem" class="mt-3 text-sm text-white font-medium bg-blue-600 hover:bg-blue-500 px-4 py-2 rounded-lg">Save</button>
            </div>
        </div>
        <div v-else-if="actionType === 'delete'" class="p-5">
            <h4 class="text-lg font-semibold text-red-700">Delete Confirmation</h4>
            <div class="text-sm text-gray-600">Are you sure you want to delete "{{ acquisitionItem.name }}"?</div>
            <div class="flex justify-end space-x-2">
                <button type="button" @click="closeModal" class="mt-3 text-sm text-white font-medium bg-gray-400 hover:bg-gray-300 px-4 py-2 rounded-lg">Cancel</button>
                <button type="button" @click="confirmDeletion" class="mt-3 text-sm text-white font-medium bg-blue-600 hover:bg-blue-500 px-4 py-2 rounded-lg">Confirm</button>
            </div>
        </div>
    </Modal>
</template>