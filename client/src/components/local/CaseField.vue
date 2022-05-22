<script>
import axios from "axios";
import { useUserStore } from "../../store/UserStore";
import { mapWritableState, mapStores } from "pinia";
export default {
    props: ["id", "title", "organization", "category", "goal", "raised", "createdat"],
    data() {
        return {
            form: {
                user_id: this.id,
                name: this.name,
                email: this.email,
                phone: this.phone,
                verificationdocuments:[],
                password: "",
                password_confirmation: "",
                userType: this.type,
                // token:this.token,
                adminType: "",
                adminId: "",
            },
            passMatch: false,
            showModal: false,
            toastShown:false
        };
    },
    methods: {
        /*
        name
        phone
        address
        image
        */
        async editUserData() {
            if (
                this.form.password === this.form.password_confirmation &&
                this.form.password.length >= 8
            ) {
                await axios
                    .post(`http://localhost:8000/api/updatedone`, this.form, {
                        mode: "no-cors",
                        headers: {
                            "Access-Control-Allow-Origin": "*",
                            "Content-Type": "application/json",
                        //    'Authorization': 'Bearer'
                        },
                    })
                    .then(function (res) {
                        console.log(res);
                        this.$router.go("/admindashboard");
                    })
                    .catch((e) => console.log("request error:", e));

                //update to admin
                if (this.form.userType === "admin") {
                    console.log("Updating admin...");
                    await axios
                        .post(
                            `http://localhost:8000/api/updateusertoadmin`,
                            this.form,
                            {
                                mode: "no-cors",
                                headers: {
                                    "Access-Control-Allow-Origin": "*",
                                    "Content-Type": "application/json",
                                },
                            }
                        )
                        .then((res) => {
                            console.log("user updated to admin", res);
                            this.$router.go("/admindashboard");
                        })
                        .catch((e) => console.log("request error:", e));
                }

                //update user to org --> to be tested , still needs dropdown and verDocs
                if (this.form.userType === "organization") {
                    console.log("Updating to org...");
                    await axios
                        .post(
                            `http://localhost:8000/api/updateusertoorg`,
                            {
                                adminType:this.form.adminType,
                                user_id:this.form.user_id,
                                verificationdocuments:this.form.verificationdocuments,
                            },
                            {
                                mode: "no-cors",
                                headers: {
                                    "Access-Control-Allow-Origin": "*",
                                },
                            }
                        )
                        .then((res) => {
                            console.log("user updated to org", res);
                            this.$router.go("/admindashboard");
                        })
                        .catch((e) => console.log("request error:", e));
                }
                this.showModal = false;
            } else {
                console.log(
                    "password doesn't match" +
                        "\n" +
                        "password: " +
                        this.form.password +
                        "\n" +
                        "Confirm password: " +
                        this.form.password_confirmation
                );
            }
        },
        deleteUser() {
            axios
                .post(
                    `http://localhost:8000/api/userdeleted`,
                    { user_id: this.id, adminType: this.User.type },
                    {
                        mode: "no-cors",
                        headers: {
                            "Access-Control-Allow-Origin": "*",
                            "Content-Type": "application/json",
                        },
                    }
                )
                .then(({ data }) => {

                    console.log("user deleted");
                    console.log(data);
                    this.$router.go("/admindashboard");

                })
                .catch((e) => console.log(e));
        },
        onFileChange(e) {
            console.log(e.target.files[0]);
            this.form.verificationdocuments.push(e.target.files[0]);
        },
    },
    mounted() {
        axios.defaults.headers.common["Authorization"] =
            "Bearer " + this.storeToken;
    },
    computed: {
        ...mapStores(useUserStore),
        ...mapWritableState(useUserStore, {
            user: "currentUser",
            storeToken: "token",
        }),
    },
    created() {
        this.form.adminType = this.user.type;
        this.form.adminId = this.user.id;
    },
};
</script>

<template>
    <div class="col-1 id">
        <p>1</p>
    </div>
    <div class="col-1">
        <p class="oneLine">Please food</p>
    </div>
    <div class="col-2">
        <p class="oneLine">MisrElkhair</p>
    </div>
    <div class="col-2">
        <p class="oneLine">Clothes</p>
    </div>
    <div class="col-1 ">
        <p class="oneLine">50000</p>
    </div>
    <div class="col-1">
        <p class="oneLine">20000</p>
    </div>
    <div class="col-2 px-5">
        <p>22/5/2022</p>
    </div>
    <div class="col-2 px-5">
        <i class="edit mx-2 bi bi-pen" @click="showModal = true"></i>
        <i class="delete bi bi-trash3" @click="deleteUser"></i>
    </div>
    <div v-if="showModal" class="modalOpen">
        <div class="container editModal shadow-lg p-3 mb-5 bg-body">
            <form>
                <div class="mt-4 mx-4 row">
                    <label for="name" name="user_id" class="col-4">ID: </label>
                    <input
                        type="text"
                        class="col-8"
                        v-model="form.user_id"
                        disabled
                    />
                </div>
                <br />
                <div class="mx-4 row">
                    <label for="name" class="col-4">Title: </label>
                    <input
                        type="text"
                        name="name"
                        class="col-8"
                        v-model="form.name"
                    />
                </div>
                <br />
                <div class="mx-4 row">
                    <label for="email" class="col-4">Organization: </label>
                    <input
                        type="text"
                        name="email"
                        class="col-8"
                        v-model="form.email"
                        disabled
                    />
                </div>
                <br />
                    <div class="mx-4 row">
                        <label for="userType" class="col-4">Category: </label>
                        <select
                            name="userType"
                            class="col-8"
                            v-model="form.userType"
                        >
                            <option disabled selected value="">select category</option>
                            <option>Food</option>
                            <option>Clothes</option>
                            <option>Sick</option>
                            <option>Sadaka</option>
                        </select>
                    </div>
                    <br />
                <div class="mx-4 row">
                    <label for="phone" class="col-4">Goal: </label>
                    <input
                        type="text"
                        name="phone"
                        class="col-8"
                        v-model="form.phone"
                    />
                </div>
                <br />
                <div class="mx-4 row">
                    <label for="name" name="password" class="col-4"
                        >Raised:
                    </label>
                    <input
                        type="password"
                        class="col-8"
                        v-model="form.password"
                        disabled
                    />
                </div>
                <br />
                <div class="mx-4 row">
                    <label for="name" class="col-4">Created at: </label>
                    <input
                        type="password"
                        class="col-8"
                        v-model="form.password_confirmation"
                        disabled
                    />
                </div>
                <div class="m-4 row justify-content-around">
                    <button
                        @click="showModal = false"
                        class="btn btn-danger col-3"
                    >
                        Close
                    </button>
                    <button
                        @click.prevent="editUserData"
                        class="btn btn-success col-3"
                    >
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<style lang="scss" scoped>
@use "../../sass/colors" as *;
.col-2,.col-1 {
    margin-bottom: 5px;
    background-color: #eee;
    border-bottom: $priColor solid 2px;
    .oneLine{
        width: fit-content;
    }
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
