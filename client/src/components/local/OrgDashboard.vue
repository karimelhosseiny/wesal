<script>
import Navbar from "../global/Navbar.vue";
import OrgHeroSection from "./OrgHeroSection.vue";
import DashboardCard from "./DashboardCard.vue";
export default {
    data() {
        return {};
    },
    components: { Navbar, OrgHeroSection, DashboardCard },
};
</script>

<template>
    <Navbar />
    <OrgHeroSection />
    <div class="container">
        <div class="row justify-content-between">
            <h2 class="col-3">Current cases</h2>
            <div class="searchContainer col-4">
                <input
                    class="rounded-pill"
                    type="text"
                    placeholder="search cases"
                    v-model="search"
                />
                <i class="bi bi-search searchIcon"></i>
            </div>
        </div>
    </div>
    <div class="caseGrid">
        <DashboardCard />
        <DashboardCard />
        <DashboardCard />
        <DashboardCard />
        <DashboardCard />
    </div>
</template>

<style lang="scss" scoped>
@use "../../sass/colors" as *;
h2 {
    border-bottom: 0.1em solid $priColor;
    font-family: "Poppins";
    font-style: normal;
    font-weight: 600;
    font-size: 36px;
    line-height: 54px;
    letter-spacing: -0.02em;
    color: $priColor;
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
.caseGrid {
    padding-inline: 1em;
    padding: 1em 0;
    display: grid;
    justify-content: center;
    grid-template-columns: repeat(4, auto);
    gap: 20px;
    overflow: auto;
    margin-top: 1em;
}
</style>
