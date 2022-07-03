<script>
import axios from "axios";
import { useUserStore } from "../../store/UserStore";
import { mapStores, mapWritableState } from "pinia";
export default {
    props: [
        "pic",
        "title",
        "org",
        "id",
        "caseDesc",
        "goal",
        "raised",
        "isFavorite",
        "reminder",
        "cat",
    ],
    data() {
        return {
            showModal: false,
            orgDatapair: [],
            form: {
                title: "",
                goal: "",
                deadline: "",
                description: "",
                category: "",
                org: "",
                case_id: 5
            },
        };
    },
    methods: {
        async deleteCase() {
            axios.defaults.headers.common["Authorization"] =
                "Bearer " + this.storeToken;
            axios
                .post("http://localhost:8000/api/anycasedeleted", {
                    id: this.id,
                })
                .then(
                    () => {
                        this.$router.go("/organizationdashboard");
                    },
                    (err) => {
                        console.log(err);
                    }
                );
        },
        async editCaseData() {
            axios.defaults.headers.common["Authorization"] =
                "Bearer " + this.storeToken;
            axios
                .post("http://localhost:8000/api/newcaseupdated", this.form)
                .then(
                    ({data}) => {
                        console.log("edit Data: ",data)
                        this.$router.go("/organizationdashboard");
                    },
                    (err) => {
                        console.log(err);
                    }
                );
        },
        async fetchOrgData() {
            await axios("http://localhost:8000/api/orgdata").then(
                ({ data }) => {
                    data.organziationWithCases.forEach((org) => {
                        this.orgDatapair.push({
                            id: org.id,
                            title: org.title,
                        });
                    });
                },
                (err) => {
                    console.log(err);
                }
            );
        },
    },
    mounted() {
        axios.defaults.headers.common["Authorization"] =
            "Bearer " + this.storeToken;
        this.fetchOrgData();
        this.form.title = this.title;
        this.form.goal = this.goal;
        this.form.description = this.caseDesc;
        this.form.case_id = this.id;
    },
    computed: {
        ...mapStores(useUserStore),
        ...mapWritableState(useUserStore, {
            user: "currentUser",
            storeToken: "token",
        }),
    },
};
</script>

<template>
    <div class="card p-2">
        <div class="top">
            <img src="../../assets/SVG/Resala logo.png" class="ms-3" alt="..." />
            <div class="title ms-2 mt-3">
                <span class="title">{{ title }}</span>
                <a class="org h6 fw-normal">{{ org }}</a>
            </div>
            <div class="icons">
                <i
                    @click.prevent="showModal = true"
                    class="bi bi-gear-fill text-success"
                ></i>
                <i @click="deleteCase" class="bi bi-trash-fill text-danger"></i>
                <div v-if="showModal" class="modalOpen">
                    <div class="container editModal shadow-lg p-3 mb-5 bg-body">
                        <form>
                            <br />
                            <div class="mx-4 row">
                                <label for="name" class="col-4">Title: </label>
                                <input
                                    type="text"
                                    name="name"
                                    class="col-8"
                                    v-model="this.form.title"
                                />
                            </div>
                            <br />
                            <div class="mx-4 row">
                                <label for="email" class="col-4">Goal: </label>
                                <input
                                    type="number"
                                    name="email"
                                    class="col-8"
                                    v-model="this.form.goal"
                                />
                            </div>
                            <br />
                            <div class="mx-4 row">
                                <label for="phone" class="col-4"
                                    >Deadline:
                                </label>
                                <input
                                    type="date"
                                    name="phone"
                                    class="col-8"
                                    v-model="this.form.deadline"
                                />
                            </div>
                            <br />
                            <div class="mx-4 row">
                                <label for="phone" class="col-4"
                                    >Description:
                                </label>
                                <textarea
                                    style="resize: none"
                                    rows="6"
                                    type="textarea"
                                    name="address"
                                    class="col-8"
                                    v-model="this.form.description"
                                />
                            </div>
                            <br />
                            <div class="mx-4 row">
                                <label for="type" class="col-4"
                                    >Category:
                                </label>
                                <select
                                    name="type"
                                    class="col-8"
                                    v-model="this.form.category"
                                >
                                    <option disabled selected value="">
                                        select Category
                                    </option>
                                    <option value="1">Food</option>
                                    <option value="2">Clothes</option>
                                    <option value="3">Sick</option>
                                    <option value="4">Sadaka</option>
                                </select>
                            </div>
                            <br />
                            <div class="mx-4 row">
                                <label for="organization" class="col-4"
                                    >Organization:
                                </label>
                                <select
                                    name="organization"
                                    class="col-8"
                                    v-model="this.form.org"
                                >
                                    <option disabled selected value="">
                                        select Organization
                                    </option>
                                    <option
                                        v-for="org in orgDatapair"
                                        :value="org.id"
                                    >
                                        {{ org.title }}
                                    </option>
                                </select>
                            </div>
                            <br />
                            <div class="m-4 row justify-content-around">
                                <button
                                    @click.prevent="showModal = false"
                                    class="btn btn-danger col-3"
                                >
                                    Close
                                </button>
                                <button
                                    class="btn btn-success col-3"
                                    @click.prevent="editCaseData"
                                >
                                    save
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="mid">
            <p class="descr fw-bold">
                {{ caseDesc }}
            </p>
            <span class="target">target:</span>
            <span>
                {{ goal }}
                <sub>egp</sub>
            </span>
            <div class="progressBar">
                <div class="ammount mt-3 px-2 d-flex justify-content-between">
                    <span>
                        {{ raised }}
                        <sub>egp</sub>
                    </span>
                    <span>
                        {{ goal }}
                        <sub>egp</sub>
                    </span>
                </div>
                <progress
                    class="bar bg-transparent"
                    :value="raised > 0 ? raised : 0"
                    :max="goal"
                ></progress>
            </div>
        </div>
        <div class="bottom">
            <router-link
                :to="'/casepage/' + this.id"
                class="btn btn-block more rounded-pill text-decoration-none text-light"
                >More</router-link
            >
        </div>
    </div>
