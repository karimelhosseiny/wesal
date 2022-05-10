import axios from "axios";
import { defineStore } from "pinia";

export const useUserStore = defineStore("user", {
    state: () => ({
        currentUser: {},
        token: localStorage.getItem("TOKEN"),
    }),
    actions: {
        async register(enterdUser) {
            var Token = {};
            var CurrentUser = null;
            await axios
                .post("http://localhost:8000/api/register", enterdUser, {
                    mode: "no-cors",
                    headers: {
                        "Access-Control-Allow-Origin": "*",
                        "Content-Type": "application/json",
                    },
                })
                .then(function (res) {
                    console.log(res);
                    if (res.data.status) {
                        console.log("errors: ", res.data.errors);
                    } else {
                        console.log(res.data.token);
                        Token = res.data.token;
                        CurrentUser = res.data.user;
                    }
                })
                .catch((e) => console.log("in action error:", e));
            this.token = Token;
            this.currentUser = CurrentUser;
            localStorage.setItem("TOKEN", Token);
        },
        async login(enterdUser) {
            var Token = {};
            var CurrentUser = null;
            await axios
                .post("http://localhost:8000/api/login", enterdUser, {
                    mode: "no-cors",
                    headers: {
                        "Access-Control-Allow-Origin": "*",
                        "Content-Type": "application/json",
                    },
                })
                .then(function (res) {
                    console.log(res);
                    if (res.data.status) {
                        console.log("errors: ", res.data.errors);
                    } else {
                        console.log(res.data.token);
                        Token = res.data.token;
                        CurrentUser = res.data.user;
                    }
                })
                .catch((e) => console.log("in action error:", e));
            this.token = Token;
            this.currentUser = CurrentUser;
            localStorage.setItem("TOKEN", Token);
        },
        logout() {
            this.currentUser = {};
            this.token = null;
            localStorage.removeItem("TOKEN");
        },
    },
});
