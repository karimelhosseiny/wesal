<script>
import axios from "axios";
import { useUserStore } from "../../store/UserStore";
import { mapWritableState, mapStores } from "pinia";
export default {
    props: ["id", "title", "organization", "category", "goal", "raised", "createdat"],
    data() {
        return {
            form: {
                case_id: this.id,
                title: this.title,
                organization: this.organization,
                category: this.category,
                goal: this.goal,
                raised: this.raised,
                createdat: this.createdat,
            },
            showModal: false,
        };
    },

    methods: {

        async editCaseData() {



        },
        deleteCase() {

        },
    },
    mounted() {
    },
    computed: {
        ...mapStores(useUserStore),
        ...mapWritableState(useUserStore, {
            user: "currentUser",
            storeToken: "token",
        }),
    },
    created() {
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
        <i class="delete bi bi-trash3" @click="deleteCase"></i>
    </div>
    <div v-if="showModal" class="modalOpen">
        <div class="container editModal shadow-lg p-3 mb-5 bg-body">
            <form>
                <div class="mt-4 mx-4 row">
                    <label for="name" name="user_id" class="col-4">ID: </label>
                    <input
                        type="text"
                        class="col-8"
                        v-model="form.case_id"
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
                        v-model="form.title"
                    />
                </div>
                <br />
                <div class="mx-4 row">
                    <label for="email" class="col-4">Organization: </label>
                    <input
                        type="text"
                        name="email"
                        class="col-8"
                        v-model="form.organization"
                        disabled
                    />
                </div>
                <br />
                    <div class="mx-4 row">
                        <label for="userType" class="col-4">Category: </label>
                        <select
                            name="userType"
                            class="col-8"
                            v-model="form.category"
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
                        v-model="form.goal"
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
                        v-model="form.raised"
                        disabled
                    />
                </div>
                <br />
                <div class="mx-4 row">
                    <label for="name" class="col-4">Created at: </label>
                    <input
                        type="password"
                        class="col-8"
                        v-model="form.createdat"
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
                        @click.prevent="editCaseData"
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
