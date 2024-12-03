<template>
   <div class="page-container">
     <Header />
        <main class="content">
            <section class="bg-light py-5 d-flex justify-content-center align-items-center">
                <section class="container text-center py-5">
                    <div v-if="status === 'success'">
                        <i class="ri-checkbox-circle-fill text-success display-1"></i>
                        <h3>Congratulations! You have successfully enrolled.</h3>
                        <p class="my-3 col-lg-7 mx-auto">Congratulations! You have successfully enrolled in the course. Begin
                            your
                            learning
                            journey with our courses. Watch the video lessons, complete the assignments and take the quizzes to
                            master the skills.</p>
                        <router-link :to="'/play/' + courseId" class="btn btn-primary mt-3">Go to
                            Course</router-link>
                    </div>
                    <div v-else-if="status === 'failed'">
                        <i class="ri-close-circle-fill text-danger display-1"></i>
                        <h3>Oops! Something went wrong. Please try again.</h3>
                    </div>
                    <div v-else-if="status === 'cancel'">
                        <i class="ri-close-circle-fill text-danger display-1"></i>
                        <h3>Oops! You have cancelled the enrollment.</h3>
                    </div>
                    <div v-else>
                        <i class="ri-error-warning-fill text-danger display-1"></i>
                        <h3>Oops! Something went wrong. Please try again.</h3>
                    </div>
                </section>
            </section>
        </main>
   </div>
</template>

<script setup>
import { ref } from 'vue';
import { useRoute } from 'vue-router';
import { onMounted } from 'vue';
import Header from '../components/Header.vue';

const route = useRoute();
const status = ref(route.query.status);
const courseId = ref(route.query.course_id);
const windowClosed = ref(route.query.window_closed);

console.log(status.value);



onMounted(() => {
    localStorage.setItem('paymentStatus', status.value);

    if (windowClosed.value != 'true') {
        window.close();
    } else {
        localStorage.setItem('paymentStatus', null);
    }
})
</script>

<style scoped>
.page-container {
    display: flex;
    flex-direction: column;
    height: 850px; /* Ensure full viewport height */
}

.content {
    flex: 1; /* Allows content to take available space */
    display: flex;
    justify-content: center;
    align-items: center;
}
</style>
