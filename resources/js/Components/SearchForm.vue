<template>
    <label for="search" class="relative">
        <input 
        id="search"
        type="text"
        @input="$emit('search', $event.target.value)"
        class="rounded-lg text-sm pl-8 w-[200px] focus:w-[300px] transition-[width] ease-out border-gray-300" 
        placeholder="Search for employee"
        >

        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
            </svg>
        </span>
    </label>
</template>