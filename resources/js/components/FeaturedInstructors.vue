<template>
    <swiper
        :modules="[Navigation, Pagination, Autoplay]"
        :slides-per-view="4"
        :space-between="20"
        navigation
        pagination
        autoplay
        loop
    >
        <swiper-slide
            v-for="(instructor, index) in instructors"
            :key="index"
            class="mb-5 pb-3"
        >
            <div class="instructor-card card border rounded-4 py-4">
                <div class="card-body text-center p-0">
                    <router-link
                        :to="'/instructor/' + instructor.id"
                        class="text-decoration-none text-dark"
                    >
                        <div class="text-center pb-3">
                            <div class="position-relative">
                                <img
                                    class="rounded-circle object-fit-cover mb-3 position-relative"
                                    :src="instructor.profile_picture"
                                    height="125px"
                                    width="125px"
                                    alt="Instructor"
                                />
                                <span
                                    class="instructor-badge position-absolute top-75 badge rounded-circle bg-white text-warning theme-shadow p-2"
                                    ><i class="bi bi-star-fill fs-4"></i
                                ></span>
                            </div>
                            <h2 class="fs-6 fw-bold mb-1">
                                {{ instructor.name }}
                            </h2>
                            <small
                                class="height-meature d-flex justify-content-center align-items-center text-muted px-2"
                                >{{ instructor.title }}</small
                            >
                        </div>

                        <div class="d-flex bg-light mb-3 py-2">
                            <div class="col text-end border-end pe-3">
                                <small class="d-inline d-md-block d-lg-inline">
                                    {{ instructor.course_count }} Courses
                                </small>
                            </div>
                            <div class="col text-start ps-3">
                                <small>
                                    {{ instructor.student_count }} Enrolled
                                </small>
                            </div>
                        </div>

                        <span>
                            View Profile<i class="bi bi-chevron-right"></i>
                        </span>
                    </router-link>
                </div>
            </div>
        </swiper-slide>
    </swiper>
</template>

<style lang="scss" scoped>
.height-meature {
    width: 100%;
    height: 60px;
}

.instructor-card {
    transition: all 0.2s ease-out;

    &:hover {
        box-shadow: 0px 16px 64px 0px #0000000d;
    }

    .instructor-badge {
        left: 60%;
        bottom: 20px;
    }
}
</style>

<script setup>
import { ref, onMounted } from "vue";
import { Swiper, SwiperSlide } from "swiper/vue";
import { Navigation, Pagination, Autoplay } from "swiper/modules";

const instructors = ref([]);

const fetchInstructors = async () => {
    try {
        const response = await axios.get(`/instructor/list`, {
            headers: {
                "Content-Type": "application/json",
                Accept: "application/json",
            },
            params: {
                items_per_page: 15,
                page_number: 1,
                // is_featured: true
            },
        });
        instructors.value = response.data.data.instructors;
    } catch (error) {
        console.error("Error fetching featured instructors:", error);
    }
};

onMounted(() => {
    fetchInstructors();
});
</script>
