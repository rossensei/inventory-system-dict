<script setup>
import { ref } from 'vue';
import ToastListItem from './ToastListItem.vue';
import { router, usePage } from '@inertiajs/vue3';
import toast from '@/composables/toast';
import { onUnmounted } from 'vue';

const items = ref([])

const page = usePage();

const removeFinishEventListener = router.on('finish', () => {
    if(page.props.flash.success) {
        toast.add({
            intent: 'Success',
            message: page.props.flash.success
        })
    }

    if(page.props.flash.error) {
        toast.add({
            intent: 'Error',
            message: page.props.flash.error
        })
    }
})


onUnmounted(() => removeFinishEventListener());

const remove = (index) => {
    toast.remove(index, 1)
}
</script>
<template>
    <TransitionGroup 
    tag="div"
    enter-from-class="translate-x-full opacity-0"
    enter-active-class="duration-500"
    leave-active-class="duration-500"
    leave-to-class="translate-x-full opacity-0"
    class="fixed right-4 top-4 z-50 space-y-4 w-full max-w-xs">
        <ToastListItem v-for="(item, index) in toast.items" :key="item.key" :item="item" @remove="remove(index)" />
    </TransitionGroup>
</template>