<script setup>
import {Link} from '@inertiajs/vue3';

defineProps({
    crumbs: Array
})

</script>

<template>

    <nav class="bg-gray-200 p-2 rounded-lg shadow-sm border-2 w-[300px]" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
          <li class="inline-flex items-center" v-for="(item, index) in crumbs" :key="index">   
            <div class="flex items-center">
              <!-- <svg v-if="index !== crumbs.length && index !== 0" class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
              </svg> -->
              <span v-if="index !== crumbs.length && index !== 0" class="text-gray-400">/</span>

              <Link v-if="index < (crumbs.length - 1)" :href="item.url" class="ml-1 text-sm font-medium text-gray-500 hover:text-gray-700 md:ml-2">              
                {{ item.name }}            
              </Link>

              <span v-else class="ml-1 text-sm font-semibold text-gray-700 md:ml-2">{{ item.name }}</span>
            </div>
          </li>
        </ol>
    </nav>
  
</template>