<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import CreateOffer from "../../Components/AjaxOffersComponents/CreateOffer.vue";
import AllOffers from "../../Components/AjaxOffersComponents/AllOffers.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import NavLink from "@/Components/NavLink.vue";
import { Head } from "@inertiajs/inertia-vue3";

defineProps({
    createOffer: Boolean,
    allOffers: Object,
    update: Boolean,
    updateData: Object,
});
</script>

<template>
    <Head :title="$t('messages.offers')" />

    <AuthenticatedLayout>
        <template #header>
            <NavLink
                class="font-semibold text-xl text-gray-800 leading-tight"
                :href="route('offers')"
            >
                {{ $t("messages.offers") }}
            </NavLink>
            <NavLink
                class="font-semibold text-gray-800 leading-tight"
                :href="route('offer.create')"
            >
                {{ $t("messages.createOffer") }}
            </NavLink>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div
                    v-if="createOffer"
                    class="p-4 sm:p-8 bg-white shadow sm:rounded-lg"
                >
                    <CreateOffer
                        class="max-w-xl"
                        :update="update"
                        :updateData="updateData"
                    />
                </div>

                <div
                    v-else
                    class="p-4 overflow-auto sm:p-8 bg-white shadow sm:rounded-lg"
                >
                    <AllOffers :allOffers="allOffers" />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
