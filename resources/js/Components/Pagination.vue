<script setup>
import { Link } from '@inertiajs/vue3';
import { computed, ref } from 'vue';

const props = defineProps({
    meta: Object,
    links: Object,
});

const filteredLinks = computed(() => props.meta.links.filter(link => !link.label.includes('Previous') && !link.label.includes('Next') ))

const previousPageUrl = computed(() => props.meta.links.find(link => link.label.includes('Previous')));
const pageNumber = ref(props.meta.per_page)
</script>

<template>
    <nav class="bg-transparent">
        <ul class="list-none inline-flex items-center">
          <li>
            <Link
              class="relative block rounded bg-transparent px-3 py-1.5 text-sm text-surface transition duration-300 hover:bg-neutral-100 focus:bg-neutral-100 focus:text-primary-700 focus:outline-none active:bg-neutral-100 active:text-primary-700"
              :href="links.first"
              aria-label="Previous">
              <span aria-hidden="true">&laquo;</span>
            </Link>
          </li>
          <li>
            <Link
            v-if="links.prev"
              class="relative block rounded bg-transparent px-3 py-1.5 text-sm text-surface transition duration-300 hover:bg-neutral-100 focus:bg-neutral-100 focus:text-primary-700 focus:outline-none active:bg-neutral-100 active:text-primary-700"
              :href="links.prev"
              aria-label="Previous">
              <span aria-hidden="true">&lsaquo;</span>
            </Link>

            <span v-else class="relative block rounded bg-transparent px-3 py-1.5 text-sm text-surface transition duration-300 hover:bg-neutral-100 focus:bg-neutral-100 focus:text-primary-700 focus:outline-none active:bg-neutral-100 active:text-primary-700">&lsaquo;</span>
          </li>
          <li v-for="link in filteredLinks" :key="link">
            <Link
              v-if="!link.active"  
              class="relative block rounded bg-transparent px-3 py-1.5 text-sm text-surface transition duration-300 hover:bg-neutral-100 focus:bg-neutral-100 focus:text-primary-700 focus:outline-none active:bg-neutral-100 active:text-primary-700"
              :href="link.url"
              >{{ link.label }}</Link
            >

            <span v-else class="relative block rounded bg-transparent px-3 py-1.5 text-sm bg-neutral-200 text-gray-900 font-medium">{{ link.label }}</span>
          </li>
          <li>
            <Link
            v-if="links.next"
              class="relative block rounded bg-transparent px-3 py-1.5 text-sm text-surface transition duration-300 hover:bg-neutral-100 focus:bg-neutral-100 focus:text-primary-700 focus:outline-none active:bg-neutral-100 active:text-primary-700"
              :href="links.next"
              aria-label="Next"
              ><span aria-hidden="true">&rsaquo;</span>
            </Link>
            
            <span
              v-else
              class="relative block rounded bg-transparent px-3 py-1.5 text-sm text-surface transition duration-300 hover:bg-neutral-100 focus:bg-neutral-100 focus:text-primary-700 focus:outline-none active:bg-neutral-100 active:text-primary-700"
              aria-label="Next"
            >
            &rsaquo;
            </span>
          </li>
          <li>
            <Link
              class="relative block rounded bg-transparent px-3 py-1.5 text-sm text-surface transition duration-300 hover:bg-neutral-100 focus:bg-neutral-100 focus:text-primary-700 focus:outline-none active:bg-neutral-100 active:text-primary-700"
              :href="links.last"
              aria-label="Next"
              ><span aria-hidden="true">&raquo;</span>
            </Link>
          </li>
        </ul>
    </nav>
</template>