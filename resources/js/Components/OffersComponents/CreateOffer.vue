<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/inertia-vue3';
import { ref } from 'vue';

const offerNameInput = ref(null);
const priceInput = ref(null);
const detailsInput = ref(null);

const form = useForm({
    offerName: '',
    price: '',
    details: '',
    success: false,
});

const createOffer = () => {
    form.success = false;
    form.post(route('createOffer'), {
        preserveScroll: true,
        onSuccess: () => {
            form.reset();
            form.success = true;
        },
        onError: () => {
            if (form.errors.offerName) {
                form.reset('offerName');
                offerNameInput.value.focus();
            }
            if (form.errors.price) {
                form.reset('price');
                priceInput.value.focus();
            }
            if (form.errors.details) {
                form.reset('details');
                detailsInput.value.focus();
            }
        },
    });
};
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">Create Offer</h2>
        </header>
        
        <div
            v-if="form.success"
            style="background-color:#4caf50d1;border-radius: 10px;"
            class="mt-6 p-4 text-white font-bold space-y-6"
            >Created Successfully</div>

        <form @submit.prevent="createOffer" class="mt-6 space-y-6">
            <div>
                <InputLabel for="offerName" value="Offer Name" />

                <TextInput
                    id="offerName"
                    ref="offerNameInput"
                    v-model="form.offerName"
                    type="text"
                    class="mt-1 block w-full"
                    autocomplete="offerName"
                />

                <InputError :message="form.errors.offerName" class="mt-2" />
            </div>

            <div>
                <InputLabel for="price" value="Price" />

                <TextInput
                    id="price"
                    ref="priceInput"
                    v-model="form.price"
                    type="text"
                    class="mt-1 block w-full"
                    autocomplete="price"
                />

                <InputError :message="form.errors.price" class="mt-2" />
            </div>

            <div>
                <InputLabel for="details" value="Details" />

                <TextInput
                    id="details"
                    ref="detailsInput"
                    v-model="form.details"
                    type="text"
                    class="mt-1 block w-full"
                    autocomplete="details"
                />

                <InputError :message="form.errors.details" class="mt-2" />
            </div>

            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing">Create</PrimaryButton>

                <Transition enter-from-class="opacity-0" leave-to-class="opacity-0" class="transition ease-in-out">
                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Created.</p>
                </Transition>
            </div>
        </form>
    </section>
</template>
