<script>
import axios from "axios";
import Navbar from "../global/Navbar.vue";
import OrganizationCard from "./OrganizationCard.vue"
import { useUserStore } from "../../store/UserStore";
import { mapWritableState, mapStores } from "pinia";

export default {
    data() {
        return {};
    },
    computed: {},
    methods: {},
    mounted() {},
    created() {},
    components: { Navbar, OrganizationCard },
};
</script>

<template>
    <Navbar />
    <div class="grid">
        <div class="orgGrid">
            <OrganizationCard  />
            <OrganizationCard  />
            <OrganizationCard  />
            <OrganizationCard  />
            <OrganizationCard  />
            <OrganizationCard  />
            <OrganizationCard  />
            <OrganizationCard  />
            <OrganizationCard  />
        </div>
    </div>

</template>

<style lang="scss" scoped>
@use "../../sass/colors" as *;
.orgGrid{
    padding-inline: 1em;
        padding: 1em 0;
        display: grid;
        justify-content: center;
        grid-template-columns: repeat(3, auto);
        gap: 20px;
        overflow: auto;
}
</style>
