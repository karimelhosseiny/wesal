<script>
import Navbar from "../global/Navbar.vue";
import UserCaseCard from "../local/UserCaseCard.vue";
import PaymentDetails from "./PaymentDetails.vue";
import { mapState, mapStores, mapWritableState } from "pinia";
import { useUserStore } from "../../store/UserStore";
import axios from "axios";
export default {
    data() {
        return {
            cases: [],
            phoneFormToggler: false,
            emailFormToggler: false,
            addressFormToggler: false,
            phonenumber: "",
            email: "",
            address: "",
        };
    },
    mounted() {
        axios.defaults.headers.common["Authorization"] =
            "Bearer " + this.storeToken;
        this.getUserCases();
        this.email = this.User.email;
        this.address = this.User.address;
    },
    computed: {
        ...mapStores(useUserStore),
        ...mapWritableState(useUserStore, {
            User: "currentUser",
            storeToken: "token",
        }),
    },
    methods: {
        toggleFavoriteStatus(cardId) {
            const selectedCard = this.cases.find((Case) => Case.id === cardId);
            selectedCard.isFavorite = !selectedCard.isFavorite;
        },
        toggleReminderStatus(cardId) {
            const selectedCard = this.cases.find((Case) => Case.id === cardId);
            selectedCard.reminder = !selectedCard.reminder;
        },
        async getUserCases() {
            await axios(
                `http://localhost:8000/api/userhomepage/${this.User.id}`,
                {
                    mode: "no-cors",
                    headers: {
                        "Access-Control-Allow-Origin": "*",
                        "Content-Type": "application/json",
                    },
                }
            ).then(
                ({ data }) => {
                    console.log(data);
                    this.cases = data.cases;
                },
                (err) => {
                    console.log(err);
                }
            );
        },
        async addNewData() {
            axios
                .post(
                    `http://localhost:8000/api/edituser/`,
                    {
                        phonenumber: this.phonenumber,
                        email: this.email,
                        address: this.address,
                    },
                    {
                        mode: "no-cors",
                        headers: {
                            "Access-Control-Allow-Origin": "*",
                            "Content-Type": "application/json",
                        },
                    }
                )
                .then(
                    ({ data }) => {
                        console.log(data);
                    },
                    (err) => {
                        console.log(err);
                    }
                );
        },
    },
    components: { Navbar, UserCaseCard, PaymentDetails },
};
</script>

<template>
    <div>
        <Navbar />
        <div class="mainContainer">
            <div class="profPic text-center d-flex flex-column">
                <img src="../../assets/7maya.png" alt="profile picture" />
                <div class="d-flex justify-content-between px-5 mt-4">
                    <a href="#" class>upload</a>
                    <a href="#">remove</a>
                </div>
            </div>
            <div class="dataContainer py-5 px-4">
                <div class="personalInfo">
                    <h1>{{ this.User.name }}</h1>
                    <div class="px-3">
                        <h4 v-if="emailFormToggler == false">
                            {{ this.User.email }}
                            <i
                                @click="emailFormToggler = !emailFormToggler"
                                class="bi bi-pencil-square ms-3"
                            ></i>
                        </h4>
                        <div v-else class="addEmail">
                            <input
                                type="email"
                                name="email"
                                v-model="email"
                                placeholder="me@email.com"
                                class="me-3 mb-4 rounded-pill form-control w-25 d-inline"
                            />
                            <input
                                class="btn btn-success rounded-pill"
                                type="button"
                                value="save"
                                @click="addNewData"
                            />
                        </div>
                        <h4 v-if="this.User.phonenumber != null">
                            +{{ this.User.phonenumber }}
                            <i class="bi bi-pencil-square ms-3"></i>
                        </h4>
                        <div v-else>
                            <div
                                v-if="phoneFormToggler == false"
                                class="opacity-50 fs-larger mb-3"
                            >
                                <span class="fs-larger ">please add your number</span>
                                <i
                                    @click="
                                        phoneFormToggler = !phoneFormToggler
                                    "
                                    class="bi bi-pencil-square ms-3"
                                ></i>
                            </div>
                            <div v-else>
                                <input
                                    type="text"
                                    name="phonenumber"
                                    v-model="phonenumber"
                                    maxlength="11"
                                    minlength="11"
                                    placeholder="i.e. 012 3456 7899"
                                    class="me-3 mb-4 rounded-pill form-control w-25 d-inline"
                                />
                                <input
                                    class="btn btn-success rounded-pill"
                                    type="button"
                                    value="save"
                                    @click="addNewData"
                                />
                            </div>
                            <div>
                                <div v-if="this.address != null&&addressFormToggler == false" class="mb-3">
                                    <span class="addressHeader mb-1">
                                        <h4>address</h4>
                                        <i @click="addressFormToggler=!addressFormToggler" class="bi bi-pencil-square ms-3"></i>
                                    </span>
                                    <span
                                        class="ms-2 px-4 py-2 bg-light rounded-pill"
                                    >
                                        {{ this.User.address }}
                                    </span>
                                </div>
                                <div v-else>
                                    <div
                                        v-if="addressFormToggler == false"
                                        class="opacity-50 fs-larger"
                                    >
                                        <span class="fs-larger"
                                            >please add your address</span
                                        >
                                        <i
                                            @click="
                                                addressFormToggler =
                                                    !addressFormToggler
                                            "
                                            class="bi bi-pencil-square ms-3"
                                        ></i>
                                    </div>
                                    <div v-else>
                                        <input
                                            type="text"
                                            name="address"
                                            v-model="address"
                                            placeholder="i.e. address"
                                            class="me-3 rounded-pill form-control w-25 d-inline"
                                        />
                                        <input
                                            class="btn btn-success rounded-pill"
                                            type="button"
                                            value="save"
                                            @click="addNewData"
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button
                            class="btn btn-block showPayment rounded-pill mt-4"
                            data-bs-toggle="modal"
                            data-bs-target="#paymentDetails"
                        >
                            show payment
                        </button>
                        <div class="modal fade" id="paymentDetails">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1>Payment Deatails</h1>
                                    </div>
                                    <div class="modal-body">
                                        <PaymentDetails />
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn save">
                                            Save changes
                                        </button>
                                        <button
                                            type="button"
                                            class="btn btn-danger close"
                                            data-bs-dismiss="modal"
                                        >
                                            Close
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bottomGrid">
                    <div class="donationHistory">
                        <div class="title d-flex justify-content-between">
                            <h1>Donation History</h1>
                            <a href="#" class="me-5 mt-3">more</a>
                        </div>
                        <div class="caseGrid">
                            <UserCaseCard
                                v-for="Case in cases"
                                :key="Case.id"
                                :id="Case.id"
                                :title="Case.title"
                                :org="Case.organization.title"
                                :goal="Case.goal_amount"
                                :raised="Case.raised_amount"
                                :case-desc="Case.description"
                                :is-favorite="Case.isFavorite"
                                :reminder="Case.reminder"
                                @toggle-favorite="toggleFavoriteStatus"
                                @toggle-reminder="toggleReminderStatus"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style lang="scss" scoped>
