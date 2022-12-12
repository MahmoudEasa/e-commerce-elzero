<script setup>
import NavLink from "@/Components/NavLink.vue";

defineProps({
    langs: Object,
    allOffers: Array,
});
</script>

<template>
    <table class="w-full border-collapse border border-slate-500">
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
                <td class="border border-slate-700 p-2 text-center">
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
                <td class="border border-slate-700 text-center">
                    <NavLink
                        class="font-semibold text-red-700 text-base leading-tight"
                        :href="route('deleteOffer', offer.id)"
                    >
                        {{ langs.delete }}
                    </NavLink>
                    <NavLink
                        class="font-semibold text-green-700 text-base leading-tight"
                        :href="route('offer.edit', offer.id)"
                    >
                        {{ langs.update }}
                    </NavLink>
                </td>
            </tr>
        </tbody>
    </table>
</template>
