<script setup>
import {useForm} from '@inertiajs/inertia-vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import FormSection from '@/Components/FormSection.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SectionBorder from '@/Components/SectionBorder.vue';

const addAdvertiserForm = useForm({
    company_name: '',
    first_name: '',
    last_name: '',
    email_address: '',
    address: '',
    address2: '',
    city: '',
    state: '',
    zip: '',
});

const addAdvertiser = () => {
    addAdvertiserForm.post(route('advertisers.store'), {
        errorBag: 'addAdvertiser',
        preserveScroll: true,
        onSuccess: () => addAdvertiserForm.reset(),
    });
};

</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Create Advertiser
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-900 overflow-hidden sm:rounded-lg">
                    <!--                    <Welcome />-->
                    <SectionBorder />
                    <FormSection @submitted="addAdvertiser">
                        <template #title>
                            Add Advertiser
                        </template>

                        <template #description>
                            Add a new advertiser.
                        </template>
                        <template #form>
                            <div class="col-span-6">
                                <div class="max-w-xl text-sm text-gray-600 dark:text-gray-400">
                                    Please provide the contact information for the advertiser you would like to add.
                                </div>
                            </div>

                            <!-- Advertiser Company Name -->
                            <div class="col-span-6 sm:col-span-4">
                                <InputLabel for="company_name" value="Company Name"/>
                                <TextInput
                                    id="company_name"
                                    ref="company_name"
                                    v-model="addAdvertiserForm.company_name"
                                    type="text"
                                    class="mt-1 block w-full"
                                    autofocus
                                />
                                <InputError :message="addAdvertiserForm.errors.company_name" class="mt-2"/>
                            </div>

                            <!-- Advertiser First Name -->
                            <div class="col-span-6 sm:col-span-4">
                                <InputLabel for="first_name" value="First Name"/>
                                <TextInput
                                    id="first_name"
                                    ref="first_name"
                                    v-model="addAdvertiserForm.first_name"
                                    type="text"
                                    class="mt-1 block w-full"
                                    autofocus
                                />
                                <InputError :message="addAdvertiserForm.errors.first_name" class="mt-2"/>
                            </div>

                            <!-- Advertiser Last Name -->
                            <div class="col-span-6 sm:col-span-4">
                                <InputLabel for="last_name" value="Last Name"/>
                                <TextInput
                                    id="last_name"
                                    ref="last_name"
                                    v-model="addAdvertiserForm.last_name"
                                    type="text"
                                    class="mt-1 block w-full"
                                />
                                <InputError :message="addAdvertiserForm.errors.last_name" class="mt-2"/>
                            </div>

                            <!-- Advertiser Address -->
                            <div class="col-span-6 sm:col-span-4">
                                <InputLabel for="address" value="Address"/>
                                <TextInput
                                    id="address"
                                    ref="address"
                                    v-model="addAdvertiserForm.address"
                                    type="text"
                                    class="mt-1 block w-full"
                                />
                                <InputError :message="addAdvertiserForm.errors.address" class="mt-2"/>
                            </div>

                            <!-- Advertiser Address 2 -->
                            <div class="col-span-6 sm:col-span-4">
                                <InputLabel for="address2" value="Address 2"/>
                                <TextInput
                                    id="address2"
                                    ref="address2"
                                    v-model="addAdvertiserForm.address2"
                                    type="text"
                                    class="mt-1 block w-full"
                                />
                                <InputError :message="addAdvertiserForm.errors.address2" class="mt-2"/>
                            </div>

                            <!-- Advertiser City -->
                            <div class="col-span-6 sm:col-span-4">
                                <InputLabel for="last_name" value="City"/>
                                <TextInput
                                    id="city"
                                    ref="city"
                                    v-model="addAdvertiserForm.city"
                                    type="text"
                                    class="mt-1 block w-full"
                                />
                                <InputError :message="addAdvertiserForm.errors.city" class="mt-2"/>
                            </div>

                            <!-- Advertiser State -->
                            <div class="col-span-6 sm:col-span-4">
                                <InputLabel for="state" value="State"/>
                                <TextInput
                                    id="state"
                                    ref="state"
                                    v-model="addAdvertiserForm.state"
                                    type="text"
                                    class="mt-1 block w-full"
                                />
                                <InputError :message="addAdvertiserForm.errors.state" class="mt-2"/>
                            </div>

                            <!-- Advertiser Zip -->
                            <div class="col-span-6 sm:col-span-4">
                                <InputLabel for="state" value="Zip"/>
                                <TextInput
                                    id="zip"
                                    ref="zip"
                                    v-model="addAdvertiserForm.zip"
                                    type="text"
                                    class="mt-1 block w-full"
                                />
                                <InputError :message="addAdvertiserForm.errors.zip" class="mt-2"/>
                            </div>

                            <!-- Advertiser Email Address -->
                            <div class="col-span-6 sm:col-span-4">
                                <InputLabel for="email_address" value="Email Address"/>
                                <TextInput
                                    id="email_address"
                                    ref="email_address"
                                    v-model="addAdvertiserForm.email_address"
                                    type="email"
                                    class="mt-1 block w-full"
                                />
                                <InputError :message="addAdvertiserForm.errors.email_address" class="mt-2"/>
                            </div>
                        </template>

                        <template #actions>
                            <PrimaryButton :class="{ 'opacity-25': addAdvertiserForm.processing }" :disabled="addAdvertiserForm.processing">
                                Save
                            </PrimaryButton>
                        </template>
                    </FormSection>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
