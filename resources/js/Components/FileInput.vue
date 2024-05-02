<script setup>
const props = defineProps({
    mimeType: {
        type: [String, null],
    },
    idName: {
        type: String,
        required: true,
    }
})

const emits = defineEmits(['change']);

const handleFileUpload = (e) => {
    emits('change', e.target.files[0]);
}
</script>

<template>
    <div>
        <input 
        type="file" 
        :id="idName" 
        @change="handleFileUpload($event)" 
        class="
        block w-full text-sm text-slate-500
        file:mr-4 file:py-2 file:px-4
        file:rounded-full file:border-0
        file:text-sm file:font-semibold
        file:bg-blue-50 file:text-blue-700
        hover:file:bg-blue-100
        "
        :accept="mimeType">
    </div>
</template>