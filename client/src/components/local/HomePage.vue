<script>
import axios from "axios";
import Navbar from "../global/Navbar.vue";
import HeroSection from "./HeroSection.vue";
import UserCaseCard from "./UserCaseCard.vue";
import { mapStores, mapWritableState, mapActions, mapState } from 'pinia';
import { useUser } from "../../store/UserStore";

export default {
    data() {
        return {
            isLoading: true,
            search: "",
            filteredCards: "",
            cases: [],
            filteredCategory: "",
            referance: "0",
            calcShown: false,
            amount: null,
            calculatedZakah: 0
        };
    },
    components: { Navbar, HeroSection, UserCaseCard },
    computed: {
        ...mapStores(useUser),
        ...mapState(useUser,['user']),
        filteredCards() {
            return this.cases.filter((Case) =>
                Case.title.toLowerCase().includes(this.search.toLowerCase())
            );
        },
        filteredCategory() {
            return this.cases.filter((Case) => Case.cat === parseInt(this.referance));
        },
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
        getCases() {
            axios
                .get("http://localhost:8000/api/cases", {
                    mode: "no-cors",
                    headers: {
                        "Access-Control-Allow-Origin": "*",
                        "Content-Type": "application/json",
                    },
                })
                .then((response) => {
                    if (response.statusText == "OK") {
                        this.isLoading = false;
                        return response.data.cases;
                    }
                })
                .then((data) => {
                    var cases = [];
                    for (let index in data) {
                        cases.push({
                            id: data[index].id,
                            title: data[index].title,
                            goal: data[index].goal_amount,
                            raised: data[index].raised_amount,
                            pic: data[index].image,
                            org: data[index].organization.title,
                            cat: data[index].category_id,
                            caseDesc: data[index].description,
                        });
                    }
                    this.cases = cases;
                });
        },
        toggleCalculator() {
            this.calcShown = !this.calcShown
        },
        calcZakah() {
            this.amount !== null ? this.calculatedZakah = this.amount * (2.5 / 100) : 0
        }
    },
    created() {
        this.getCases();
    },
};
</script>

