<script>
import { useUserStore } from "../../store/UserStore";
import { mapStores, mapWritableState } from "pinia";
import axios from "axios";
export default {
    data() {
        return {
            totalDonations: 0,
            casesData:[],
            totalCases:0
        };
    },
    methods: {
       async getOrgData(){
        await axios('http://localhost:8000/api/orgdata')
        .then(({data})=>{
            const orgArray = data.organziationWithCases.filter(org=>org.title==this.User.name);
            console.log(orgArray);
            this.totalCases = orgArray[0].totalcases;
            this.casesData = orgArray[0].casesdata;
            this.casesData.forEach(Case => {
                this.totalDonations += Case.raised_amount;
            });
        },
        (err)=>{console.log(err)}
        )
        }
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
};
</script>

<template>
    <div class="hero">
        <div class="img-fluid">
            <div class="text">
                <h1 class="mb-4">Hello, {{this.User.name}}</h1>
                <h4 v-if="this.totalDonations==0">total donations: 0 <sub>egp</sub>(no donations)</h4>
                <h4 v-else>total donations: {{this.totalDonations}} <sub>egp</sub></h4>
                <h4 v-if="this.totalCases==0">total Cases: 0<sub>case</sub></h4>
                <h4 v-else>total Cases: {{this.totalCases}} <sub>case</sub></h4>
            </div>
        </div>
    </div>
</template>

<style lang="scss" scoped>
$white: #edf0f2;

.hero {
    width: 100%;

    .img-fluid {
        height: 305px;
        background: linear-gradient(
                180deg,
                rgba(31, 58, 51, 0.6) 23.44%,
                rgba(255, 255, 255, 0) 100%
            ),
            url(../../assets/heroImage.png) no-repeat;
        background-size: 100vw 100%;

        .text,
        * > * {
            color: $white;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .text {
            margin-left: 24px;

            h1 {
                font-weight: 600;
                font-size: 72px;
                line-height: 108px;
                letter-spacing: -0.02em;
            }

            h4 {
                font-style: normal;
                font-weight: 500;
                font-size: 24px;
                line-height: 36px;
                letter-spacing: -0.02em;

                sub {
                    display: inline;
                    margin-left: -2px;
                }
            }
        }
    }
}
</style>
