<script>
import axios from "axios";
import Navbar from "../global/Navbar.vue";
import OrganizationCard from "./OrganizationCard.vue"
import { useUserStore } from "../../store/UserStore";
import { mapWritableState, mapStores } from "pinia";

export default {
    data() {
        return {
            orgs:[]
        };
    },
    methods: {},
    computed: {
        
    },
    mounted() {
        axios('http://localhost:8000/api/orgdata').then(({data})=>{
            this.orgs = data.organziationWithCases;
        },(err)=>{
            console.log(err);
        })
    },
    created() {},
    components: { Navbar, OrganizationCard },
};
</script>

<template>
    <Navbar />
    <div class="orgGrid">
        <OrganizationCard v-for="(org,index) in orgs"
                :key="index"
                :id="org.id"
                :title="org.title"
                :totalCases="org.totalcases"
                totalDonations="static"
                totalDonors="static"
        />
    </div>

</template>

<style lang="scss" scoped>
@use "../../sass/colors" as *;
.orgGrid{
        grid-template-columns: repeat(3,auto);
        padding-inline: 1em;
        padding: 1em 0;
        display: grid;
        justify-content: center;
        gap: 20px;
        overflow: auto;
}
</style>
