<script>
import axios from "axios";
import Navbar from "../global/Navbar.vue";
import FieldComponent from "./FieldComponent.vue";
export default {
    data() {
        return {
            users: [],
            totalUsers: "",
            totalCases: "",
            totalDonations: "",
            isLoading: true,
        };
    },
    methods: {
        fetchData() {
            axios
                .get("http://localhost:8000/api/userdashboard", {
                    mode: "no-cors",
                    headers: {
                        "Access-Control-Allow-Origin": "*",
                        "Content-Type": "application/json",
                    },
                })
                .then(
                    ({ data }) => {
                        var users = [];
                        this.totalUsers = data.Total_Users;
                        this.totalCases = data.Total_Cases;
                        this.totalDonations = data.Total_Donations;
                        data.Users.forEach((user) => {
                            users.push({
                                id: user.id,
                                name: user.name,
                                email: user.email,
                                phone: user.phonenumber,
                                type: user.type,
                            });
                        });
                        this.users = users;
                        this.isLoading = false;
                    },
                    (e) => console.log(e)
                );
        },
        
    },
    mounted() {
        this.fetchData();
    },
    components: { Navbar, FieldComponent },
};
</script>

<template>
    <div>
        <Navbar />
        <div class="my-5 cards">
            <div class="mx-3 first-card card" style="width: 18rem">
                <h1>{{ totalUsers }}</h1>
                <h2>Total users</h2>
            </div>
            <div class="mx-3 second-card card" style="width: 18rem">
                <h1>{{ totalCases }}</h1>
                <h2>Total cases</h2>
            </div>
            <div class="mx-3 third-card card" style="width: 18rem">
                <h1>{{ totalDonations }}</h1>
                <h2>Donations</h2>
            </div>
        </div>
        <div class="shadow-lg card container dashboard">
            <div v-if="isLoading" class="text-center my-5">
                <div
                    class="spinner-grow mx-5 text-success"
                    style="width: 10rem; height: 10rem"
                    role="status"
                >
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
            <div v-else>
                <div class="row justify-content-center">
                    <h2 class="col-2">Users Data</h2>
                </div>
                <div class="titles row">
                    <div class="px-4 col-2">
                        <h4>ID</h4>
                    </div>
                    <div class="col-2">
                        <h4>Name</h4>
                    </div>
                    <div class="col-2">
                        <h4>Email</h4>
                    </div>
                    <div class="col-2">
                        <h4>Phone number</h4>
                    </div>
                    <div class="col-2">
                        <h4>Type</h4>
                    </div>
                    <div class="col-2">
                        <h4>Settings</h4>
                    </div>
                </div>
                <div class="row mx-2 info">
                    <FieldComponent
                        v-for="user in users"
                        :key="user.id"
                        :id="user.id"
                        :name="user.name"
                        :email="user.email"
                        :phone="user.phone"
                        :type="user.type"
                    />
                </div>
            </div>
        </div>
    </div>
</template>

<style lang="scss">
@use "../../sass/colors" as *;
.cards {
    display: flex;
    justify-content: center;
    div {
        width: 200px;
        height: 150px;
        text-align: center;
        border-radius: 15px;
        box-shadow: 0px 0px 21px rgba($color: #000000, $alpha: 0.2);
        h1,
        h2 {
            color: white;
        }
    }
    .first-card {
        background-color: $priColor;
        color: white;
        padding: 15px;
    }
    .second-card {
        border: 2px solid $priColor;
        h1,
        h2 {
            color: $priColor;
        }
        padding: 15px;
    }
    .third-card {
        background-color: $specialColor;
        color: white;
        padding: 15px;
    }
}
.dashboard {
    overflow: scroll;
    height: 600px;
    border-radius: 10px;
    margin-bottom: 20px;
    padding-bottom: 10px;
    h2 {
        color: $priColor;
        margin-bottom: 20px;
    }
    .searchContainer {
        margin-top: 0.2em;
        position: relative;
        width: 280px;
        height: 44.83px;

        input {
            margin-left: 40px;
            margin-top: 10px;
            border: none;
            filter: drop-shadow(0px 1px 4px rgba(0, 0, 0, 0.25));
            padding-left: 1.5em;
            border: 1px solid transparent;
            outline: none;
            font-weight: 300;
        }

        input:hover {
            border: 1px solid $secColor;
        }

        .searchIcon {
            position: absolute;
            color: #57ce8d;
            font-size: 16px;
            left: 235px;
            top: 13px;
            cursor: pointer;
            border: none;
            outline: none;
        }
    }
    .titles {
        h4 {
            color: $priColor;
        }
    }
}
</style>
