<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import CreateOffer from "../../Components/OffersComponents/CreateOffer.vue";
import NavLink from "@/Components/NavLink.vue";
import { Head } from "@inertiajs/inertia-vue3";

defineProps({
    createOffer: Boolean,
});
</script>

<template>
    <Head title="Offers" />

    <AuthenticatedLayout>
        <template #header>
            <NavLink
                class="font-semibold text-xl text-gray-800 leading-tight"
                :href="route('offers')"
            >
                Offers
            </NavLink>
            <NavLink
                class="font-semibold text-gray-800 leading-tight"
                :href="route('offer.create')"
            >
                Create Offer
            </NavLink>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div
                    v-if="createOffer"
                    class="p-4 sm:p-8 bg-white shadow sm:rounded-lg"
                >
                    <CreateOffer class="max-w-xl" />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
