<script setup>
import NavLink from "@/Components/NavLink.vue";

const props = defineProps({
    allOffers: Array,
});
</script>

<template>
    <table class="w-full border-collapse border border-slate-300">
        <thead class="bg-gray-700 text-white">
            <tr>
                <th class="border border-slate-600 p-2" style="min-width: 60px">
                    #
                </th>
                <th
                    class="border border-slate-600 p-2"
                    style="min-width: 200px"
                >
                    {{ $t("messages.offerName") }}
                </th>
                <th
                    class="border border-slate-600 p-2"
                    style="min-width: 100px"
                >
                    {{ $t("messages.price") }}
                </th>
                <th
                    class="border border-slate-600 p-2"
                    style="min-width: 200px"
                >
                    {{ $t("messages.details") }}
                </th>
                <th
                    class="border border-slate-600 p-2"
                    style="min-width: 200px"
                >
                    {{ $t("messages.actions") }}
                </th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(offer, i) in allOffers" :key="offer.id">
                <td class="border border-slate-400 p-2 text-center">
                    {{ i }}
                </td>
                <td class="border border-slate-300 p-2 flex items-center gap-2">
                    <img
                        class="w-10 h-10 rounded-full"
                        :src="'/images/offers/' + offer.photo"
                        alt=""
                    />
                    {{ offer.offerName }}
                </td>
                <td class="border border-slate-400 p-2">
                    {{ offer.price }}
                </td>
                <td class="border border-slate-400 p-2">
                    {{ offer.details }}
                </td>
                <td class="border border-slate-400 text-center">
                    <NavLink
                        class="font-semibold text-red-700 text-base leading-tight"
                        :href="route('deleteOffer', offer.id)"
                    >
                        {{ $t("messages.delete") }}
                    </NavLink>
                    <NavLink
                        class="font-semibold text-green-700 text-base leading-tight"
                        :href="route('offer.edit', offer.id)"
                    >
                        {{ $t("messages.update") }}
                    </NavLink>
                </td>
            </tr>
        </tbody>
    </table>
</template>
