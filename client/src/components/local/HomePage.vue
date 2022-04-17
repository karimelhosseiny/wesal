<script>
import axios from "axios";
import Navbar from "../global/Navbar.vue";
import HeroSection from "./HeroSection.vue";
import UserCaseCard from "./UserCaseCard.vue";
export default {
    data() {
        return {
            search: "",
            filteredCards: "",
            cases: [],
        };
    },
    components: { Navbar, HeroSection, UserCaseCard },
    computed: {
        filteredCards() {
            return this.cases.filter((Case) =>
                Case.title.toLowerCase().includes(this.search.toLowerCase())
            );
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
                    if(response.statusText == 'OK'){
                        return JSON.parse(response.data.cases);;

                    }
                }).then((data) => {
                     var cases = [];
                    for(let index in data){
                        cases.push({
                            id: data[index].id,
                            title: data[index].title,
                            goal: data[index].goal_amount,
                            raised: data[index].raised_amount,
                            pic: data[index].image,
                            org: "Resala",
                            caseDesc: data[index].description,

                        })
                    }
                    this.cases = cases;
                });
        },
    },
    mounted() {
        this.getCases();
    }
};
</script>

<template>
    <div>
        <Navbar />
    <HeroSection />
    <div class="cases container-fluid">
        <div class="caseTitle">
            <h2>Give Little get more</h2>
            <div class="searchContainer">
                <input
                    class="rounded-pill"
                    type="text"
                    placeholder="search cases"
                    v-model="search"
                />
                <i class="bi bi-search searchIcon"></i>
            </div>
        </div>
        <div class="caseGrid">
            <p
                v-show="filteredCards == '' "
                class="SearchNotFound h1 opacity-50"
            >
                Oh oh, we couldn`t find that!
            </p>
            <UserCaseCard
                v-for="Case in filteredCards"
                :key="Case.id"
                :pic="Case.pic"
                :title="Case.title"
                :org="Case.org"
                :id="Case.id"
                :case-desc="Case.caseDesc"
                :raised="Case.raised"
                :goal="Case.goal"
                :is-favorite="Case.isFavorite"
                :reminder="Case.reminder"
                @toggle-favorite="toggleFavoriteStatus"
                @toggle-reminder="toggleReminderStatus"
            />
        </div>
    </div>
    </div>
</template>
<style lang="scss" scoped>
@use "../../sass/colors" as *;

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
</style>
