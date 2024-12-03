<template>
    <section class="mb-5">
        <div class="accordion" id="contentAccordion">
            <div
                v-for="(chapter, index) in freeChapters"
                class="accordion-item rounded-3 border-0 mb-2"
                :key="index"
            >
                <h2 class="accordion-header">
                    <button
                        class="accordion-button bg-white rounded-3"
                        type="button"
                        :class="{ collapsed: index !== 0 }"
                        :data-bs-toggle="'collapse'"
                        :data-bs-target="'#chapter' + index"
                        aria-expanded="index === 0"
                        aria-controls="'chapter' + index"
                    >
                        <div class="accordion-content w-100">
                            <div
                                class="d-flex justify-content-between align-items-center mb-3"
                            >
                                <small class="me-2 text-muted"
                                    >Class {{ index + 1 }}</small
                                >
                                <small class="me-2 text-muted chapter-duration"
                                    >{{ formatDuration(chapter.duration) }}</small
                                >
                            </div>
                            {{ shortTitle(chapter.title) }}
                        </div>
                    </button>
                </h2>
                <div
                    :id="'chapter' + index"
                    class="accordion-collapse collapse"
                    :class="{ show: index === 0 }"
                    data-bs-parent="#contentAccordion"
                >
                    <div
                        class="accordion-body border-start border-end border-light p-0"
                    >
                        <div
                            v-for="(content, contentIndex) in chapter.contents"
                            :key="content.id"
                        >
                            <!-- authStore.userData -->
                            <router-link
                                v-if="content.is_free"
                                :to="
                                    authStore.userData
                                        ? `/play/${courseId}?content_id=${content.id}`
                                        : ''
                                "
                                @click.prevent="handleWaring"
                                :class="
                                    'd-block px-3 py-2 border-bottom border-light text-decoration-none text-dark content-link' +
                                    (content.id == route.query.content_id ||
                                    (!route.path === '/details/[course_id]' &&
                                        !route.query.content_id &&
                                        contentIndex == 0)
                                        ? ' active'
                                        : '')
                                "
                            >
                                <div class="d-flex align-items-center">
                                    <i
                                        v-if="content.type === 'video'"
                                        class="bi bi-play-fill text-danger fs-5 me-3"
                                    ></i>
                                    <i
                                        v-if="content.type === 'audio'"
                                        class="bi bi-mic-mute text-success fs-5 me-3"
                                    ></i>
                                    <i
                                        v-if="content.type === 'document'"
                                        class="bi bi-file-text-fill text-info fs-5 me-3"
                                    ></i>
                                    <i
                                        v-if="content.type === 'image'"
                                        class="bi bi-file-image-fill text-warning fs-5 me-3"
                                    ></i>
                                    <span class="text-muted">{{
                                        shortTitle(content.title)
                                    }}</span>
                                    <small class="text-muted ms-auto"
                                        >{{
                                           formatDuration(content.duration)
                                        }}
                                        </small
                                    >
                                </div>
                            </router-link>
                        </div>
                        <!-- here something do -->
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mt-3" v-if="freeChapters.length > 0">
            <a href="" class="text-decoration-none">See More</a>
        </div>
        <div class="text-center mt-3" v-else>
            <a
                href="javascript::void(0)"
                class="text-decoration-none text-danger"
                >No Free Content Available Right Now!</a
            >
        </div>
    </section>
</template>

<style scoped lang="scss">
.content {
    cursor: pointer;
}

.content-link.active {
    background-color: #0e7f9e28;
}

.chapter-duration {
    position: absolute;
    right: 12px;
    top: 12px;
}
</style>

<script setup>
import { defineProps, computed } from "vue";
import Swal from "sweetalert2";
import { useRoute } from "vue-router";
import { useAuthStore } from "@/stores/auth";
const authStore = useAuthStore();

const route = useRoute();

let props = defineProps({
    chapters: Object,
    courseId: Number,
});

const freeChapters = computed(() => {
    if (!Array.isArray(props.chapters)) {
        return []; // Return empty array if chapters is not an array
    }
    return props.chapters.filter(
        (chapter) =>
            Array.isArray(chapter.contents) &&
            chapter.contents.some((content) => content.is_free)
    );
});

function shortTitle(title) {
    return title.length > 40 ? title.slice(0, 40) + "..." : title;
}

let handleWaring = () => {
    if (!authStore.userData) {
        Swal.fire({
            icon: "error",
            title: "Sorry...",
            text: "You need to log in to access this page.",
            confirmButtonText: "Go to Login",
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirect to the login page when the user clicks the button
                window.location.href = "/login"; // Replace "/login" with your actual login URL
            }
        });
    }
};

function enrollWarning() {
    Swal.fire({
        icon: "warning",
        title: "Enroll Required",
        text: "You need to enroll the course to view the content",
        showConfirmButton: true,
    });
}


// works on time formating

const formatDuration = (duration) => {
    if (duration >= 60) {
        const hours = Math.floor(duration / 60);
        const minutes = duration % 60;
        return `${hours} hour${hours > 1 ? 's' : ''}${minutes > 0 ? ` ${minutes} min` : ''}`;
    }
    return `${duration} min`;
}

</script>
