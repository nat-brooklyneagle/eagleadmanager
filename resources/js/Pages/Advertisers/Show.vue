<script setup>
import {Head, Link, useForm} from '@inertiajs/inertia-vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
const form = useForm();
import DangerButton from '@/Components/DangerButton.vue';
import SectionBorder from '@/Components/SectionBorder.vue';
import DeleteAdvertiserForm from '@/Pages/Teams/Partials/DeleteAdvertiserForm.vue';


const confirmAdvertiserDeletion = () => {
    confirmingAdvertiserDeletion.value = true;
};

const props = defineProps({
    advertiser: Object,
    permissions: Object,
});

const deleteAdvertiser = () => {
    form.delete(route('advertisers.destroy', props.advertiser), {
        errorBag: 'deleteAdvertiser',
    });
};
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <div class="grid grid-cols-2">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{$page.props.advertiser.full_name}}
                </h2>
                <div class="text-right">
                    <template v-if="permissions.canEditAdvertiser">
                        <Link :href="route('advertisers.edit', {advertiser})"
                              title="Create Advertiser"
                              class="dark:text-white inline-flex w-full items-center justify-center rounded-md border border-transparent bg-white dark:bg-gray-700 px-4 py-2 text-base font-medium text-gray-600 hover:bg-gray-50 dark:hover:bg-gray-500 sm:w-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                            </svg>

                            Edit
                        </Link>
                    </template>
                </div>
            </div>

        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-12">
<!--                    <Welcome />-->
                    Advertiser information for {{$page.props.advertiser.first_name}} will appear here.

                    <div>
                    Email Addresses
                    <template v-if="$page.props.email_addresses.length > 0" v-for="email_address in $page.props.email_addresses">
                        <div>
<!--                            <Link :href="route('advertisers.show', {'advertiser': advertiser})">-->
                                {{ email_address.email_address }}
<!--                            </Link>-->
                        </div>
                    </template>
                    <template v-else>
                        No Email Addresses.
                    </template>
                    <div></div>
                    </div>
                </div>
                <template v-if="true">
                    <div class="my-20">
                        <DeleteAdvertiserForm class="mt-10 sm:mt-0" :advertiser="advertiser" />
                    </div>
                </template>
            </div>
        </div>
    </AppLayout>
</template>
