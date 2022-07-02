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
                category: 1,
                goal: this.goal,
                raised: this.raised,
                createdat: this.createdat,
            },
            showModal: false,
            showConf: false,
        };
    },

    methods: {

        async editCaseData() {
           await axios.post('http://localhost:8000/api/caseupdated',this.form)
           .then(({data})=>{
            console.log(data)
            this.$router.go('/casesdashboard')
           },(err)=>{
            console.log(err)
           });
        },
        async deleteCase() {
            await axios.post('http://localhost:8000/api/casedeleted',{case_id:this.form.case_id})
            .then((res) => {
                console.log(res);
                this.$router.go("/casesdashboard");
            })
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
        <p>{{id}}</p>
    </div>
    <div class="col-1">
        <p class="oneLine">{{title}}</p>
    </div>
    <div class="col-2">
        <p class="oneLine">{{organization}}</p>
    </div>
    <div class="col-2">
        <p class="oneLine">{{category}}</p>
    </div>
    <div class="col-1 ">
        <p class="oneLine">{{goal}}</p>
    </div>
    <div class="col-1">
        <p class="oneLine">{{raised}}</p>
    </div>
    <div class="col-2 px-1 d-flex  justify-content-center align-items-start ">
        <p class="mb-5" style="width:fit-content">{{createdat}}</p>
    </div>
    <div class="col-2 px-5">
        <i class="edit mx-2 bi bi-pen" @click="showModal = true"></i>
        <i class="delete bi bi-trash3" @click="showConf=true"></i>
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
                            v-model="this.form.category"
                        >
                            <option disabled selected value="">select category</option>
                            <option value="1">Food</option>
                            <option value="2">Clothes</option>
                            <option value="3">Sick</option>
                            <option value="4">Sadaka</option>
                        </select>
                    </div>
                    <br />
                <div class="mx-4 row">
                    <label for="phone" class="col-4">Goal: </label>
                    <input
                        type="number"
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
                        type="text"
                        class="col-8"
                        v-model="form.raised"
                        disabled
                    />
                </div>
                <br />
                <div class="mx-4 row">
                    <label for="name" class="col-4">Created at: </label>
                    <input
                        type="text"
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
    <div v-if="showConf" class="modalOpen">
                        <div
                            class="container editModal h-50 shadow-lg p-3  bg-body"
                        >
                                <h3 class="row" style="margin:20px 0 50px 90px">sure you wanna delete this case?</h3>
                                <div class="row">
                                    <div class="m-4 row justify-content-around">
                                        <button
                                            @click="showConf = false"
                                            class="btn btn-danger col-3"
                                        >
                                            cancel
                                        </button>
                                        <button
                                            class="btn btn-success col-3"
                                            @click.prevent="deleteCase"
                                        >
                                            yeah
                                        </button>
                                    </div>
                                </div>
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
