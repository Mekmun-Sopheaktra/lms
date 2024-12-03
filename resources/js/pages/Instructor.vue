<template>
    <section class="bg-light py-4">
        <section class="container">
            <div class="row">
                <div class="col-4">
                    <InstructorAbout :instructor="instructor" />
                </div>
                <div class="col-8">
                    <div class="bg-white rounded-3 p-3">
                        <strong class="d-block mb-3"
                            >About the Instructor</strong
                        >
                        <p class="mb-4">{{ instructor.about }}</p>
                        <div class="d-flex justify-content-between mb-3">
                            <div>
                                <strong class="d-block">Courses</strong>
                                <small>Showing 8 of 8 courses</small>
                            </div>
                            <div class="dropdown">
                                <button
                                    class="btn px-3 py-2 border"
                                    type="button"
                                    data-bs-toggle="dropdown"
                                    aria-expanded="false"
                                >
                                    Sort by: {{ currentSort }}
                                    <i class="bi bi-chevron-down"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a
                                            class="dropdown-item"
                                            @click.prevent="
                                                sortCourses('high-to-low')
                                            "
                                            >Course Fee: High to Low</a
                                        >
                                    </li>
                                    <li>
                                        <a
                                            class="dropdown-item"
                                            @click.prevent="
                                                sortCourses('low-to-high')
                                            "
                                            >Course Fee: Low to High</a
                                        >
                                    </li>
                                    <li>
                                        <a
                                            class="dropdown-item"
                                            @click.prevent="
                                                sortCourses('popular')
                                            "
                                            >Popular Courses</a
                                        >
                                    </li>
                                    <li>
                                        <a
                                            class="dropdown-item"
                                            @click.prevent="
                                                sortCourses('newest')
                                            "
                                            >New Courses</a
                                        >
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="instructor-courses row row-cols-3">
                            <div
                                v-for="course in sortedCourses"
                                :key="course.id"
                                class="mb-4"
                            >
                                <CourseCard :course="course" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>
</template>

<style lang="scss">
.instructor-courses {
    max-height: 550px;
    overflow-y: auto;
}
</style>

<script setup>
import { ref, computed } from "vue";
import InstructorAbout from "../components/InstructorAbout.vue";
import CourseCard from "../components/CourseCard.vue";
import { useRoute } from "vue-router";

const route = useRoute();
let instructor = ref({});
let courses = ref({});
let sortedCourses = ref([]);
const currentSort = ref("Default");

// Fetch instructor profile
axios
    .get(`/instructor/show/${route.params.id}`, {
        headers: {
            "Content-Type": "application/json",
            Accept: "application/json",
        },
    })
    .then((response) => {
        instructor.value = response.data.data.instructor;
        courses.value = response.data.data.courses;
        sortedCourses.value = [...courses.value];
    })
    .catch((error) => {
        console.error(error);
    });

const sortCourses = (criteria) => {
    if (criteria === "high-to-low") {
        sortedCourses.value = [...courses.value].sort(
            (a, b) => b.price - a.price
        );
        currentSort.value = "Course Fee: High to Low";
    } else if (criteria === "low-to-high") {
        sortedCourses.value = [...courses.value].sort(
            (a, b) => a.price - b.price
        );
        currentSort.value = "Course Fee: Low to High";
    } else if (criteria === "popular") {
        // Implement your logic for sorting by popularity
        sortedCourses.value = [...courses.value].sort(
            (a, b) => b.view_count - a.view_count
        );
        currentSort.value = "Popular Courses";
    } else if (criteria === "newest") {
        // Sort by created_at in descending order (newest first)
        sortedCourses.value = [...courses.value].sort(
            (a, b) => new Date(b.published_at) - new Date(a.published_at)
        );
        currentSort.value = "Newest Courses";
    }
};
</script>