@use "../../sass/colors" as *;
* {
    box-sizing: border-box;
}
.mainContainer {
    display: flex;
    justify-content: center;
    width: 100%;
    position: relative;
    scroll-behavior: smooth;

    .dataContainer {
        margin: 130px 0 40px 0;
        max-height: fit-content;
        border: 4px solid $priColor;
        border-radius: 15px;
        width: 1250px;

        .personalInfo {
            color: $priColor;
            h1 {
                font-style: normal;
                font-weight: 500;
                font-size: 48px;
                line-height: 72px;
                letter-spacing: -0.02em;
            }
            h4 {
                font-style: normal;
                font-weight: 500;
                font-size: 24px;
                line-height: 36px;
                letter-spacing: -0.02em;
                i {
                    visibility: hidden;
                    cursor: pointer;
                }
            }
            h4:hover i {
                visibility: visible;
            }
            div i {
                cursor: pointer;
            }
            .addressHeader{
                display: grid;
                grid-template-columns: repeat(2,auto);
                // background-color: $priColor;
                max-width: fit-content;
                i{
                    cursor: pointer;
                    align-self: center;
                }
            }
            .showPayment {
                background-color: $white;
                margin: auto;
                font-weight: 500;
                font-size: 18px;
                color: $priColor;
                letter-spacing: 0.05em;
                transition: 0.25s;
            }
            .showPayment:hover {
                box-shadow: 0px 2px 4px 1px rgba(0, 0, 0, 0.5);
            }
        }

        .bottomGrid {
            .donationHistory {
                .title {
                    h1 {
                        color: $priColor;
                        font-weight: 600;
                        font-size: 36px;
                        line-height: 54px;
                        letter-spacing: -0.02em;
                    }
                    a {
                        color: $priColor;
                        font-weight: 600;
                        font-size: 18px;
                        line-height: 27px;
                        letter-spacing: -0.02em;
                    }
                }
                .caseGrid {
                    display: grid;
                    grid-template-columns: repeat(3, auto);
                    padding: 1em;
                    gap: 4em;
                    justify-content: center;
                }
            }
        }
        .save {
            background-color: $priColor;
            width: fit-content;
            font-weight: normal;
            font-size: 18px;
            border-radius: 50px;
            color: $white;
            letter-spacing: 0.05em;
        }
        .close {
            width: fit-content;
            font-weight: normal;
            font-size: 18px;
            border-radius: 50px;
            color: $white;
            letter-spacing: 0.05em;
        }
    }
    .profPic {
        width: 240px;
        height: 240px;
        margin-top: 20px;
        position: absolute;
        img {
            border-radius: 50%;
            box-shadow: 0px 4px 10px 2px rgba(0, 0, 0, 0.4);
        }
        a {
            font-weight: 400;
            font-size: 18px;
            line-height: 27px;
            letter-spacing: -0.02em;
            color: $priColor;
        }
    }
}
</style>
