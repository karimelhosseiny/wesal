<script>
import axios from "axios";

export default {
    props: ["id", "name", "email", "phone", "type"],
    data() {
        return {
            form: {
                id: this.id,
                name: this.name,
                email: this.email,
                phone: this.phone,
                password: "",
            },
            confPass: "",
            passMatch:false,
            showModal: false,
        };
    },
    methods: {
        editUserData() {
            if (this.form.password === this.confPass) {
                axios.put(`http://localhost:8000/api/updatedone`, this.form, {
                    mode: "no-cors",
                    headers: {
                        "Access-Control-Allow-Origin": "*",
                        "Content-Type": "application/json",
                    },
                })
                .then(function (res) {
                    console.log(res);
                })
                .catch((e) => console.log("in action error:", e));
                this.showModal = false;
            } else {
               console.log(
                    "password doesn't match" +
                        "\n" +
                        "password: " +
                        this.form.password +
                        "\n" +
                        "Confirm password: " +
                        this.confPass
                );
            }
        },
    },
};
</script>

<template>
    <div class="col-2 id">
        <p>{{ id }}</p>
    </div>
    <div class="col-2">
        <p>{{ name }}</p>
    </div>
    <div class="col-2">
        <p>{{ email }}</p>
    </div>
    <div class="col-2">
        <p>{{ phone }}</p>
    </div>
    <div class="col-2 px-5">
        <p>{{ type }}</p>
    </div>
    <div class="col-2 px-5">
        <i class="edit mx-2 bi bi-pen" @click="showModal = true"></i>
        <i class="delete bi bi-trash3"></i>
    </div>
    <div v-if="showModal" class="modalOpen">
        <div class="container editModal shadow-lg p-3 mb-5 bg-body">
            <form>
                <div class="mt-4 mx-4 row">
                    <label for="name" name="user_id" class="col-4">ID: </label>
                    <input
                        type="text"
                        class="col-8"
                        v-model="form.id"
                        disabled
                    />
                </div>
                <br />
                <div class="mx-4 row">
                    <label for="name" class="col-4">Name: </label>
                    <input type="text" name="name" class="col-8" v-model="form.name" />
                </div>
                <br />
                <div class="mx-4 row">
                    <label for="name" class="col-4">Email: </label>
                    <input type="text" name="email" class="col-8" v-model="form.email" />
                </div>
                <br />
                <div class="mx-4 row">
                    <label for="name" class="col-4">Phone: </label>
                    <input type="text" name="phone" class="col-8" v-model="form.phone" />
                </div>
                <br />
                <div class="mx-4 row">
                    <label for="name" name="password" class="col-4">Password: </label>
                    <input
                        type="password"
                        class="col-8"
                        v-model="form.password"
                    />
                </div>
                <br />
                <div class="mx-4 row">
                    <label for="name" class="col-4">Confirm Password: </label>
                    <input @keydown="form.password==confPass?passMatch=true : passMatch=false" type="password" class="col-8" v-model="confPass" />
                    <span v-if="form.password !== confPass && confPass != ''" class="text-danger"> passwords do not match</span>
                </div>
                <div class="m-4 row justify-content-around">
                    <button
                        @click="showModal = false"
                        class="btn btn-danger col-3"
                    >
                        Close
                    </button>
                    <button @click="editUserData" class="btn btn-success col-3">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<style lang="scss" scoped>
@use "../../sass/colors" as *;
.col-2 {
    margin-bottom: 5px;
    background-color: #eee;
    border-bottom: $priColor solid 2px;
    .edit {
        width: fit-content;
        color: $priColor;
        cursor: pointer;
    }
    .edit:hover {
        color: $specialColor;
    }
    .delete {
        width: fit-content;
        color: red;
        cursor: pointer;
    }
    .delete:hover {
        color: orange;
    }
}
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
</style>
