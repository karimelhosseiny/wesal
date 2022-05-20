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
            referance: "All users",
            filteredUsers: "",
            search: "",
            filteredByPhone: "",
        };
    },
    computed: {
        filteredByPhone() {
            return this.users.filter((User) =>
                User.phone !== null ? User.phone.includes(this.search) : false
            );
        },

        filteredUsers() {
            return this.users.filter((User) => User.type == this.referance);
        },
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
                <div class="headdings row my-3 justify-content-around">
                    <div class="col-3 ms-5 me-5 my-2 filter btn-group pt-2">
                        <button class="btn btn-sm filterLogo" type="button">
                            <i class="h1 text-light bi bi-filter"></i>
                        </button>
                        <select
                            class="btn btn-sm btn-success dropdown-toggle"
                            aria-expanded="false"
                            v-model="referance"
                        >
                            <option value="All users">All users</option>
                            <option value="admin">Admins</option>
                            <option value="organization">Organizations</option>
                            <option value="user">Users</option>
                        </select>
                    </div>
                    <h2 class="col-3 my-3 ms-5 pt-1">{{ referance }} Data</h2>
                    <i class="add col-3 my-3 fs-2 bi bi-plus-square-fill"></i>
                    <div class="col-3 my-3 me-5 searchContainer">
                        <input
                            class="rounded-pill"
                            type="text"
                            placeholder="search users"
                            v-model="search"
                        />
                        <i class="bi bi-search searchIcon"></i>
                    </div>
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
                        v-if="referance == 'All users'"
                        v-for="(user, index) in filteredByPhone"
                        :key="index"
                        :id="user.id"
                        :name="user.name"
                        :email="user.email"
                        :phone="user.phone"
                        :type="user.type"
                    />
                    <FieldComponent
                        v-else
                        v-for="(user, index) in filteredUsers"
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
    .headdings {
        border-bottom: 2px solid $priColor;
    }
    .filter {
        width: fit-content;
    }
    .add {
        width: fit-content;
        color: $priColor;
        cursor: pointer;
    }
    .filterLogo{
        background-color: $priColor;
    }
    .dropdown-toggle{
        background-color: $priColor;
    }
    .searchContainer {
        // background: red;
        margin-top: 0.2em;
        position: relative;
        width: 280px;
        height: 44.83px;

        input {
            width: 200px;
            margin-left: 40px;
            margin-top: 16px;
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
            left: 210px;
            top: 19px;
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
