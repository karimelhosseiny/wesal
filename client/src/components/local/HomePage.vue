<script>
import Navbar from "../global/Navbar.vue";
import HeroSection from "./HeroSection.vue";
import UserCaseCard from "./UserCaseCard.vue";
export default {
    data() {
        return {
            cases: [
                { id: "1",  title: "Food Aid", org: "Resala" },
                { id: "2", title: "monmy", org: "Masr Elkhair"},
                { id: "3", title: "clothing", org: "Orman" },
                { id: "4", title: "zakah", org: "Baiet Elzakah" },
                { id: "5", title: "clothing", org:"Resala" },
                { id: "6", title: "food", org: "Resala" },
                { id: "7", title: "clothing", org: "Orman" },
                { id: "8", title: "clothi", org: "Resala" },
            ],
        };
    },
    components: { Navbar, HeroSection, UserCaseCard },
};
</script>

<template>
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
                />
                <i class="bi bi-search searchIcon"></i>
            </div>
        </div>
        <div class="caseGrid">
            <UserCaseCard
                v-for="Case in cases"
                :key="Case.id"
                :title="Case.title"
                :org="Case.org"
                :id="Case.id"
            />
        </div>
    </div>
</template>
<style lang="scss" scoped></style>
=======
<style lang="scss" scoped>
@use "../../sass/colors" as *;

.cases {
    .caseTitle {
        display: flex;
        justify-content: space-between;
        h2 {
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
                left: 225px;
                top: 19px;
                cursor: pointer;
                border: none;
                outline: none;
            }
        }
    }
    .caseGrid {
        padding-inline: 1em;
        padding-top: 0.9em;
        display: grid;
        grid-template-columns: repeat(12, auto);
        gap: 20px;
        overflow: auto;
    }
}
</style>
