<script>
import Navbar from '../global/Navbar.vue'
import UserCaseCard from '../local/UserCaseCard.vue'
import UserCaseCard1 from './UserCaseCard.vue'
export default {
    data() {
        return {
            cases: [
                {
                    id: "1",
                    title: "Food Aid",
                    org: "Resala",
                    caseDisc:
                        "1Lorem ipsum dolor sit amet consectetur adipisicing elit.",
                    isFavorite: false,
                    reminder: false,
                },
                {
                    id: "2",
                    title: "monmy",
                    org: "Masr Elkhair",
                    caseDisc:
                        "2Lorem ipsum dolor sit amet consectetur adipisicing elit.",
                    isFavorite: false,
                    reminder: false,
                },
                {
                    id: "3",
                    title: "clothing",
                    org: "Orman",
                    caseDisc:
                        "3Lorem ipsum dolor sit amet consectetur adipisicing elit.",
                    isFavorite: false,
                    reminder: false,
                }
            ]
        }
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
    },
    components: { Navbar, UserCaseCard, UserCaseCard1 }
}

</script>

<template>
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
                <h1>Youssef Abdulaziz</h1>
                <div class="px-3">
                    <h4>
                        Youssefabdulaziz@gmail.com
                        <i class="bi bi-pencil-square ms-3"></i>
                    </h4>
                    <h4>
                        +201065292537
                        <i class="bi bi-pencil-square ms-3"></i>
                    </h4>
                </div>
            </div>
            <div class="bottomGrid">
                <div class="donationHistory">
                    <div class="title d-flex justify-content-between">
                        <h1>Donation History</h1>
                        <a href="#" class="me-5 mt-3">more</a>
                    </div>
                    <div class="caseGrid d-flex">
                        <UserCaseCard
                            v-for="Case in cases"
                            :key="Case.id"
                            :title="Case.title"
                            :org="Case.org"
                            :id="Case.id"
                            :case-disc="Case.caseDisc"
                            :is-favorite="Case.isFavorite"
                            :reminder="Case.reminder"
                            @toggle-favorite="toggleFavoriteStatus"
                            @toggle-reminder="toggleReminderStatus"
                        />
                    </div>
                </div>
            </div>
            <div class="payment mt-5">
                <h1>
                    Payment details
                    <i class="bi bi-pencil-square h2 ms-5"></i>
                </h1>
                <div class="paymentInfo d-flex flex-column">
                    <label for="nameOnCard">Name on card</label>
                    <input
                        name="nameOnCard"
                        placeholder="JHON DOE"
                        class="rounded-pill"
                        type="text"
                    />
                    <label for="cardNumber">Card number</label>
                    <div class="creditCard">
                        <input
                            name="cardNumber"
                            placeholder="xxxx xxxx xxxx xxxx"
                            class="rounded-pill"
                            type="text"
                        />
                        <img src="../../assets/SVG/mastercard.svg" alt="card type" />
                    </div>
                    <div class="expCvv gap-0">
                        <div class="d-inline">
                            <label class="me-2" for="expdate">exp</label>
                            <input name="expdate" class="rounded-pill me-4" type="text" />
                        </div>
                        <div class="d-inline">
                            <label class="me-2" for="cvv">cvv</label>
                            <input name="cvv" class="rounded-pill" type="text" />
                        </div>
                    </div>
                    <button class="btn btn-block save rounded-pill mb-4">save</button>
                    <div class="otherPayemnts">
                        <p class="mb-2">another payment service?</p>
                        <div class="services px-2 d-flex gap-2">
                            <a href="https://www.paypal.com/" target="blank">
                                <img src="../../assets/SVG/paypal.svg" alt="paypal" />
                            </a>
                            <a href="https://www.paypal.com/" target="blank">
                                <img src="../../assets/SVG/meeza logo.svg" alt="meeza" />
                            </a>
                            <a href="https://www.paypal.com/" target="blank">
                                <img src="../../assets/SVG/fawry pay logo.svg" alt="fawry" />
                            </a>
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
        border-radius: 37px;
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
        .payment {
            color: $priColor;
            i {
                visibility: hidden;
                cursor: pointer;
            }
            h1:hover i {
                visibility: visible;
            }
            .paymentInfo {
                label {
                    color: black;
                    font-style: normal;
                    font-weight: 500;
                    font-size: 18px;
                    line-height: 27px;
                    letter-spacing: -0.02em;
                }
                input {
                    margin-top: 16px;
                    border: none;
                    padding-left: 1.5em;
                    box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.3);
                    border: 1px solid transparent;
                    outline: none;
                    font-weight: 500;
                    color: $priColor;
                    margin-bottom: 20px;
                    width: 20%;
                }
                .creditCard {
                    position: relative;
                    img {
                        position: absolute;
                        top: 14px;
                        left: 190px;
                    }
                }

                .expCvv {
                    input {
                        width: 5%;
                        font-weight: 300;
                        padding-left: 0.5em;
                    }
                }
                //save button
                .save {
                    background-color: $priColor;
                    width: 10%;
                    margin: auto;
                    font-weight: normal;
                    font-size: 18px;
                    color: $white;
                    letter-spacing: 0.05em;
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