<script setup>
import { ref } from 'vue';

const props = defineProps({
  text: {
    type: String,
    required: true,
  }
})

const show = ref(false);
</script>

<template>
  <div class="relative" @mouseenter="show = true" @mouseleave="show = false">
    <Transition
      enter-active-class="ease-out duration-300"
      enter-from-class="opacity-0"
      enter-to-class="opacity-100"
      leave-active-class="ease-in duration-200"
      leave-from-class="opacity-100"
      leave-to-class="opacity-0"
    >
      <span v-show="show" id="tooltip-text" 
      class="
        absolute 
        left-1/2 
        -translate-x-1/2 -top-8 
        text-xs text-white 
        bg-gray-700 
        font-medium 
        px-3 py-2 
        rounded-lg 
        select-none
        before:content-['']
        before:absolute
        before:left-1/2
        before:-bottom-1
        before:-translate-x-1/2
        before:border-[5px]
        before:rotate-45
        before:border-gray-700
      "
      >{{ text }}</span>
    </Transition>
      <slot />
  </div>
</template>