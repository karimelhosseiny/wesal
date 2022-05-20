<script>
import axios from "axios";
import Navbar from "../global/Navbar.vue";
import FieldComponent from "./FieldComponent.vue";
import { useUserStore } from "../../store/UserStore";
import { mapWritableState, mapStores } from "pinia";
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
            filteredByEmail: "",
            showModal: false,
            form: {
                name: "",
                email: "",
                phone: "",
                address: "",
                password: "",
                userType: "",
                adminType: "",
            },
            password_confirmation: "",
            passMatch: false,
        };
    },
    computed: {
        ...mapStores(useUserStore),
        ...mapWritableState(useUserStore, {
            user: "currentUser",
            storeToken: "token",
        }),
        filteredByEmail() {
            return this.users.filter((User) =>
                User.email.includes(this.search)
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
        async addUser() {
            if (
                this.form.password === this.password_confirmation &&
                this.form.password.length >= 8
            ) {
                await axios
                    .post(`http://localhost:8000/api/adduser`, this.form, {
                        mode: "no-cors",
                        headers: {
                            "Access-Control-Allow-Origin": "*",
                            "Content-Type": "application/json",
                        },
                    })
                    .then(function (res) {
                        console.log(res);
                        this.$router.go("/admindashboard");
                    })
                    .catch((e) => console.log("request error:", e));

                this.showModal = false;
            } else {
                alert(
                    "password doesn't match" +
                        "\n" +
                        "password: " +
                        this.form.password +
                        "\n" +
                        "Confirm password: " +
                        this.password_confirmation
                );
            }
        },
    },
    mounted() {
        this.fetchData();
    },
    created() {
        this.form.adminType = this.user.type;
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
                    <i
                        class="add col-3 my-3 fs-2 bi bi-plus-square-fill"
                        @click="showModal = true"
                    ></i>
                    <div v-if="showModal" class="modalOpen">
                        <div
                            class="container editModal shadow-lg p-3 mb-5 bg-body"
                        >
                            <form>
                                <br />
                                <div class="mx-4 row">
                                    <label for="name" class="col-4"
                                        >Name:
                                    </label>
                                    <input
                                        type="text"
                                        name="name"
                                        class="col-8"
                                        v-model="this.form.name"
                                    />
                                </div>
                                <br />
                                <div class="mx-4 row">
                                    <label for="email" class="col-4"
                                        >Email:
                                    </label>
                                    <input
                                        type="text"
                                        name="email"
                                        class="col-8"
                                        v-model="this.form.email"
                                    />
                                </div>
                                <br />
                                <div class="mx-4 row">
                                    <label for="phone" class="col-4"
                                        >Phone:
                                    </label>
                                    <input
                                        type="text"
                                        name="phone"
                                        class="col-8"
                                        v-model="this.form.phone"
                                    />
                                </div>
                                <br />
                                <div class="mx-4 row">
                                    <label for="phone" class="col-4"
                                        >Address:
                                    </label>
                                    <input
                                        type="text"
                                        name="address"
                                        class="col-8"
                                        v-model="this.form.address"
                                    />
                                </div>
                                <br />
                                <div class="mx-4 row">
                                    <label for="type" class="col-4"
                                        >Type:
                                    </label>
                                    <select
                                        name="type"
                                        class="col-8"
                                        v-model="this.form.userType"
                                    >
                                        <option disabled selected value="">
                                            select type
                                        </option>
                                        <option value="user">user</option>
                                        <option value="admin">admin</option>
                                        <option value="organization">
                                            organization
                                        </option>
                                    </select>
                                </div>
                                <br />
                                <div class="mx-4 row">
                                    <label
                                        for="name"
                                        name="password"
                                        class="col-4"
                                        >Password:
                                    </label>
                                    <input
                                        type="password"
                                        class="col-8"
                                        v-model="this.form.password"
                                    />
                                </div>
                                <br />
                                <div class="mx-4 row">
                                    <label for="name" class="col-4"
                                        >Confirm Password:
                                    </label>
                                    <input
                                        @keydown="
                                            form.password ==
                                            password_confirmation
                                                ? (passMatch = true)
                                                : (passMatch = false)
                                        "
                                        type="password"
                                        class="col-8"
                                        v-model="password_confirmation"
                                    />
                                    <span
                                        v-if="
                                            form.password !==
                                                password_confirmation &&
                                            password_confirmation != ''
                                        "
                                        class="text-danger"
                                    >
                                        passwords do not match</span
                                    >
                                </div>
                                <div class="m-4 row justify-content-around">
                                    <button
                                        @click="showModal = false"
                                        class="btn btn-danger col-3"
                                    >
                                        Close
                                    </button>
                                    <button
                                        class="btn btn-success col-3"
                                        @click.prevent="addUser"
                                    >
                                        Save
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="col-3 my-3 me-5 searchContainer">
                        <input
                            class="rounded-pill"
                            type="text"
                            placeholder="search by email"
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
                        v-for="(user, index) in filteredByEmail"
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
    .modalOpen {
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgb(0, 0, 0);
        background-color: rgba(0, 0, 0, 0.4);
    }
    .editModal {
        background-color: #fefefe;
        margin: 10% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 50%;
        border-radius: 25px;
    }
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
    .filterLogo {
        background-color: $priColor;
    }
    .dropdown-toggle {
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
