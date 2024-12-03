<template>
    <section class="mb-5 p-3 rounded" style="background: #e2e8f0">
        <div class="accordion" id="contentAccordion">
            <div v-if="Array.isArray(chapters)">
                <div
                    v-for="(chapter, index) in (chapters || []).slice(
                        0,
                        chaptersToShow
                    )"
                    :key="index"
                    class="border border-2 bg-white rounded mb-2"
                    :class="{
                        'border-primary': activeIndex === index,
                        collapsed: activeIndex !== index,
                    }"
                >
                    <h2 class="m-0">
                        <button
                            class="accordion-button bg-white border rounded"
                            type="button"
                            :class="{ collapsed: index !== 0 }"
                            :data-bs-toggle="'collapse'"
                            :data-bs-target="'#chapter' + index"
                            aria-expanded="index === 0"
                            aria-controls="'chapter' + index"
                            @click="toggleAccordion(index)"
                        >
                            <div class="accordion-content w-100">
                                <div
                                    class="d-flex justify-content-between align-items-center mb-3"
                                >
                                    <small class="me-2 text-muted"
                                        >Class {{ index + 1 }}</small
                                    >
                                    <small
                                        class="me-2 text-muted chapter-duration"
                                    >
                                        {{ formatDuration(chapter?.duration) }}
                                    </small>
                                </div>
                                {{ chapter.title }}
                            </div>
                        </button>
                    </h2>
                    <div
                        :id="'chapter' + index"
                        class="accordion-collapse collapse my-1"
                        :class="{ show: index === 0 }"
                        data-bs-parent="#contentAccordion"
                    >
                        <div
                            class="accordion-body border-start border-end border-light p-0 mx-1"
                        >
                            <div
                                v-for="(
                                    content, contentIndex
                                ) in chapter.contents"
                                :key="content.id"
                            >
                                <!-- Content Link -->
                                <router-link
                                    v-if="
                                        course?.is_enrolled || content.is_free
                                    "
                                    :to="
                                        authStore.userData
                                            ? `/play/${courseId}?content_id=${content.id}`
                                            : ''
                                    "
                                    @click.prevent="handleWaring"
                                    @click="markContentComplete(content.id)"
                                    :class="{
                                        'd-block px-3 py-2 rounded-3 border-light text-decoration-none text-dark content-link': true,
                                        active:
                                            content.id ==
                                                route.query.content_id ||
                                            (route.path !==
                                                '/details/[course_id]' &&
                                                !route.query.content_id &&
                                                contentIndex === 0),
                                        completed: content.completed,
                                        view: content.is_viewed,
                                    }"
                                >
                                    <div class="d-flex align-items-center">
                                        <i
                                            v-if="
                                                content.type === 'video' &&
                                                content.media_id &&
                                                isPlayingVideo &&
                                                currentId == content.id
                                            "
                                            @click="togglePlay(content.id)"
                                            class="bi bi-pause-circle text-primary fs-5 me-3"
                                        ></i>
                                        <i
                                            v-if="
                                                content.type === 'video' &&
                                                content.media_id &&
                                                (!isPlayingVideo ||
                                                    currentId != content.id)
                                            "
                                            @click="togglePlay(content.id)"
                                            class="bi bi-play-fill text-primary fs-5 me-3"
                                        ></i>
                                        <i
                                            v-if="
                                                content.type === 'video' &&
                                                !content.media_id
                                            "
                                            class="bi bi-link-45deg text-primary fs-5 me-3"
                                        ></i>
                                        <i
                                            v-if="
                                                content.type === 'audio' &&
                                                isPlayingAudio &&
                                                currentId == content.id
                                            "
                                            @click="togglePlayAudio(content.id)"
                                            class="bi bi-mic-fill text-primary fs-5 me-3"
                                        ></i>
                                        <i
                                            v-if="
                                                content.type === 'audio' &&
                                                (!isPlayingAudio ||
                                                    currentId != content.id)
                                            "
                                            @click="togglePlayAudio(content.id)"
                                            class="bi bi-mic-mute text-primary fs-5 me-3"
                                        ></i>
                                        <i
                                            v-if="content.type === 'document'"
                                            class="bi bi-file-text-fill text-primary fs-5 me-3"
                                        ></i>
                                        <i
                                            v-if="content.type === 'image'"
                                            class="bi bi-file-image-fill text-primary fs-5 me-3"
                                        ></i>
                                        <span
                                            :class="
                                                content.is_viewed
                                                    ? 'text-dark'
                                                    : 'text-muted'
                                            "
                                            >{{ content.title }}</span
                                        >

                                        <div
                                            class="ms-auto d-flex justify-content-between align-items-center gap-3"
                                        >
                                            <small
                                                class="text-muted"
                                                style="font-size: 0.625em"
                                                >{{
                                                    formatDuration(
                                                        content.duration
                                                    )
                                                }}
                                            </small>
                                            <small
                                                class="text-muted"
                                                style="font-size: 0.625em"
                                                ><FontAwesomeIcon
                                                    :icon="
                                                        content.is_viewed
                                                            ? ''
                                                            : faCircle
                                                    "
                                                    :class="
                                                        content.is_viewed
                                                            ? ''
                                                            : 'text-primary'
                                                    "
                                            /></small>
                                        </div>
                                    </div>
                                </router-link>
                                <!-- Enroll Warning -->
                                <div
                                    v-else
                                    @click="enrollWarning"
                                    class="content d-block px-3 py-2 border-bottom border-light text-decoration-none text-dark"
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
                                            content.title
                                        }}</span>
                                        <small class="text-muted ms-auto"
                                            ><i class="bi bi-lock-fill"></i
                                        ></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mt-3" style="cursor: pointer">
            <a
                @click.prevent="showMoreChapters"
                :class="
                    chapters?.length === 0
                        ? 'text-danger text-decoration-none'
                        : 'text-decoration-none'
                "
            >
                {{
                    chapters?.length === 0
                        ? "No Content Available"
                        : chapters?.length > 4
                        ? "see more"
                        : ""
                }}
            </a>
        </div>
    </section>
