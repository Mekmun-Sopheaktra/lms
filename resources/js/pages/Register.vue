<template>
    <section
        v-if="!loadder"
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
                            <h3 class="fw-bold mb-3">Sign up</h3>
                            <span class="text-muted"
                                >Boost your skill always and forever.</span
                            >

                            <form class="my-4" @submit.prevent="registerUser">
                                <div class="mb-4">
                                    <input
                                        type="text"
                                        v-model="name"
                                        :class="
                                            errors?.name
                                                ? 'is-invalid form-control'
                                                : 'form-control'
                                        "
                                        class="form-control"
                                        placeholder="Full Name"
                                    />
                                    <p
                                        v-if="errors?.name"
                                        class="my-2 text-danger"
                                    >
                                        {{ errors?.name[0] }}
                                    </p>
                                </div>

                                <div class="mb-4">
                                    <input
                                        type="tel"
                                        v-model="phone"
                                        :class="
                                            errors?.phone
                                                ? 'is-invalid form-control'
                                                : 'form-control'
                                        "
                                        placeholder="Phone Number"
                                    />
                                    <p
                                        v-if="errors?.phone"
                                        class="my-2 text-danger"
                                    >
                                        {{ errors?.phone[0] }}
                                    </p>
                                </div>

                                <div class="mb-4">
                                    <input
                                        type="email"
                                        v-model="email"
                                        :class="
                                            errors?.email
                                                ? 'is-invalid form-control'
                                                : 'form-control'
                                        "
                                        placeholder="Email"
                                    />
                                    <p
                                        v-if="errors?.email"
                                        class="my-2 text-danger"
                                    >
                                        {{ errors?.email[0] }}
                                    </p>
                                </div>

                                <div class="mb-4">
                                    <input
                                        type="password"
                                        v-model="password"
                                        :class="
                                            errors?.password
                                                ? 'is-invalid form-control'
                                                : 'form-control'
                                        "
                                        placeholder="Create Password"
                                    />
                                    <p
                                        v-if="errors?.password"
                                        class="my-2 text-danger"
                                    >
                                        {{ errors?.password[0] }}
                                    </p>
                                </div>

                                <div class="mb-3">
                                    <input
                                        type="password"
                                        v-model="passwordConfirm"
                                        class="form-control"
                                        placeholder="Confirm Password"
                                    />
                                </div>

                                <div class="my-4 form-check">
                                    <input
                                        type="checkbox"
                                        class="form-check-input"
                                        id="exampleCheck1"
                                        required
                                    />
                                    <label
                                        class="form-check-label"
                                        for="exampleCheck1"
                                    >
                                        I accept and agree to the
                                        <router-link
                                            to="/page/terms_and_conditions"
                                            class="text-decoration-none"
                                            >Terms & Condition</router-link
                                        >
                                        and
                                        <router-link
                                            to="/page/privacy_policy"
                                            class="text-decoration-none"
                                            >Privacy Policy</router-link
                                        >
                                        of ReadyLMS
                                    </label>
                                </div>

                                <button
                                    type="submit"
                                    class="btn btn-primary w-100 rounded-pill"
                                >
                                    {{ signUpBtnText }}
                                </button>
                            </form>

                            <span
                                >Already have an account?
                                <router-link to="/login"
                                    >Log in</router-link
                                ></span
                            >
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

    <div class="loading" v-else>
        <svg class="pl" width="240" height="240" viewBox="0 0 240 240">
            <circle
                class="pl__ring pl__ring--a"
                cx="120"
                cy="120"
                r="105"
                fill="none"
                stroke="#000"
                stroke-width="20"
                stroke-dasharray="0 660"
                stroke-dashoffset="-330"
                stroke-linecap="round"
            ></circle>
            <circle
                class="pl__ring pl__ring--b"
                cx="120"
                cy="120"
                r="35"
                fill="none"
                stroke="#000"
                stroke-width="20"
                stroke-dasharray="0 220"
                stroke-dashoffset="-110"
                stroke-linecap="round"
            ></circle>
            <circle
                class="pl__ring pl__ring--c"
                cx="85"
                cy="120"
                r="70"
                fill="none"
                stroke="#000"
                stroke-width="20"
                stroke-dasharray="0 440"
                stroke-linecap="round"
            ></circle>
            <circle
                class="pl__ring pl__ring--d"
                cx="155"
                cy="120"
                r="70"
                fill="none"
                stroke="#000"
                stroke-width="20"
                stroke-dasharray="0 440"
                stroke-linecap="round"
            ></circle>
        </svg>
    </div>
</template>

<style lang="scss" scoped>
.login-wizard {
    border-radius: 2rem;

    .side-image {
        border-top-right-radius: 2rem;
        border-bottom-right-radius: 2rem;
    }
}

.loading {
    height: 100vh;
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: hsl(220deg 29% 90% / 50%);
}
.pl {
    width: 6em;
    height: 6em;
}

.pl__ring {
    animation: ringA 2s linear infinite;
}

.pl__ring--a {
    stroke: #f42f25;
}

.pl__ring--b {
    animation-name: ringB;
    stroke: #f49725;
}

.pl__ring--c {
    animation-name: ringC;
    stroke: #255ff4;
}

.pl__ring--d {
    animation-name: ringD;
    stroke: #f42582;
}

