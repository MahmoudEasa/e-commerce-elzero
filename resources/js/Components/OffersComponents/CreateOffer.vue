<script setup>
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { useForm } from "@inertiajs/inertia-vue3";
import { ref } from "vue";

const offerNameEnInput = ref(null);
const offerNameArInput = ref(null);
const priceInput = ref(null);
const detailsEnInput = ref(null);
const detailsArInput = ref(null);

const form = useForm({
    offerName_en: props.updateData.offerName_en,
    offerName_ar: props.updateData.offerName_ar,
    price: props.updateData.price,
    details_en: props.updateData.details_en,
    details_ar: props.updateData.details_ar,
    id: props.updateData.id,
    success: false,
});

const createOffer = (routName, id = "") => {
    form.success = false;
    form.post(route(routName, id), {
        preserveScroll: true,
        onSuccess: () => {
            form.reset();
            form.success = true;
        },
        onError: () => {
            if (form.errors.offerName_en) {
                form.reset("offerName_en");
                offerNameEnInput.value.focus();
            }
            if (form.errors.offerName_ar) {
                form.reset("offerName_ar");
                offerNameArInput.value.focus();
            }
            if (form.errors.price) {
                form.reset("price");
                priceInput.value.focus();
            }
            if (form.errors.details_en) {
                form.reset("details_en");
                detailsEnInput.value.focus();
            }
            if (form.errors.details_ar) {
                form.reset("details_ar");
                detailsArInput.value.focus();
            }
        },
    });
};

const props = defineProps({
    langs: Object,
    update: Boolean,
    updateData: {
        type: Object,
        default: {
            id: "",
            offerName_en: "",
            offerName_ar: "",
            price: "",
            details_en: "",
            details_ar: "",
        },
    },
});
</script>

<template>
    <section>
        <header>
            <h2 v-if="update" class="text-lg font-medium text-gray-900">
                {{ langs.updateOffer }}
            </h2>
            <h2 v-else class="text-lg font-medium text-gray-900">
                {{ langs.createOffer }}
            </h2>
        </header>

        <div
            v-if="form.success"
            style="background-color: #4caf50d1; border-radius: 10px"
            class="mt-6 p-4 text-white font-bold space-y-6"
        >
            <p v-if="update">{{ langs.updatedSuccessfully }}</p>
            <p v-else>{{ langs.createdSuccessfully }}</p>
        </div>

        <form
            @submit.prevent="
                update
                    ? createOffer('updateOffer', updateData.id)
                    : createOffer('createOffer')
            "
            class="mt-6 space-y-6"
        >
            <div>
                <InputLabel for="offerName_en" :value="langs.offerName_en" />

                <TextInput
                    id="offerName_en"
                    ref="offerNameEnInput"
                    v-model="form.offerName_en"
                    type="text"
                    class="mt-1 block w-full"
                    autocomplete="offerName_en"
                />

                <InputError :message="form.errors.offerName_en" class="mt-2" />
            </div>
            <div>
                <InputLabel for="offerName_ar" :value="langs.offerName_ar" />

                <TextInput
                    id="offerName_ar"
                    ref="offerNameArInput"
                    v-model="form.offerName_ar"
                    type="text"
                    class="mt-1 block w-full"
                    autocomplete="offerName_ar"
                />

                <InputError :message="form.errors.offerName_ar" class="mt-2" />
            </div>

            <div>
                <InputLabel for="price" :value="langs.price" />

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
                <InputLabel for="details_en" :value="langs.details_en" />

                <TextInput
                    id="details_en"
                    ref="detailsEnInput"
                    v-model="form.details_en"
                    type="text"
                    class="mt-1 block w-full"
                    autocomplete="details_en"
                />

                <InputError :message="form.errors.details_en" class="mt-2" />
            </div>
            <div>
                <InputLabel for="details_ar" :value="langs.details_ar" />

                <TextInput
                    id="details_ar"
                    ref="detailsArInput"
                    v-model="form.details_ar"
                    type="text"
                    class="mt-1 block w-full"
                    autocomplete="details_ar"
                />

                <InputError :message="form.errors.details_ar" class="mt-2" />
            </div>

            <div class="flex items-center gap-4">
                <PrimaryButton v-if="update" :disabled="form.processing">{{
                    langs.update
                }}</PrimaryButton>

                <PrimaryButton v-else :disabled="form.processing">{{
                    langs.create
                }}</PrimaryButton>

                <Transition
                    enter-from-class="opacity-0"
                    leave-to-class="opacity-0"
                    class="transition ease-in-out"
                >
                    <p
                        v-if="form.recentlySuccessful && update"
                        class="text-sm text-gray-600"
                    >
                        {{ langs.updated }}
                    </p>

                    <p
                        v-else-if="form.recentlySuccessful"
                        class="text-sm text-gray-600"
                    >
                        {{ langs.created }}
                    </p>
                </Transition>
            </div>
        </form>
    </section>
</template>
