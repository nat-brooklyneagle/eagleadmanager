<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/inertia-vue3';
import ActionSection from '@/Components/ActionSection.vue';
import ConfirmationModal from '@/Components/ConfirmationModal.vue';
import DangerButton from '@/Components/DangerButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';

const props = defineProps({
    advertiser: Object,
});

const confirmingAdvertiserDeletion = ref(false);
const form = useForm();

const confirmAdvertiserDeletion = () => {
    confirmingAdvertiserDeletion.value = true;
};

const deleteAdvertiser = () => {
    form.delete(route('advertisers.destroy', props.advertiser), {
        errorBag: 'deleteAdvertiser',
    });
};
</script>

<template>
    <ActionSection>
        <template #title>
            Delete Advertiser
        </template>

        <template #description>
            Permanently delete this advertiser.
        </template>

        <template #content>
            <div class="max-w-xl text-sm text-gray-600">
                Once a advertiser is deleted, all of its resources and data will be permanently deleted. Before deleting this advertiser, please download any data or information regarding this advertiser that you wish to retain.
            </div>

            <div class="mt-5">
                <DangerButton @click="confirmAdvertiserDeletion">
                    Delete Advertiser
                </DangerButton>
            </div>

            <!-- Delete Advertiser Confirmation Modal -->
            <ConfirmationModal :show="confirmingAdvertiserDeletion" @close="confirmingAdvertiserDeletion = false">
                <template #title>
                    Delete Advertiser
                </template>

                <template #content>
                    Are you sure you want to delete this advertiser? Once a advertiser is deleted, all of its resources and data will be permanently deleted.
                </template>

                <template #footer>
                    <SecondaryButton @click="confirmingAdvertiserDeletion = false">
                        Cancel
                    </SecondaryButton>

                    <DangerButton
                        class="ml-3"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                        @click="deleteAdvertiser"
                    >
                        Delete Advertiser
                    </DangerButton>
                </template>
            </ConfirmationModal>
        </template>
    </ActionSection>
</template>
