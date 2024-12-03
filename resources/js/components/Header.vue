<template>
    <header
        class="navbar navbar-expand-xl py-3"
        :class="[{ 'hero-header': $route.path === '/' }]"
    >
        <section class="container">
            <router-link to="/" class="navbar-brand">
                <img
                    :src="masterStore?.masterData?.logo"
                    height="50px"
                    class="object-fit-cover"
                    alt="ReadyLMS"
                />
            </router-link>
            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent"
                aria-expanded="false"
                aria-label="Toggle navigation"
            >
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <div class="category-dropdown dropdown">
                    <button
                        class="btn category-dropdown-btn mt-3 mx-3 px-3"
                        type="button"
                        data-bs-toggle="dropdown"
                        aria-expanded="false"
                    >
                        <img
                            :src="'/assets/images/website/category.svg'"
                            class="me-2"
                        />
                        Category<i class="ri ri-arrow-down-s-line ms-4"></i>
                    </button>
                    <ul
                        class="category-menu dropdown-menu border-0 theme-shadow p-3"
                    >
                        <li
                            v-for="category in categories"
                            :key="category.id"
                            class="category-menu-item border-bottom"
                        >
                            <router-link
                                :to="'/courses?category_id=' + category.id"
                                class="dropdown-item"
                                href="#"
                            >
                                <div class="d-flex align-items-center">
                                    <img
                                        :src="category.image"
                                        class="me-3"
                                        height="40px"
                                        width="40px"
                                    />
                                    <div>
                                        <strong class="d-block">{{
                                            category.title
                                        }}</strong>
                                        <small
                                            >{{
                                                category.course_count
                                            }}
                                            Courses</small
                                        >
                                    </div>
                                </div>
                            </router-link>
                        </li>
                    </ul>
                </div>
                <ul class="navbar-nav ms-4 me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <router-link
                            to="/"
                            :class="[
                                'nav-link',
                                $route.path === '/' ? 'active' : '',
                            ]"
                            >Home</router-link
                        >
                    </li>
                    <li class="nav-item">
                        <router-link
                            to="/courses"
                            :class="[
                                'nav-link',
                                $route.path === '/courses' ? 'active' : '',
                            ]"
                            >Courses</router-link
                        >
                    </li>
                    <li class="nav-item">
                        <router-link
                            to="/about-us"
                            :class="[
                                'nav-link',
                                $route.path === '/about-us' ? 'active' : '',
                            ]"
                            class="nav-link"
                            >About Us</router-link
                        >
                    </li>
                    <li class="nav-item">
                        <router-link
                            to="/contact-us"
                            :class="[
                                'nav-link',
                                $route.path === '/contact-us' ? 'active' : '',
                            ]"
                            class="nav-link"
                            href="#"
                            >Contact Us</router-link
                        >
                    </li>
                </ul>
                <div v-if="authStore.authToken" class="dropdown me-3">
                    <a
                        href="#"
                        class="text-decoration-none text-dark"
                        data-bs-toggle="dropdown"
                        aria-expanded="false"
                    >
                        <img
                            :src="authStore.userData.profile_picture"
                            class="rounded-circle object-fit-cover"
                            alt="Menu"
                            height="45px"
                            width="45px"
                        />
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <router-link to="/dashboard" class="dropdown-item"
                                >Dashboard</router-link
                            >
                        </li>
                        <li>
                            <a class="dropdown-item" href="#" @click="logout()"
                                >Log Out</a
                            >
                        </li>
                    </ul>
                </div>
                <div v-else>
                    <router-link
                        to="/login"
                        class="btn btn-primary rounded-pill me-3"
                        >Login</router-link
                    >
                </div>
            </div>
        </section>
    </header>
</template>

<style scoped lang="scss">
.hero-header {
    background-color: #f3e9fe;
}

.navbar {
    .nav-item {
        padding-left: 1rem;
        padding-right: 1rem;

        .nav-link {
            padding-left: 0;
            padding-right: 0;
            padding-bottom: 4px;

            &:hover {
                color: #9e4aed;
            }
        }

        .nav-link.active {
            color: #9e4aed;
            font-weight: bold;
            border-bottom: 2px solid #9e4aed;
        }
    }

    .category-dropdown {
        .category-dropdown-btn {
            border: 1px solid #ddd2e9;
            background-color: #f3e9fe;
        }

        .category-menu {
            height: 500px;
            overflow-y: auto;

            .category-menu-item {
                .dropdown-item {
                    border: 1px solid #fff;
                    border-left: 3px solid #fff;
                    padding: 6px 50px 6px 10px;
                    margin-top: 6px;
                    margin-bottom: 6px;
                    border-radius: 0.7rem;
                    transition: all 0.2s ease-in-out;

                    &:hover {
                        border-color: #9e4aed;
                        background-color: #f3e9fe;
                    }
                }
            }
        }
    }
}
</style>

<script setup>
import { useAuthStore } from "@/stores/auth";
import { useMasterStore } from "@/stores/master";
import Swal from "sweetalert2";
import { ref, onMounted } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";

const router = useRouter();

const authStore = useAuthStore();
const masterStore = useMasterStore();
const isLoggedIn = ref(false);

let categories = ref([]);

const fetchCategories = async () => {
    try {
        const response = await axios.get(`/categories`, {
            headers: {
                "Content-Type": "application/json",
                Accept: "application/json",
            },
            params: {
                items_per_page: 20,
                page_number: 1,
            },
        });
        categories.value = response.data.data.categories;
    } catch (error) {
        console.error("Error fetching categories:", error);
    }
};

onMounted(() => {
    fetchCategories();
    if (authStore.authToken) {
        isLoggedIn.value = true;
    }

    // Fetch master data
    if (!masterStore.data) {
        axios
            .get(`/master`, {
                headers: {
                    "Content-Type": "application/json",
                    Accept: "application/json",
                },
            })
            .then((response) => {
                masterStore.setMasterData(response.data.data.master);
            })
            .catch((error) => {
                console.error("Error fetching data:", error);
            });
    }
});

function logout() {
    Swal.fire({
        title: "Are you sure?",
        text: "Do you want to log out?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, log out!",
    }).then((result) => {
        if (result.isConfirmed) {
            authStore.clearAuthData();

            Swal.fire({
                title: "Logged Out!",
                text: "Log out successful.",
                showConfirmButton: false,
                icon: "success",
                timer: 1500,
            });
        }
        router.push("/");
    });
}
</script>
