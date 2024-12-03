<template>
    <section class="bg-light py-4">
        <section class="container">
            <div class="row">
                <div class="col-3">
                    <div class="bg-white rounded-3">
                        <div
                            class="d-flex justify-content-between align-items-center border-bottom border-light px-3 py-4"
                        >
                            <h5>Filters</h5>
                            <span
                                @click="applyReset"
                                class="text-decoration-none cursor-pointer text-danger"
                                >Reset</span
                            >
                        </div>

                        <div class="px-3 py-1 border-bottom">
                            <CategoryFilter @categoryFilter="applyCatFilter" />
                        </div>

                        <div class="px-3 py-1 border-bottom">
                            <RatingFilter @RatingFilter="applyRatingFilter" />
                        </div>

                        <div class="px-3 py-1 border-bottom">
                            <InstructorFilter
                                @instructorFilter="applyInstFilter"
                            />
                        </div>

                        <div class="px-3 py-1">
                            <SortOptions @sort="applySort" />
                        </div>
                    </div>
                </div>
                <div class="col-9">
                    <h1 v-if="search" class="fw-bold text-center mb-5">
                        <span class="text-muted">Search -</span> {{ search }}
                    </h1>
                    <h1 v-if="category_id" class="fw-bold text-center mb-5">
                        <span class="text-muted">Category -</span>
                        {{ categoryTitle }}
                    </h1>
                    <section
                        class="d-flex justify-content-between align-items-center p-3 rounded-3 bg-white mb-4"
                    >
                        <span
                            >Showing {{ courses.length }} of
                            {{ totalItems }} courses</span
                        >

                        <div class="col-6">
                            <form
                                @submit.prevent="performSearch"
                                class="input-group border rounded-pill"
                                role="search"
                            >
                                <input
                                    v-model="searchInputQuery"
                                    class="form-control border-0 rounded-pill search-input"
                                    type="search"
                                    placeholder="Search Course"
                                    @input="
                                        searchInputQuery === ''
                                            ? applyReset()
                                            : null
                                    "
                                />
                                <button
                                    type="submit"
                                    class="btn btn-primary d-flex rounded-pill px-4"
                                >
                                    <img
                                        :src="'/assets/images/website/search.svg'"
                                        alt="Search"
                                    />
                                </button>
                            </form>
                        </div>
                    </section>
                    <div class="row row-cols-3">
                        <div
                            v-for="course in courses"
                            :key="course.id"
                            class="mb-4"
                        >
                            <CourseCard :course="course" />
                        </div>
                    </div>
                    <div v-if="courses.length == 0" class="text-center my-5">
                        <h1>
                            <i
                                class="ri-emotion-unhappy-line text-muted d-block display-1 mb-3"
                            ></i>
                        </h1>
                        <h3>No courses found.</h3>
                    </div>

                    <div v-if="courses.length > 0" class="text-center my-4">
                        <VueAwesomePaginate
                            :total-items="totalItems"
                            :items-per-page="itemsPerPage"
                            :max-pages-shown="5"
                            v-model="currentPage"
                            :hide-prev-next-when-ends="true"
                            @click="onClickHandler"
                        />
                    </div>
                </div>
            </div>
        </section>
    </section>
</template>

<script setup>
import { ref, onMounted, watch } from "vue";
import { useRouter, useRoute } from "vue-router";
import axios from "axios";
import CategoryFilter from "../components/CategoryFilter.vue";
import RatingFilter from "../components/RatingFilter.vue";
import InstructorFilter from "../components/InstructorFilter.vue";
import SortOptions from "../components/SortOptions.vue";
import { VueAwesomePaginate } from "vue-awesome-paginate";
import CourseCard from "../components/CourseCard.vue";
import { useAuthStore } from "@/stores/auth";

const authStore = useAuthStore();
const router = useRouter();
const route = useRoute();

const search = ref(route.query.search);
const category_id = ref(route.query.category_id);
const searchInputQuery = ref("");

let categoryTitle = ref("");

let courses = ref([]);
let currentPage = ref(1);
let itemsPerPage = ref(15);
let totalItems = ref(0);

const onClickHandler = (page) => {
    fetchCourses(page);
};

let params = {
    items_per_page: 15,
    page_number: 1,
    sort: "view_count",
    sortDirection: "desc",
};

function applyCatFilter(filterCat) {
    if (filterCat.length === 0) {
        params = {
            items_per_page: 15,
            page_number: 1,
            sort: "view_count",
            sortDirection: "desc",
        };
        router.push("/courses");
        fetchCourses();
    } else {
        params.category_id = filterCat;
        fetchCourses();
    }
}

function applyRatingFilter(filterRat) {
    params.average_rating = filterRat;
    fetchCourses();
}

function applyInstFilter(filterInst) {
    if (filterInst.length === 0) {
        params = {
            items_per_page: 15,
            page_number: 1,
            sort: "view_count",
            sortDirection: "desc",
        };
        router.push("/courses");
        fetchCourses();
    } else {
        params.instructor_id = filterInst;
        fetchCourses();
    }
}

function applySort(property, order) {
    params.sort = property;
    params.sortDirection = order;
    fetchCourses();
}

function applyReset() {
    search.value = null;
    params = {
        items_per_page: 15,
        page_number: 1,
        sort: "view_count",
        sortDirection: "desc",
    };
    fetchCourses();
    router.push("/courses");

    const radioInputs = document.querySelectorAll('input[type="radio"]');
    radioInputs.forEach((input) => {
        input.checked = false;
    });
}

onMounted(() => {
    fetchCourses();
});

watch(
    () => route.query,
    () => {
        search.value = route.query.search;
        category_id.value = route.query.category_id;
        searchInputQuery.value = route.query.search;

        fetchCourses();
    }
);

// Fetch courses
function fetchCourses(pageNumber = 1) {
    if (search.value) {
        params["search"] = search.value;
    }

    if (category_id.value) {
        params["category_id"] = category_id.value;
    }

    params["items_per_page"] = itemsPerPage.value;
    params["page_number"] = pageNumber;

    if (authStore?.authToken) {
        axios
            .get(`/course/list`, {
                headers: {
                    "Content-Type": "application/json",
                    Accept: "application/json",
                    Authorization: `Bearer ${authStore.authToken}`,
                },
                params: params,
            })
            .then((res) => {
                console.log(res.data.data.courses);

                courses.value = res.data.data.courses;
                totalItems.value = res.data.data.total_courses;
                categoryTitle.value = res.data.data.courses[0]?.category || "";
            })
            .catch((error) => {
                console.error("Error fetching courses:", error);
            });
    } else {
        axios
            .get(`/course/list`, {
                headers: {
                    "Content-Type": "application/json",
                    Accept: "application/json",
                },
                params: params,
            })
            .then((res) => {
                console.log(res.data.data.courses);

                courses.value = res.data.data.courses;
                totalItems.value = res.data.data.total_courses;
                categoryTitle.value = res.data.data.courses[0]?.category || "";
            })
            .catch((error) => {
                console.error("Error fetching courses:", error);
            });
    }
}

const performSearch = () => {
    if (searchInputQuery.value) {
        router.push(`/courses?search=${searchInputQuery.value}`);
    }
};
</script>

<style lang="scss">
.filter-list {
    height: 110px;
    overflow-y: scroll;
}
</style>
