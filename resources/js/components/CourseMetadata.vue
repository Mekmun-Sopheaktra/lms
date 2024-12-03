<template>
    <div class="mb-4">
        <div class="d-flex justify-content-between">
            <span class="text-primary fw-bold">{{ course?.category }}</span>
            <div>
                <a href="" class="text-decoration-none text-dark me-4">
                    <i class="bi bi-share-fill fs-5"></i>
                </a>
                <a href="" class="text-decoration-none text-dark">
                    <i class="bi bi-heart fs-5"></i>
                </a>
            </div>
        </div>
        <h1 class="fs-2 fw-bold mt-1">{{ course?.title }}</h1>
        <i class="bi bi-star-fill text-warning me-2"></i>
        <strong class="me-2">{{ course?.average_rating }}</strong>
        <small class="text-muted">({{ course?.review_count }})</small>
        <span class="text-muted mx-1">
            <i class="bi bi-dot"></i>
        </span>
        <small class="text-muted">
            {{ course?.student_count }} Enrolled
        </small>
    </div>
    <span class="text-uppercase text-muted small">Instructor</span>
    <div class="mt-3 border-bottom pb-3">
        <router-link :to="'/instructor/' + course?.instructor?.id" class="d-flex text-decoration-none">
            <img :src="course?.instructor?.profile_picture" class="rounded-circle object-fit-cover me-3" height="55px"
                width="55px">
            <div>
                <strong class="d-block text-dark">{{ course?.instructor?.name }}</strong>
                <small class="text-muted">{{ course?.instructor?.title }}</small>
            </div>
        </router-link>
    </div>
</template>

<script setup>
import { defineProps } from 'vue';

const props = defineProps({
    course: Object
})
</script>