</template>

<style scoped lang="scss">
.accordion-button {
    border: 2px solid transparent; /* Transparent border initially */
    transition: border-color 0.3s; /* Smooth transition for border color */
}

.accordion-button:not(.collapsed) {
    border-color: var(--bs-primary); /* Change to primary color when active */
}
.content {
    cursor: pointer;
}

.content-link.active {
    background-color: #f3e9fe;
}

// .content-link.completed {
//     background-color: #f3e9fe;
//     text-decoration: line-through;
// }

.content-link.view {
    color: #f3e9fe;
    text-decoration: line-through;
}

.progress-bar-container {
    background-color: #f5f5f5;
    border-radius: 5px;
    height: 10px;
    margin-bottom: 10px;
}

.progress-bar {
    background-color: #4caf50;
    height: 100%;
    border-radius: 5px;
}

.chapter-duration {
    position: absolute;
    right: 12px;
    top: 12px;
}

// .head-border {
//     border-top: 1px solid #9e4aed;
//     border-left: 1px solid #9e4aed;
//     border-right: 1px solid #9e4aed;
//     border-bottom: 0px solid #ffffff;
// }

// .collapsed {
//     border: 1px solid transparent !important;
// }
// .collapsing {
//     border-bottom: 1px solid #9e4aed;
//     border-left: 1px solid #9e4aed;
//     border-right: 1px solid #9e4aed;
//     border-top: 0px solid #ffffff;
// }

// .collapse.show {
//     border: 1px solid #9e4aed;
//     border-top: 1px solid transparent;
// }
</style>

<script setup>
import { defineProps, ref, computed, onMounted } from "vue";
import Swal from "sweetalert2";
import { useRoute } from "vue-router";
import { useAuthStore } from "@/stores/auth";
import axios from "axios";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import { faCircle } from "@fortawesome/free-solid-svg-icons";

