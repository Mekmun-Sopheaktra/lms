import { createRouter, createWebHistory } from "vue-router";
import defaultLayout from "./layouts/Default.vue";
import authLayout from "./layouts/Auth.vue";
import { useAuthStore } from "./stores/auth";

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: "/",
            name: "home",
            component: () => import("./pages/Home.vue"),
            meta: {
                layout: defaultLayout,
            },
        },
        {
            path: "/courses",
            name: "list",
            component: () => import("./pages/List.vue"),
            meta: {
                layout: defaultLayout,
            },
        },
        {
            path: "/details/:id",
            name: "details",
            component: () => import("./pages/Details.vue"),
            meta: {
                layout: defaultLayout,
            },
        },
        {
            path: "/play/:course_id",
            name: "play",
            component: () => import("./pages/Play.vue"),
            meta: {
                layout: defaultLayout,
            },
        },
        {
            path: "/instructor/:id",
            name: "instructor",
            component: () => import("./pages/Instructor.vue"),
            meta: {
                layout: defaultLayout,
            },
        },
        {
            path: "/login",
            name: "login",
            component: () => import("./pages/Login.vue"),
            meta: {
                layout: authLayout,
            },
        },
        {
            path: "/register",
            name: "register",
            component: () => import("./pages/Register.vue"),
            meta: {
                layout: authLayout,
            },
        },
        {
            path: "/reset_password",
            name: "reset_password",
            component: () => import("./pages/ResetPassword.vue"),
            meta: {
                layout: authLayout,
            },
        },
        {
            path: "/verify_otp",
            name: "verify_otp",
            component: () => import("./pages/VerifyOtp.vue"),
            meta: {
                layout: authLayout,
            },
        },
        {
            path: "/new_password",
            name: "new_password",
            component: () => import("./pages/NewPassword.vue"),
            meta: {
                layout: authLayout,
            },
        },
        {
            path: "/checkout/:id",
            name: "checkout",
            component: () => import("./pages/Checkout.vue"),
            meta: {
                layout: authLayout,
                requiresAuth: true,
            },
        },
        {
            path: "/enroll_status",
            name: "enroll_status",
            component: () => import("./pages/EnrollStatus.vue"),
            meta: {
                layout: authLayout,
            },
        },
        {
            path: "/dashboard",
            name: "dashboard",
            component: () => import("./pages/Dashboard.vue"),
            meta: {
                layout: defaultLayout,
                requiresAuth: true,
            },
        },
        {
            path: "/page/:slug",
            name: "page",
            component: () => import("./pages/Page.vue"),
            meta: {
                layout: defaultLayout,
            },
        },
        {
            path: "/about-us",
            name: "about_us",
            component: () => import("./pages/AboutUs.vue"),
            meta: {
                layout: defaultLayout,
            },
        },
        {
            path: "/contact-us",
            name: "contact_us",
            component: () => import("./pages/ContactUs.vue"),
            meta: {
                layout: defaultLayout,
            },
        },
        {
            path: "/faq",
            name: "faq",
            component: () => import("./pages/FAQ.vue"),
            meta: {
                layout: defaultLayout,
            },
        },
    ],
});

router.beforeEach((to, from, next) => {
    const authStore = useAuthStore(); // Get auth store instance

    if (to.meta.requiresAuth && !authStore.userData) {
        // Redirect to login if user is not authenticated
        return next({ name: "login" });
    }

    next(); // Proceed to the next route
});

export default router;
