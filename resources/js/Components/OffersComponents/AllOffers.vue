<script>
import NavLink from "@/Components/NavLink.vue";
import axios from "axios";
import { TailwindPagination } from "laravel-vue-pagination";

export default {
    name: "AllOffers",
    data() {
        return {
            isLoading: false,
            isError: false,
            isSuccess: false,
            succesMessage: "",
            errorMessage: "",
            offers: [],
            links: {},
        };
    },
    components: { NavLink, TailwindPagination },
    computed: {},
    methods: {
        handleDelete(id) {
            this.isLoading = true;
            this.isSuccess = false;
            this.isError = false;
            axios
                .delete(route("deleteOffer", id))
                .then((data) => {
                    this.isLoading = false;
                    if (data.data.status == true) {
                        const fillterd = this.offers.filter(
                            (offer) => offer.id != id
                        );
                        this.offers = fillterd;
                        this.isSuccess = true;
                        this.succesMessage = data.data.message;
                    } else {
                        this.isError = true;
                        this.errorMessage = data.data.message;
                    }
                })
                .catch((error) => {
                    this.isLoading = false;
                    this.isError = true;
                    console.log(error);
                });
        },
        getResult(page = 1) {
            this.isLoading = true;
            this.isSuccess = false;
            this.isError = false;
            axios
                .get(route("getOffers", { page: page }))
                .then((data) => {
                    this.isLoading = false;

                    if (data.data.status == true) {
                        this.offers = data.data.allOffers.data;
                        this.links = data.data.allOffers;
                    } else {
                        this.isError = true;
                        this.errorMessage = data.data.message;
                    }
                })
                .catch((error) => {
                    this.isLoading = false;
                    this.isError = true;
                    console.log(error);
                });
        },
    },
    created() {
        this.getResult();
    },
};
</script>

<template>
    <!-- Error Message -->
    <div v-if="isError" class="text-center mb-4 text-red-600 font-bold text-lg">
        {{ errorMessage ? errorMessage : $t("messages.somthingIsWrong") }}
    </div>
    <!-- Success Message -->
    <div
        v-if="isSuccess"
        class="text-center mb-4 text-green-600 font-bold text-lg"
    >
        {{ succesMessage }}
    </div>
    <!-- Loading -->
    <div
        v-if="isLoading"
        class="text-center mb-4 text-gray-600 font-bold text-lg"
    >
        {{ $t("messages.loading") }}
    </div>

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
            <tr v-for="(offer, i) in offers" :key="offer.id">
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
                    <button
                        class="font-semibold text-red-700 text-base leading-tight"
                        @click="handleDelete(offer.id)"
                    >
                        {{ $t("messages.delete") }}
                    </button>
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

    <div class="flex justify-center w-full items-center pt-5">
        <TailwindPagination :data="links" @pagination-change-page="getResult" />
    </div>
</template>
