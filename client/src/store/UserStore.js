import axios from "axios";
import { defineStore } from "pinia";

export const useUser = defineStore("user", {
    state: () => ({
        user: {},
        token: localStorage.getItem("TOKEN"),
        // token: 'localStorage.getItem("TOKEN")',
    }),
    actions: {
        register: async (User) => {
            axios
                .post("http://localhost:8000/api/register", User, {
                    mode: "no-cors",
                    headers: {
                        "Access-Control-Allow-Origin": "*",
                        "Content-Type": "application/json",
                    },
                })
                .then(function(res){
                    this.user = res.data.user;
                    this.token = res.data.token;
                    localStorage.setItem("TOKEN", res.data.token);
                },(e)=>console.log(e));
        },
        login: async (user) => {
            axios.post("http://localhost:8000/api/login", user).then((res) => {
                this.state.user = res.data.user;
                this.state.token = res.data.token;
                localStorage.setItem("TOKEN", res.data.token);
            });
        },
        logout: () => {
            this.state.token = null;
            this.state.user = {};
            localStorage.removeItem("TOKEN");
        },
    },
});
