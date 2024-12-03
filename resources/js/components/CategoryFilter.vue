<template>
    <strong class="d-block mb-3">Categories ({{ totalCategories }})</strong>
    <div class="input-group mb-3" role="search">
        <span
            class="input-group-text bg-light border-0 border-start border-top border-bottom px-3 py-2"
            id="basic-addon1"
        >
            <i class="ri ri-search-line"></i>
        </span>
        <input
            @input="fetchCategories(searchInputQuery)"
            v-model="searchInputQuery"
            class="form-control search-input border-0 border-top border-bottom border-end bg-light ps-0 py-2"
            type="search"
            placeholder="Search category"
        />
    </div>

    <ul class="list-unstyled filter-list">
        <li v-for="category in categories" :key="category.id">
            <div v-if="category.show !== false" class="form-check mb-2">
                <input
                    @change="applyCatFilter($event, category.id)"
                    :id="'catFilter' + category.id"
                    class="form-check-input"
                    type="checkbox"
                    :value="category.id"
                    :name="'catFilter'"
                />
                <label
                    :for="'catFilter' + category.id"
                    class="form-check-label"
                >
                    {{ category.title }}
                </label>
            </div>
        </li>
    </ul>
</template>

<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";

const router = useRouter();
const baseUrl = import.meta.env.VITE_APP_URL;
const categories = ref([]);
const totalCategories = ref(0);

const selectedCat = ref([]);
const searchInputQuery = ref("");
const emit = defineEmits(["categoryFilter"]);

function applyCatFilter(e, id) {
    // if (e.target.checked) {
    //     selectedCat.value.push(id);
    //     emit("categoryFilter", selectedCat.value);
    //     router.push("/courses");
    // } else {
    //     emit("categoryFilter", selectedCat.value);
    //     router.push("/courses");
    // }
    if (e.target.checked) {
        selectedCat.value.push(id);
    } else {
        selectedCat.value = selectedCat.value.filter((item) => item !== id);
    }

    emit("categoryFilter", selectedCat.value);
    router.push("/courses");
}

// Fetch categories
function fetchCategories(searchQuery) {
    axios
        .get("/categories", {
            headers: {
                "Content-Type": "application/json",
                Accept: "application/json",
            },
            params: {
                search: searchQuery,
            },
        })
        .then((res) => {
            categories.value = res.data.data.categories;
            totalCategories.value = res.data.data.total_items;
        })
        .catch((error) => {
            console.error("Error fetching categories:", error);
        });
}

onMounted(() => {
    fetchCategories();
});
</script>
