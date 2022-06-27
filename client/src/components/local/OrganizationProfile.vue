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
            orgTitle: "",
            orgPhoneNumber: "",
            orgDesc: "",
            orgCases: [],
        };
    },
    mounted() {
        axios.defaults.headers.common["Authorization"] =
            "Bearer " + this.storeToken;
        this.getOrgData();
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
            const res = await axios(
                `http://localhost:8000/api/userhomepage/${this.user.id}`,
                {
                    mode: "no-cors",
                    headers: {
                        "Access-Control-Allow-Origin": "*",
                        "Content-Type": "application/json",
                    },
                }
            );
            return res;
        },
        async getOrgData() {
            await axios(
                `http://localhost:8000/api/orghomepage/${this.$route.params.id}`
            ).then(
                ({ data }) => {
                    this.orgTitle = data.organization.title;
                    this.orgPhoneNumber = data.organization.phonenumber;
                    this.orgDesc = data.organization.description;
                    this.orgCases = data.organization.orgcases;
                },
                (err) => {
                    console.log("OrgData fetch err: ", err);
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
                <!-- <div class="d-flex justify-content-between px-5 mt-4">
                <a href="#" class>upload</a>
                <a href="#">remove</a>
            </div> -->
            </div>
            <div class="dataContainer py-5 px-4">
                <div class="personalInfo">
                    <h1>{{ this.orgTitle }}</h1>
                    <div class="px-4">
                        <h3 class="fw-normal">about</h3>
                        <div class="about w-50 rounded p-4 mb-5">
                            <p class="h5 fw-300">
                                {{ this.orgDesc }}
                                Lorem ipsum dolor sit amet, consectetur
                                adipisicing elit. Unde maiores iure vitae
                                excepturi laboriosam voluptates inventore
                                voluptatum sunt molestiae? Nobis!
                            </p>
                        </div>
                        <div>
                            <h3>Phone</h3>
                            <p
                                class="h5 fw-400"
                                v-if="this.orgPhoneNumber != null"
                            >
                                +2{{ this.orgPhoneNumber }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="bottomGrid">
                    <div class="donationHistory">
                        <div class="title d-flex justify-content-between">
                            <h1>Organization Cases</h1>
                        </div>
                        <div
                            class="caseGrid d-flex"
                            v-if="this.orgCases.length > 0"
                        >
                            <UserCaseCard
                                v-for="Case in orgCases"
                                :id="Case.id"
                                :key="Case.id"
                                :title="Case.title"
                                :org="this.orgTitle"
                                :case-desc="Case.description"
                                :goal="Case.goal_amount"
                                :raised="Case.raised_amount"
                                :is-favorite="Case.isFavorite"
                                :reminder="Case.reminder"
                                @toggle-favorite="toggleFavoriteStatus"
                                @toggle-reminder="toggleReminderStatus"
                            />
                        </div>
                        <div class="noCase text-success p-5 w-100" v-else>
                            <h3 class="text-center">no cases yet !</h3>
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
            }
            .about {
                background-color: #f2f2f2;
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
                .noCase {
                    background-color: #f2f2f2;
                }
            }
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
    }
}
</style>
