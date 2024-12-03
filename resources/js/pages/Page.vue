<template>
    <section class="container py-5">
        <article v-if="page">
            <h1 class="text-center mb-5 text-uppercase">{{ page?.title }}</h1>
            <div v-html="page?.content"></div>
        </article>
        <p v-else class="text-center">
            <i
                class="ri-error-warning-fill d-block display-1 text-danger mb-3"
            ></i>
            <span class="d-block fw-bold h3">Page Not Found!</span>
        </p>
    </section>
</template>

<script setup>
import { useRoute } from "vue-router";
import { useMasterStore } from "@/stores/master";
import { onMounted, ref, watch } from "vue";

const route = useRoute();
const masterStore = useMasterStore();
const page = ref(null);

const fetchPage = () => {
    page.value = masterStore.masterData.pages.find(
        (p) => p.slug === route.params.slug //this fetch my peramitter
    );
    window.scrollTo(0, 0);
};

// Initialize page data on mount
onMounted(fetchPage);

// Watch for changes in the route's slug parameter to update page data
watch(() => route.params.slug, fetchPage);
</script>
