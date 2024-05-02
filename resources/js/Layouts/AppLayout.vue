<script setup>
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import FallbackUserPhoto from '@/Components/FallbackUserPhoto.vue';
import NavMenu from '@/Components/NavMenu.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import ToastList from '@/Components/ToastList.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div>
        <!-- Toast -->
        <ToastList />

        <div class="flex items-start min-h-screen bg-gray-50">
            <nav class="sticky top-0 z-10 bg-[#087ec2ff] min-h-screen w-64 shadow-md">
                <div class="relative p-4">
                    <!-- Logo branding -->
                    <Link :href="route('dashboard')" class="w-full block space-y-2">
                        <img src="../../../public/images/Logo.png" alt="mdc-logo" class="w-[80px] mx-auto">
                        <h1 class="text-xl font-semibold text-white text-center">DICT INVENTORY SYSTEM</h1>
                    </Link>

                    <NavMenu />
                </div>
            </nav>
            <div class="flex-1 min-h-screen overflow-hidden">
                <div class="w-full p-4">
                    <div class="flex justify-end">
                        <div class="ml-3 relative">
                            <Dropdown align="right" width="48">
                                <template #trigger>
                                    <span class="inline-flex items-center rounded-md">
                                        <!-- <button
                                            type="button"
                                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-transparent hover:bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"
                                        >
                                            {{ $page.props.auth.user.name }}

                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                                            <path fill-rule="evenodd" d="M11.47 4.72a.75.75 0 0 1 1.06 0l3.75 3.75a.75.75 0 0 1-1.06 1.06L12 6.31 8.78 9.53a.75.75 0 0 1-1.06-1.06l3.75-3.75Zm-3.75 9.75a.75.75 0 0 1 1.06 0L12 17.69l3.22-3.22a.75.75 0 1 1 1.06 1.06l-3.75 3.75a.75.75 0 0 1-1.06 0l-3.75-3.75a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                                            </svg>
                                        </button> -->

                                        <button type="button" class="inline-flex items-center text-xs text-gray-500 font-medium uppercase">
                                            {{ $page.props.auth.user.name }}
                                            <div class="w-[38px] h-[38px] rounded-full overflow-hidden ml-1">
                                                <img :src="$page.props.auth.user.user_photo_url" alt="user-photo" class="w-full h-full object-cover">
                                            </div>
                                        </button>
                                    </span>

                                    
                                </template>

                                <template #content>
                                    <DropdownLink :href="route('profile.edit')" class="inline-flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        </svg>
                                        Profile
                                    </DropdownLink>
                                    <DropdownLink :href="route('change-password.edit')" class="inline-flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 5.25a3 3 0 0 1 3 3m3 0a6 6 0 0 1-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1 1 21.75 8.25Z" />
                                        </svg>
                                        Change password
                                    </DropdownLink>
                                    <DropdownLink :href="route('logout')" method="post" as="button" class="inline-flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                                        </svg>
                                        Log Out
                                    </DropdownLink>
                                </template>
                            </Dropdown>
                        </div>
                    </div>

                </div>
                <header class="" v-if="$slots.header">
                    <div class="w-full px-6">
                        <slot name="header" />
                    </div>
                </header>
                <main>
                    <Transition name="fade" mode="out-in" appear>
                        <slot />
                    </Transition>
                </main>
            </div>
        </div>
    </div>
</template>

<style scoped>
.slide-enter-active {
    transition: all 0.1s ease-out;
}

.slide-leave-active {
    transition: all 0.1s ease-in;
}

.slide-enter-from,
.slide-leave-to {
    transform: translateY(-20px);
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}

.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.5s ease-out;
}
</style>
