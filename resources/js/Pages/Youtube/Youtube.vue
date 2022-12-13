<script setup>
import AuthenticatedLayoutVue from "@/Layouts/AuthenticatedLayout.vue";
import NavLink from "@/Components/NavLink.vue";
import { Head } from "@inertiajs/inertia-vue3";

const props = defineProps({
    videoData: Object,
});
</script>

<template>
    <Head title="YouTube" />

    <AuthenticatedLayoutVue>
        <template #header>
            <NavLink
                class="font-semibold text-xl text-gray-800 leading-tight"
                :href="route('offers')"
            >
                Youtube
            </NavLink>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div
                    class="p-4 sm:p-8 bg-white shadow sm:rounded-lg flex flex-col items-center"
                >
                    <h1 class="mb-5 font-bold text-xl">
                        Video View Is: ({{ videoData.viewers }})
                    </h1>

                    <iframe
                        width="560"
                        height="315"
                        src="https://www.youtube.com/embed/GVNDbTwOSiw"
                        title="YouTube video player"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen
                    ></iframe>
                </div>
            </div>
        </div>
    </AuthenticatedLayoutVue>
</template>
