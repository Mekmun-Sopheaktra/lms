<template>
    <Hero />
    <section class="pb-5">
        <div class="container py-5">
            <About />
        </div>
    </section>

    <section class="py-5 bg-light">
        <div class="container py-5">
            <h3 class="fw-bold text-center fs-2 mb-4">
                Explore Our Popular Courses
            </h3>
            <PopularCourses />
        </div>
    </section>

    <section class="py-5 border-bottom">
        <div class="container py-5">
            <FeaturedCategories />
        </div>
    </section>

    <section class="py-5 border-bottom">
        <div class="container py-5">
            <div class="d-flex justify-content-between align-items-center mb-5">
                <div>
                    <h3 class="fw-bold fs-2">Newest Courses</h3>
                    <p>Recently published courses</p>
                </div>
                <router-link
                    to="/courses"
                    class="text-primary text-decoration-none fw-bold"
                    >View All <font-awesome-icon :icon="faArrowRightLong"
                /></router-link>
            </div>
            <LatestCourseSlider />
        </div>
    </section>

    <section class="py-5">
        <div class="container py-5">
            <h3 class="fw-bold text-center fs-2 mb-5">Top Rated Instructors</h3>
            <FeaturedInstructors />
        </div>
    </section>

    <section class="py-5 bg-light-purple border-top border-bottom">
        <div class="container py-5">
            <h3 class="fw-bold text-center fs-2 mb-5">
                Hear from Our Students and Instructors
            </h3>
            <Testimonials />
        </div>
    </section>

    <section class="py-5">
        <div class="container py-5">
            <FAQ />
        </div>
    </section>

    <section class="py-5">
        <div class="container py-5">
            <BecomeInstructor />
        </div>
    </section>

    <section class="pt-5">
        <div class="container">
            <Newsletter />
        </div>
    </section>
</template>

<script setup>
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import { faArrowRightLong } from "@fortawesome/free-solid-svg-icons";
import Hero from "../components/Hero.vue";
import About from "../components/About.vue";
import FeaturedCategories from "../components/FeaturedCategories.vue";
import FeaturedInstructors from "../components/FeaturedInstructors.vue";
import FAQ from "../components/FAQ.vue";
import Testimonials from "../components/Testimonials.vue";
import BecomeInstructor from "../components/BecomeInstructor.vue";
import Newsletter from "../components/Newsletter.vue";
import PopularCourses from "../components/PopularCourses.vue";
import LatestCourseSlider from "../components/LatestCourseSlider.vue";
</script>
