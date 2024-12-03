import { defineStore } from "pinia";

export const useAuthStore = defineStore("auth", {
    state: () => ({
        authToken: null,
        userData: null,
    }),
    actions: {
        setAuthData(token, data) {
            this.authToken = token;
            this.userData = data;
        },

        clearAuthData() {
            this.authToken = null;
            this.userData = null;
        },
    },
    persist: true,
});
