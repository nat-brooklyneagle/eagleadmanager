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
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{$page.props.advertiser.full_name}}
                </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-12">
<!--                    <Welcome />-->


                    Advertiser information for {{$page.props.advertiser.first_name}} will appear here.
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
