<script>
import axios from "axios";
import Navbar from "../global/Navbar.vue";
import FieldComponent from "./FieldComponent.vue";
export default {
    
    data() {
        return {
            users: [],
        };
    },
    methods: {
        fetchData() {
            axios
                .get("http://localhost:8000/api/users", {
                    mode: "no-cors",
                    headers: {
                        "Access-Control-Allow-Origin": "*",
                        "Content-Type": "application/json",
                    },
                })
                .then(
                    ({ data }) => {
                        console.log(data.usersnotadmins)
                        var users = [];
                        for (let index in data.usersnotadmins) {
                            users.push({
                                id: data.usersnotadmins[index].id,
                                name: data.usersnotadmins[index].name,
                                email: data.usersnotadmins[index].email,
                                phone: data.usersnotadmins[index].phonenumber,
                            });
                        }
                        this.users = users;
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
                <h1>2000</h1>
                <h2>user</h2>
            </div>
            <div class="mx-3 second-card card" style="width: 18rem">
                <h1>743</h1>
                <h2>ben. case</h2>
            </div>
            <div class="mx-3 third-card card" style="width: 18rem">
                <h1>40000</h1>
                <h1>raised</h1>
            </div>
        </div>
        <div class="shadow-lg card container dashboard">
            <div class="row justify-content-center">
                <h2 class="col-2">Users Data</h2>

            </div>
            <div class="titles row">
                <div class=" px-4 col-2">
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
                    <h4>Donations</h4>
                </div>
                <div class="col-2">
                    <h4>Donated</h4>
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
                />
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