/* Animations */
@keyframes ringA {
    from,
    4% {
        stroke-dasharray: 0 660;
        stroke-width: 20;
        stroke-dashoffset: -330;
    }

    12% {
        stroke-dasharray: 60 600;
        stroke-width: 30;
        stroke-dashoffset: -335;
    }

    32% {
        stroke-dasharray: 60 600;
        stroke-width: 30;
        stroke-dashoffset: -595;
    }

    40%,
    54% {
        stroke-dasharray: 0 660;
        stroke-width: 20;
        stroke-dashoffset: -660;
    }

    62% {
        stroke-dasharray: 60 600;
        stroke-width: 30;
        stroke-dashoffset: -665;
    }

    82% {
        stroke-dasharray: 60 600;
        stroke-width: 30;
        stroke-dashoffset: -925;
    }

    90%,
    to {
        stroke-dasharray: 0 660;
        stroke-width: 20;
        stroke-dashoffset: -990;
    }
}

@keyframes ringB {
    from,
    12% {
        stroke-dasharray: 0 220;
        stroke-width: 20;
        stroke-dashoffset: -110;
    }

    20% {
        stroke-dasharray: 20 200;
        stroke-width: 30;
        stroke-dashoffset: -115;
    }

    40% {
        stroke-dasharray: 20 200;
        stroke-width: 30;
        stroke-dashoffset: -195;
    }

    48%,
    62% {
        stroke-dasharray: 0 220;
        stroke-width: 20;
        stroke-dashoffset: -220;
    }

    70% {
        stroke-dasharray: 20 200;
        stroke-width: 30;
        stroke-dashoffset: -225;
    }

    90% {
        stroke-dasharray: 20 200;
        stroke-width: 30;
        stroke-dashoffset: -305;
    }

    98%,
    to {
        stroke-dasharray: 0 220;
        stroke-width: 20;
        stroke-dashoffset: -330;
    }
}

@keyframes ringC {
    from {
        stroke-dasharray: 0 440;
        stroke-width: 20;
        stroke-dashoffset: 0;
    }

    8% {
        stroke-dasharray: 40 400;
        stroke-width: 30;
        stroke-dashoffset: -5;
    }

    28% {
        stroke-dasharray: 40 400;
        stroke-width: 30;
        stroke-dashoffset: -175;
    }

    36%,
    58% {
        stroke-dasharray: 0 440;
        stroke-width: 20;
        stroke-dashoffset: -220;
    }

    66% {
        stroke-dasharray: 40 400;
        stroke-width: 30;
        stroke-dashoffset: -225;
    }

    86% {
        stroke-dasharray: 40 400;
        stroke-width: 30;
        stroke-dashoffset: -395;
    }

    94%,
    to {
        stroke-dasharray: 0 440;
        stroke-width: 20;
        stroke-dashoffset: -440;
    }
}

@keyframes ringD {
    from,
    8% {
        stroke-dasharray: 0 440;
        stroke-width: 20;
        stroke-dashoffset: 0;
    }

    16% {
        stroke-dasharray: 40 400;
        stroke-width: 30;
        stroke-dashoffset: -5;
    }

    36% {
        stroke-dasharray: 40 400;
        stroke-width: 30;
        stroke-dashoffset: -175;
    }

    44%,
    50% {
        stroke-dasharray: 0 440;
        stroke-width: 20;
        stroke-dashoffset: -220;
    }

    58% {
        stroke-dasharray: 40 400;
        stroke-width: 30;
        stroke-dashoffset: -225;
    }

    78% {
        stroke-dasharray: 40 400;
        stroke-width: 30;
        stroke-dashoffset: -395;
    }

    86%,
    to {
        stroke-dasharray: 0 440;
        stroke-width: 20;
        stroke-dashoffset: -440;
    }
}
</style>

<script setup>
import { ref, watch } from "vue";
import { useRouter } from "vue-router";
import axios from "axios";
import Swal from "sweetalert2";
import { useAuthStore } from "@/stores/auth";

const router = useRouter();
const authStore = useAuthStore();

const name = ref("");
const phone = ref("");
const email = ref("");
const password = ref("");
const passwordConfirm = ref("");

// Watchers to clear errors when user inputs data
watch(name, (newValue) => {
    errors.value.name = newValue ? "" : errors.value.name; // Only clear if there's a value
});
watch(phone, (newValue) => {
    errors.value.phone = newValue ? "" : errors.value.phone;
});
watch(email, (newValue) => {
    errors.value.email = newValue ? "" : errors.value.email;
});
watch(password, (newValue) => {
    errors.value.password = newValue ? "" : errors.value.password;
});
watch(passwordConfirm, (newValue) => {
    errors.value.password_confirmation = newValue
        ? ""
        : errors.value.password_confirmation;
});

// for errors
let errors = ref();

const signUpBtnText = ref("Sign up");
const loadder = ref(false);

// Function to handle user registration
const registerUser = async () => {
    try {
        loadder.value = true;
        signUpBtnText.value = "Signing up...";
        const response = await axios.post(`/register`, {
            name: name.value,
            phone: phone.value,
            email: email.value,
            password: password.value,
            password_confirmation: passwordConfirm.value,
        });
        // Store user data and auth token in Pinia store
        authStore.setAuthData(
            response.data.data.token,
            response.data.data.user
        );
        Swal.fire({
            icon: "success",
            title: "Success",
            text: "Registration successful",
            showConfirmButton: false,
            timer: 1500,
        });

        // Redirect user after successful registration
        router.push("/");
    } catch (error) {
        loadder.value = false;
        signUpBtnText.value = "Sign up";
        errors.value = error.response?.data?.errors;
    }
};
</script>
