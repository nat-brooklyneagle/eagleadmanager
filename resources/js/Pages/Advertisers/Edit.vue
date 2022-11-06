<script setup>
import {useForm} from '@inertiajs/inertia-vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import FormSection from '@/Components/FormSection.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SectionBorder from '@/Components/SectionBorder.vue';


const props = defineProps({
    advertiser: Object,
});
const advertiser = props.advertiser;

const updateAdvertiserForm = useForm({
    first_name: props.advertiser.first_name,
    last_name: props.advertiser.last_name,
});

const updateAdvertiser = () => {
    updateAdvertiserForm.patch(route('advertisers.update', {advertiser}), {
        errorBag: 'updateAdvertiser',
        preserveScroll: true,
        onSuccess: () => updateAdvertiserForm.reset(),
    });
};

</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Edit Advertiser
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-900 overflow-hidden sm:rounded-lg">
                    <!--                    <Welcome />-->
                    <SectionBorder />
                    <FormSection @submitted="updateAdvertiser">
                        <template #title>
                            Edit Advertiser
                        </template>

                        <template #description>
                            Update this advertiser.
                        </template>
                        <template #form>
                            <div class="col-span-6">
                                <div class="max-w-xl text-sm text-gray-600 dark:text-gray-400">
                                    Please provide the contact information for the advertiser you would like to add.
                                </div>
                            </div>

                            <!-- Advertiser First Name -->
                            <div class="col-span-6 sm:col-span-4">
                                <InputLabel for="first_name" value="First Name"/>
                                <TextInput
                                    id="first_name"
                                    ref="first_name"
                                    v-model="updateAdvertiserForm.first_name"
                                    type="text"
                                    class="mt-1 block w-full"
                                    autofocus
                                />
                                <InputError :message="updateAdvertiserForm.errors.first_name" class="mt-2"/>
                            </div>

                            <!-- Advertiser Last Name -->
                            <div class="col-span-6 sm:col-span-4">
                                <InputLabel for="last_name" value="Last Name"/>
                                <TextInput
                                    id="last_name"
                                    ref="last_name"
                                    v-model="updateAdvertiserForm.last_name"
                                    type="text"
                                    class="mt-1 block w-full"
                                />
                                <InputError :message="updateAdvertiserForm.errors.last_name" class="mt-2"/>
                            </div>
                        </template>

                        <template #actions>
                            <PrimaryButton :class="{ 'opacity-25': updateAdvertiserForm.processing }" :disabled="updateAdvertiserForm.processing">
                                Save
                            </PrimaryButton>
                        </template>
                    </FormSection>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
