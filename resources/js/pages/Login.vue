<template>
    <section
        class="bg-light vh-100 d-flex align-items-center justify-content-center"
    >
        <section class="login-wizard bg-white col-8 theme-shadow">
            <div class="row">
                <div class="col-6 px-5 py-4">
                    <div class="text-center">
                        <router-link to="/" class="mb-4"
                            ><img
                                :src="'/assets/images/logo-new.png'"
                                class="object-fit-cover"
                                alt="Login"
                                height="50px"
                        /></router-link>
                    </div>
                    <div class="d-flex h-100">
                        <div class="my-auto w-100">
                            <h3 class="fw-bold mb-3">Login</h3>
                            <span class="text-muted"
                                >Boost your skill always and forever.</span
                            >

                            <form class="my-4" @submit.prevent="loginUser">
                                <div class="mb-4">
                                    <input
                                        type="email"
                                        v-model="email"
                                        class="form-control"
                                        placeholder="Email or Phone"
                                    />
                                    <p
                                        v-if="errors.email"
                                        class="text-danger fw-bold mt-2"
                                    >
                                        {{ errors.email[0] }}
                                    </p>
                                </div>
                                <div class="mb-3">
                                    <input
                                        type="password"
                                        v-model="password"
                                        class="form-control"
                                        placeholder="Password"
                                    />
                                    <p
                                        v-if="errors.password"
                                        class="text-danger fw-bold mt-2"
                                    >
                                        {{ errors.password[0] }}
                                    </p>
                                </div>
                                <router-link
                                    to="/reset_password"
                                    class="small d-block text-decoration-none mb-4"
                                    >Forgot your password?</router-link
                                >
                                <button
                                    type="submit"
                                    class="btn btn-primary w-100 rounded-pill"
                                >
                                    {{ loginBtnText }}
                                </button>
                            </form>

                            <span
                                >Don't have an account?
                                <router-link to="/register"
                                    >Sign Up</router-link
                                ></span
                            >
                            <!-- <div class="mt-5 border-top py-5">
                                <span>Are you a Teacher?</span>
                                <button class="btn btn-outline-primary text-dark rounded-pill py-2 px-3 ms-3">Join as a
                                    Teacher</button>
                            </div> -->
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <img
                        :src="'/assets/images/website/image.png'"
                        class="side-image object-fit-cover w-100"
                    />
                </div>
            </div>
        </section>
    </section>
</template>

<style lang="scss" scoped>
.login-wizard {
    border-radius: 2rem;

    .side-image {
        border-top-right-radius: 2rem;
        border-bottom-right-radius: 2rem;
    }
}
</style>

<script setup>
import axios from "axios";
import Swal from "sweetalert2";
import { ref, watch } from "vue";
import { useRouter } from "vue-router";
import { useAuthStore } from "@/stores/auth";

let errors = ref("");

const router = useRouter();
const authStore = useAuthStore();

const email = ref("");
const password = ref("");
const loginBtnText = ref("Sign in");

// Function to handle login
const loginUser = async () => {
    try {
        loginBtnText.value = "Signing in...";
        const response = await axios.post(`/login`, {
            email: email.value,
            password: password.value,
        });

        // Store user data and auth token in state
        authStore.setAuthData(
            response.data.data.token,
            response.data.data.user
        );

        Swal.fire({
            icon: "success",
            title: "Success",
            text: "Login successful",
            showConfirmButton: false,
            timer: 1500,
        });

        // Redirect to dashboard or other page
        router.push("/");
    } catch (error) {
        if (error?.response?.data.errors) {
            errors.value = error?.response?.data.errors;
        } else {
            errors.value = error?.response?.data.message;
        }

        loginBtnText.value = "Sign in";

        if (error?.response?.status === 403) {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text:
                    error.response?.data?.message ||
                    "Login failed. Please try again.",
            });
        }
    }
};
</script>
