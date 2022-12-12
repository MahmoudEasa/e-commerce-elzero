<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import CreateOffer from "../../Components/OffersComponents/CreateOffer.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import NavLink from "@/Components/NavLink.vue";
import { Head } from "@inertiajs/inertia-vue3";

defineProps({
    createOffer: Boolean,
    langs: Object,
    allOffers: Object,
});
</script>

<template>
    <Head :title="langs.offers" />

    <AuthenticatedLayout>
        <template #header>
            <NavLink
                class="font-semibold text-xl text-gray-800 leading-tight"
                :href="route('offers')"
            >
                {{ langs.offers }}
            </NavLink>
            <NavLink
                class="font-semibold text-gray-800 leading-tight"
                :href="route('offer.create')"
            >
                {{ langs.createOffer }}
            </NavLink>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div
                    v-if="createOffer"
                    class="p-4 sm:p-8 bg-white shadow sm:rounded-lg"
                >
                    <CreateOffer class="max-w-xl" :langs="langs" />
                </div>

                <div v-else class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <table
                        class="w-full border-collapse border border-slate-500"
                    >
                        <thead class="bg-gray-700 text-white">
                            <tr>
                                <th class="border border-slate-600 p-2">#</th>
                                <th class="border border-slate-600 p-2">
                                    {{ langs.offerName }}
                                </th>
                                <th class="border border-slate-600 p-2">
                                    {{ langs.price }}
                                </th>
                                <th class="border border-slate-600 p-2">
                                    {{ langs.details }}
                                </th>
                                <th class="border border-slate-600 p-2">
                                    {{ langs.actions }}
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(offer, i) in allOffers" :key="offer.id">
                                <td
                                    class="border border-slate-700 p-2 text-center"
                                >
                                    {{ i }}
                                </td>
                                <td class="border border-slate-700 p-2">
                                    {{ offer.offerName }}
                                </td>
                                <td class="border border-slate-700 p-2">
                                    {{ offer.price }}
                                </td>
                                <td class="border border-slate-700 p-2">
                                    {{ offer.details }}
                                </td>
                                <td
                                    class="border border-slate-700 p-2 text-center"
                                >
                                    <NavLink
                                        class="font-semibold text-red-700 leading-tight"
                                        :href="route('deleteOffer', offer.id)"
                                    >
                                        {{ langs.delete }}
                                    </NavLink>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
