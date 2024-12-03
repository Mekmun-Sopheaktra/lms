<template>
    <swiper :modules="[Navigation, Pagination, Autoplay]" :slides-per-view="4.2" :space-between="20" navigation
        pagination autoplay loop>
        <swiper-slide v-for="(course, index) in courses" :key="index" class="mb-5 pb-3">
            <CourseCard :course="course" />
        </swiper-slide>
    </swiper>
</template>

<script setup>
import { Swiper, SwiperSlide } from "swiper/vue";
import { Navigation, Pagination, Autoplay } from "swiper/modules";
import { useAuthStore } from '@/stores/auth'
import { onMounted, ref } from "vue";
import CourseCard from "./CourseCard.vue";

const authStore = useAuthStore()

const courses = ref([]);

onMounted(() => {
    axios.get(`/course/list`, {
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'Authorization': 'Bearer ' + authStore.authToken
        },
        params: {
            items_per_page: 10,
            page_number: 1,
            sort: 'published_at',
            sortDirection: 'desc'
        }
    }).then((res) => {
        courses.value = res.data.data.courses
    })
})
</script>
