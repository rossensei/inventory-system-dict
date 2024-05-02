<script setup>
import { ref } from 'vue';

const isOpen = ref(false);

const toggleAccordion = () => {
    isOpen.value = !isOpen.value;
}
</script>

<template>
    <div>
        <div @click="toggleAccordion">
            <slot name="header"></slot>
        </div>
        <div v-if="isOpen">
            <slot name="content"></slot>
        </div>
  </div>
</template>