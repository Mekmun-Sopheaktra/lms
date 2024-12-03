<template>
    <footer
        :class="{ 'homepage-footer': $route.path === '/' }"
        class="container-fluid text-white"
    >
        <section class="container footer-container py-5">
            <div class="row">
                <div class="col-md-8 col-lg-4 mb-5 mb-lg-0">
                    <img
                        :src="masterStore?.masterData?.footer"
                        class="mb-3"
                        width="150px"
                        height="30px"
                    />
                    <p class="small text-light col-xl-8">
                        {{ masterStore?.masterData?.footer_description }}
                    </p>
                    <ul class="list-unstyled">
                        <li class="mb-3">
                            <a
                                href="tel:+8801963953998"
                                class="text-decoration-none"
                            >
                                <i class="bi bi-telephone me-3"></i>
                                +8801963953998
                            </a>
                        </li>
                        <li class="mb-3">
                            <a
                                :href="
                                    masterStore?.masterData?.footer_email
                                        ? `mailto:${masterStore?.masterData?.footer_email}`
                                        : ''
                                "
                                class="text-decoration-none"
                            >
                                <i class="bi bi-envelope me-3"></i>
                                {{ masterStore?.masterData?.footer_email }}
                            </a>
                        </li>
                    </ul>

                    <div class="d-flex mt-3 align-items-center gap-3">
                        <div
                            v-for="social in masterStore?.masterData
                                ?.footer_social_icons"
                            :key="social.name"
                        >
                            <a :href="social?.link" target="_blank"
                                ><i :class="social?.icon"></i
                            ></a>
                        </div>
                    </div>
                    <!-- <a href="" class="me-3"><i class="bi bi-facebook"></i></a>
                    <a href="" class="me-3"><i class="bi bi-twitter"></i></a>
                    <a href="" class="me-3"><i class="bi bi-instagram"></i></a> -->
                </div>
                <div class="col-md-4 col-lg-2 mb-5 mb-lg-0">
                    <h4 class="text-primary fs-6 fw-bold mb-3">Useful Links</h4>
                    <ul class="list-unstyled">
                        <li class="mb-3">
                            <router-link
                                to="/courses"
                                class="text-decoration-none"
                                >All Courses</router-link
                            >
                        </li>
                        <li class="mb-3">
                            <router-link
                                to="/page/about_us"
                                class="text-decoration-none"
                                >About Us</router-link
                            >
                        </li>
                        <li class="mb-3">
                            <router-link to="/faq" class="text-decoration-none"
                                >FAQ</router-link
                            >
                        </li>
                        <li class="mb-3">
                            <router-link
                                to="/register"
                                class="text-decoration-none"
                                >Become a Teacher</router-link
                            >
                        </li>
                    </ul>
                </div>
                <div class="col-md-4 col-lg-3 mb-5 mb-lg-0">
                    <h4 class="text-primary fs-6 fw-bold mb-3">
                        Help & Support
                    </h4>
                    <ul class="list-unstyled">
                        <li class="mb-3">
                            <router-link
                                to="/contact-us"
                                class="text-decoration-none"
                                >Contact Us</router-link
                            >
                        </li>
                        <li class="mb-3">
                            <router-link
                                to="/page/terms_and_conditions"
                                class="text-decoration-none"
                                >Terms & Conditions</router-link
                            >
                        </li>
                        <li class="mb-3">
                            <router-link
                                to="/page/privacy_policy"
                                class="text-decoration-none"
                                >Privacy Policy</router-link
                            >
                        </li>
                        <li class="mb-3">
                            <router-link
                                to="/admin/login"
                                target="_blank"
                                class="text-decoration-none"
                            >
                                Login to Admin
                            </router-link>
                        </li>
                    </ul>
                </div>

            </div>
        </section>
        <div class="text-center text-light py-4">
            <small>{{ masterStore?.masterData?.credit_text }}</small>
        </div>
    </footer>
</template>

<style lang="scss" scoped>
footer {
    background-color: #0f172a;

    .footer-container {
        border-bottom: 2px solid #1c2a47;
    }

    a {
        color: #fff;
        transition: color 0.2s ease-out;

        &:hover {
            color: #9e4aed;
        }
    }
}

.homepage-footer {
    clip-path: ellipse(90% 88% at 50% 100%);
    margin-top: -11rem;
    padding-top: 12rem;
}
</style>

<script setup>
import { useMasterStore } from "@/stores/master";
import { ref } from "vue";

const masterStore = useMasterStore();
const masterData = ref(masterStore.masterData);

console.log(masterData.value);

const baseUrl = import.meta.env.VITE_APP_URL;
</script>
