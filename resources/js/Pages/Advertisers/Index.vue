<script setup>
import {Link} from '@inertiajs/inertia-vue3';
import AppLayout from '@/Layouts/AppLayout.vue';</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <div class="grid grid-cols-2">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    Advertisers
                </h2>
                <div class="text-right">
                    <Link :href="route('advertisers.create')"
                          title="Create Advertiser"
                          class="dark:text-white inline-flex w-full items-center justify-center rounded-md border border-transparent bg-white dark:bg-gray-700 px-4 py-2 text-base font-medium text-gray-600 hover:bg-gray-50 dark:hover:bg-gray-500 sm:w-auto">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="w-6 h-6 mr-2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                        </svg>
                        Create
                    </Link>
                </div>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                    <!--                    <Welcome />-->


                    <div class="p-8">
                        <template v-for="advertiser in $page.props.advertisers">
                            <div>
                                <Link :href="route('advertisers.show', {'advertiser': advertiser})">
                                    {{ advertiser.full_name }}
                                </Link>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