const authStore = useAuthStore();
const route = useRoute();
let intialProgress = ref(0.0);
const activeIndex = ref(0);

let currentId = ref(route.params.content_id);
let chaptersToShow = ref(5);

let props = defineProps({
    chapters: {
        type: Array,
        default: () => [],
    },
    courseId: Number,
    isPlayingVideo: Boolean,
    isPlayingAudio: Boolean,
    course: Object,
});

// Method to mark a content as completed
const markContentComplete = (contentId) => {
    const content = findContentById(contentId);
    if (content) {
        content.is_viewed = true;
        saveProgress();
    }
};

// Helper function to find content by ID
function findContentById(contentId) {
    for (const chapter of props.chapters) {
        for (const content of chapter.contents) {
            if (content.id === contentId) return content;
        }
    }
    return null;
}

const calculateChapterProgress = (chapter) => {
    if (!Array.isArray(chapter.contents) || chapter.contents.length === 0)
        return 0;

    const completedContents = chapter.contents.filter(
        (content) => content.is_viewed === true
    ).length;
    return (completedContents / chapter.contents.length) * 100;
};

// Calculate overall course progress
const courseProgress = computed(() => {
    if (!Array.isArray(props.chapters) || props.chapters.length === 0) return 0;

    const totalProgress = props.chapters.reduce((acc, chapter) => {
        return acc + calculateChapterProgress(chapter);
    }, 0);

    // Calculate the average progress across all chapters and limit it to a maximum of 100%
    return Math.min(totalProgress / props.chapters.length, 100);
});

// Load existing progress from localStorage on mount
onMounted(() => {
    const savedProgress = localStorage.getItem(`progress_${props.courseId}`);
    if (savedProgress) {
        intialProgress.value = parseFloat(savedProgress);
    }
});

// Save progress to localStorage
const saveProgress = async () => {
    try {
        localStorage.setItem(
            `progress_${props.courseId}`,
            courseProgress.value.toFixed(2)
        );

        await axios.post(
            `/course/track/progress/${props.courseId}`,
            {
                user_id: authStore.userData.id,
                progress: courseProgress.value.toFixed(2),
            },
            {
                headers: {
                    "Content-Type": "application/json",
                    Accept: "application/json",
                    Authorization: `Bearer ${authStore.authToken}`,
                },
            }
        );
    } catch (error) {
        console.error("Error saving progress:", error);
    }
};

const showMoreChapters = () => {
    chaptersToShow.value += 1;
};

const emit = defineEmits([
    "playVideo",
    "pauseVideo",
    "pauseAudio",
    "playAudio",
]);

// Play/Pause Video
const togglePlay = (contentId) => {
    currentId.value = contentId;
    if (props.isPlayingVideo) {
        // Use props.isPlaying instead
        emit("pauseVideo", contentId);
    } else {
        emit("playVideo", contentId);
    }
};

const togglePlayAudio = (contentId) => {
    currentId.value = contentId;
    if (props.isPlayingAudio) {
        // Use props.isPlaying instead
        emit("pauseAudio", contentId);
    } else {
        emit("playAudio", contentId);
    }
};

// Utility functions this code must need latter
// function shortTitle(title) {
//     return title.length > 40 ? title.slice(0, 40) + "..." : title;
// }

function formatDuration(duration) {
    if (duration >= 60) {
        const hours = Math.floor(duration / 60);
        const minutes = duration % 60;
        return `${hours} hour${hours > 1 ? "s" : ""}${
            minutes > 0 ? ` ${minutes} min` : ""
        }`;
    }
    return `${duration} min`;
}

const handleWaring = () => {
    if (!authStore.userData) {
        Swal.fire({
            icon: "error",
            title: "Sorry...",
            text: "You need to log in to access this page.",
            confirmButtonText: "Go to Login",
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "/login";
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

// Method to toggle the accordion
const toggleAccordion = (index) => {
    activeIndex.value = activeIndex.value === index ? -1 : index;
};
</script>