</template>

<style lang="scss" scoped>
@use "../../sass/colors" as *;

$logoSize: 60px;
.card {
    width: 310px;
    height: 364px;
    outline: none;
    border: none;
    background: white;
    border-radius: 22px;
    box-shadow: 0px 0px 21px rgba($color: #000000, $alpha: 0.2);
    display: grid;
    grid-template-rows: 20% 60% 20%;
    grid-template-areas:
        "top"
        "mid"
        "bottom";
    .top {
        display: grid;
        grid-template-columns: 1fr 2fr 1fr;
        grid-area: "top";
        img {
            width: $logoSize;
            height: $logoSize;
            border-radius: 50%;
            justify-self: start;
            align-self: center;

            border: 2px solid $priColor;
        }
        .title {
            justify-self: start;
            align-self: start;
            display: flex;
            flex-direction: column;
            gap: 0;
            color: $priColor;
            .title {
                font-size: 15px;
                font-weight: 800;
            }
            .org {
                width: fit-content;
                font-size: 15px;
                text-decoration: none;
                color: $priColor;
                cursor: pointer;
                &:hover {
                    text-decoration: underline;
                }
            }
        }
        .icons {
            align-self: center;
            justify-self: center;
            font-size: 20px;
            cursor: pointer;

            i {
                display: block;
            }
        }
    }
    .mid {
        grid-area: "mid";
        padding: 1.3em;
        color: $priColor;
        p {
            width: 252.5px;
            height: 50px;
            color: black;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .target {
            margin-bottom: 1em;
            font-weight: 600;
        }

        span {
            font-weight: 600;
        }
        .progressBar {
            .bar[value]::-webkit-progress-bar {
                height: 10px;
                width: 160%;
                border-radius: 10px;
                margin-top: 7px;
            }
            .bar[value]::-webkit-progress-value {
                background-color: $priColor;
                border-radius: 10px;
            }
        }
    }
    .bottom {
        grid-area: "bottom";
        align-self: start;
        display: grid;
        max-width: 100%;
        overflow: hidden;
        margin-top: 0.5em;
        .more {
            background-color: $priColor;
            width: 60%;
            justify-self: center;
            font-weight: bold;
            font-size: 24px;
            color: $white;
            letter-spacing: 0.05em;
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
    
}
</style>