<template>
    <div>
        <Navbar />
        <div :class="['zakahFloat', 'rounded', 'position-absolute', { 'expanded': calcShown }]">
            <i class="bi bi-caret-left-fill h2"></i>
            <i @click="toggleCalculator" class="bi bi-calculator-fill h3 mt-1"></i>
            <h4 class="ms-2 mt-1">Zakah Calculator</h4>
            <div class="controls">
                <input :class="['rounded-pill', { 'marginFix': !calcShown }]" type="number" placeholder="amount"
                    v-model="amount" />
                <div :class="['zakahValue', { 'marginFix': !calcShown }]">
                    <h1 class="text-center">Zakah:</h1>
                    <p>{{ calculatedZakah }}<sub class="h6">egp</sub></p>
                </div>
                <button @click="calcZakah" class=" btn btn-success rounded rounded-pill">calculate</button>
            </div>
        </div>
        <HeroSection />
        <div class="cases container-fluid">
            <div class="caseTitle">
                <div class="categories">
                    <div class="btn-group pt-2">
                        <button class="btn btn-success btn-sm" type="button">
                            <i class="h1 bi bi-filter-circle"></i>
                        </button>
                        <select class="btn btn-sm btn-success dropdown-toggle" aria-expanded="false"
                            v-model="referance">
                            <option value="0">All categories</option>
                            <option value="1">Food</option>
                            <option value="2">Clothes</option>
                            <option value="3">Sick</option>
                            <option value="4">Sadaka</option>
                        </select>
                    </div>
                </div>
                <h2>Give Little get more</h2>
                <div class="searchContainer">
                    <input class="rounded-pill" type="text" placeholder="search cases" v-model="search" />
                    <i class="bi bi-search searchIcon"></i>
                </div>
            </div>
            <div v-if="isLoading" class="text-center my-5">
                <div class="spinner-grow mx-5 text-success" style="width: 10rem; height: 10rem" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
            <div v-else class="caseGrid">
                <p v-show="filteredCards == ''" class="SearchNotFound h1 opacity-50">
                    Oh oh, we couldn`t find that!
                </p>
                <UserCaseCard v-if="referance == 0" v-for="Case in filteredCards" :key="Case.id" :pic="Case.pic"
                    :title="Case.title" :org="Case.org" :id="Case.id" :case-desc="Case.caseDesc" :raised="Case.raised"
                    :goal="Case.goal" :is-favorite="Case.isFavorite" :reminder="Case.reminder"
                    @toggle-favorite="toggleFavoriteStatus" @toggle-reminder="toggleReminderStatus" />
                <UserCaseCard v-else v-for="Case in filteredCategory" :pic="Case.pic" :title="Case.title"
                    :org="Case.org" :id="Case.id" :case-desc="Case.caseDesc" :raised="Case.raised" :goal="Case.goal"
                    :is-favorite="Case.isFavorite" :reminder="Case.reminder" @toggle-favorite="toggleFavoriteStatus"
                    @toggle-reminder="toggleReminderStatus" />
            </div>
        </div>
    </div>
</template>
<style lang="scss" scoped>
@use "../../sass/colors"as *;

.zakahFloat {
    display: grid;
    grid-template-columns: repeat(2, 10%) 85%;
    grid-template-rows: 10% 90%;
    row-gap: 10px;
    padding-top: 9px;
    margin-left: 80.9rem;
    margin-top: 3%;
    height: 50px;
    width: 21%;
    z-index: 90;
    background-color: $white;
    transition: 0.4s;
    overflow: hidden;

    i {
        color: $priColor;
        align-self: start;
        grid-row: 1;
    }

    .bi-calculator-fill {
        cursor: pointer;
    }

    h4 {
        grid-row: 1;
        color: $priColor;
        font-weight: 600;
        align-self: start;
    }

    .controls {
        grid-row: 2;
        grid-column: 1/4;
        height: 100%;
        justify-self: stretch;
        overflow: hidden;
        display: grid;
        grid-template-rows: 25% 50% 25%;
        row-gap: 5px;

        input {
            margin-top: 16px;
            border: none;
            // transition: 0.001s;
            color: $priColor;
            filter: drop-shadow(0px 1px 4px rgba(0, 0, 0, 0.25));
            padding-left: 1.5em;
            border: 1px solid transparent;
            outline: none;
            font-weight: 500;
            width: 250px;
            grid-row: 1;
            justify-self: center;
            align-self: center;
        }

        .zakahValue {
            grid-row: 2;
            display: grid;
            color: $priColor;
            justify-self: center;
            transition: 0.1s;

            p {
                font-size: 4rem;
                justify-self: center;
            }
        }

        button {
            grid-row: 3;
            justify-self: center;
            align-self: start;
            background-color: $white;
            color: $priColor;
            border: none;
            box-shadow: 0px 2px 4px 1px rgba(0, 0, 0, 0.2);

            &:hover {
                box-shadow: 0px 1px 2px 5px rgba($color: $priColor, $alpha: .5);
            }
        }
    }

    &:hover {
        margin-left: 67rem;

    }
}

.expanded {
    height: 350px;
    z-index: 90;
    margin-left: 67rem;
}

.marginFix {
    transform: translateY(50px);
}

.spin {
    margin: 0 auto;
}

.cases {
    background-color: white;

    .caseTitle {
        display: flex;
        justify-content: space-between;
        padding: 1em;

        h2 {
            border-bottom: 0.1em solid $priColor;
            font-family: "Poppins";
            font-style: normal;
            font-weight: 600;
            font-size: 36px;
            line-height: 54px;
            letter-spacing: -0.02em;
            color: $priColor;
            margin-top: 0.2em;
        }

        .searchContainer {
            // background: red;
            margin-top: 0.2em;
            position: relative;
            width: 280px;
            height: 44.83px;

            input {
                margin-left: 40px;
                margin-top: 16px;
                border: none;
                filter: drop-shadow(0px 1px 4px rgba(0, 0, 0, 0.25));
                padding-left: 1.5em;
                border: 1px solid transparent;
                outline: none;
                font-weight: 300;
            }

            input:hover {
                border: 1px solid $secColor;
            }

            .searchIcon {
                position: absolute;
                color: #57ce8d;
                font-size: 16px;
                left: 210px;
                top: 19px;
                cursor: pointer;
                border: none;
                outline: none;
            }
        }

        .categories {
            width: 280px;

            button,
            select {
                background-color: $priColor;
            }

            option {
                color: white;
            }
        }
    }

    .caseGrid {
        padding-inline: 1em;
        padding: 1em 0;
        display: grid;
        justify-content: center;
        grid-template-columns: repeat(4, auto);
        gap: 20px;
        overflow: auto;

        .SearchNotFound {
            height: 70vh;
        }
    }
}

::-webkit-scrollbar-thumb:horizontal {
    width: 0;
}
</style>
