<script>
import Navbar from '../global/Navbar.vue'
import UserCaseCard from '../local/UserCaseCard.vue'
import PaymentDetails from './PaymentDetails.vue'
import { mapState, mapStores, mapWritableState } from 'pinia'
import { useUserStore } from '../../store/UserStore'
import axios from 'axios'
export default {
    data() {
        return {
            cases: [
                {
                    id: "1",
                    title: "Food Aid",
                    org: "Resala",
                    caseDesc:
                        "1Lorem ipsum dolor sit amet consectetur adipisicing elit.",
                    isFavorite: false,
                    reminder: false,
                },
                {
                    id: "2",
                    title: "monmy",
                    org: "Masr Elkhair",
                    caseDesc:
                        "2Lorem ipsum dolor sit amet consectetur adipisicing elit.",
                    isFavorite: false,
                    reminder: false,
                },
                {
                    id: "3",
                    title: "clothing",
                    org: "Orman",
                    caseDesc:
                        "3Lorem ipsum dolor sit amet consectetur adipisicing elit.",
                    isFavorite: false,
                    reminder: false,
                }
            ]
        }
    },
    computed: {
        ...mapStores(useUserStore),
        ...mapWritableState(useUserStore, {
            user: "currentUser",
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
        async getUserCases(){
            const res = await axios(`http://localhost:8000/api/userhomepage/${this.user.id}`,{
                    mode: "no-cors",
                    headers: {
                        "Access-Control-Allow-Origin": "*",
                        "Content-Type": "application/json",
                    },
                })
            return res
        },
        display(){
            console.log(this.getUserCases())
            alert(this.getUserCases())
        }
    },
    components: { Navbar, UserCaseCard, PaymentDetails }
}

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
                <h1>{{this.user.name}}</h1>
                <div class="px-3">
                    <h4>
                        {{this.user.email}}
                        <i class="bi bi-pencil-square ms-3"></i>
                    </h4>
                    <h4 v-if="this.user.phonenumber!=null">
                        +{{this.user.phonenumber}}
                        <i class="bi bi-pencil-square ms-3"></i>
                    </h4>
                    <h5 v-else class="opacity-50">
                        please add your number
                    </h5>
                    <button
                        class="btn btn-block showPayment rounded-pill"
                        data-bs-toggle="modal"
                        data-bs-target="#paymentDetails"
                    >show payment</button>
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
                                    <button type="button" class="btn save">Save changes</button>
                                    <button
                                        type="button"
                                        class="btn btn-danger close"
                                        data-bs-dismiss="modal"
                                    >Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bottomGrid">
                <div class="donationHistory">
                    <div class="title d-flex justify-content-between">
                        <h1 style="cursor:pointer" @click="display">Donation History</h1>
                        <a href="#" class="me-5 mt-3">more</a>
                    </div>
                    <div class="caseGrid d-flex">
                        <UserCaseCard
                            v-for="Case in cases"
                            :key="Case.id"
                            :title="Case.title"
                            :org="Case.org"
                            :id="Case.id"
                            :case-desc="Case.caseDesc"
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
@use '../../sass/colors' as *;
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
                .close{
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
