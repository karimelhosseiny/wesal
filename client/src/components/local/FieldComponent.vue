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
        };
    },
    methods: {
        editUserData() {
            if (this.form.password == this.confPass) {
                axios.post("http://localhost:8000/api/updatedone", this.form, {
                    mode: "no-cors",
                    headers: {
                        "Access-Control-Allow-Origin": "*",
                        "Content-Type": "application/json",
                    },
                });
            } else {
                alert(
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
    <div class="col-2 px-5 donated">
        <!-- Button trigger modal -->
        <i
            type="button"
            class="edit mx-2 bi bi-pen"
            data-bs-toggle="modal"
            data-bs-target="#staticBackdrop"
        >
        </i>

        <!-- Modal -->
        <div
            class="modal fade"
            id="staticBackdrop"
            data-bs-backdrop="static"
            data-bs-keyboard="false"
            tabindex="-1"
            aria-labelledby="staticBackdropLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">
                            Edit Mode
                        </h5>
                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"
                        ></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="container">
                                <div class="row">
                                    <label class="col-6" for="user_id"
                                        >ID</label
                                    >
                                    <input
                                        class="col-6"
                                        type="text"
                                        name="user_id"
                                        v-model="this.form.id"
                                        readonly
                                    />
                                </div>
                                <br />
                                <div class="row">
                                    <label for="name" class="col-6"
                                        >Name:</label
                                    >
                                    <input
                                        type="text"
                                        class="col-6"
                                        name="name"
                                        v-model="form.name"
                                    />
                                </div>
                                <br />
                                <div class="row">
                                    <label for="email" class="col-6"
                                        >Email:</label
                                    >
                                    <input
                                        type="text"
                                        class="col-6"
                                        name="email"
                                        v-model="form.email"
                                    />
                                </div>
                                <br />
                                <div class="row">
                                    <label for="phone" class="col-6"
                                        >Phone number:</label
                                    >
                                    <input
                                        type="text"
                                        class="col-6"
                                        name="phone"
                                        v-model="form.phone"
                                    />
                                </div>
                                <br />
                                <div class="row">
                                    <label for="pass" class="col-6"
                                        >Password:</label
                                    >
                                    <input
                                        type="password"
                                        class="col-6"
                                        name="pass"
                                        v-model="form.password"
                                    />
                                </div>
                                <br />
                                <div class="row">
                                    <label for="password" class="col-6"
                                        >Confirm password:</label
                                    >
                                    <input
                                        type="password"
                                        class="col-6"
                                        name="password"
                                        v-model="confPass"
                                    />
                                </div>
                                <br />
                            </div>
                            <div class="modal-footer">
                                <button
                                    type="button"
                                    class="btn btn-danger"
                                    data-bs-dismiss="modal"
                                >
                                    Close
                                </button>
                                <button
                                    @click.prevent="editUserData"
                                    type="submit"
                                    class="btn btn-success"
                                >
                                    Save
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <i class="delete bi bi-trash3"></i>
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
</style>
