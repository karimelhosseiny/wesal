<script>
import { useUserStore } from "../../store/UserStore";
import { mapStores, mapWritableState } from "pinia";
import axios from "axios";
export default {
    data() {
        return {
            lastDonation: "",
            lastAmount: 0,
            lastCaseId: 0,
        };
    },
    created() {
        this.getUserDonations();
    },
    methods: {
        async getUserDonations() {
            await axios(`http://localhost:8000/api/userhomepage/1`, {
                mode: "no-cors",
                headers: {
                    "Access-Control-Allow-Origin": "*",
                    "Content-Type": "application/json",
                },
            })
                .then(({ data }) => {
                    if (data.lastDonation) {
                        this.lastDonation = data.lastdonation.title;
                        this.lastAmount = data.lastdonation.pivot.amount;
                        this.lastCaseId = data.lastdonation.pivot.case_id;
                    }
                    else{
                        this.lastDonation = 'no donations yet'
                        this.lastAmount = 0
                        this.lastCaseId = null
                    }
                })
                .catch((e) => alert(e));
        },
    },
    computed: {
        ...mapStores(useUserStore),
        ...mapWritableState(useUserStore, {
            user: "currentUser",
            storeToken: "token",
        }),
    },
};
</script>

<template>
    <div class="hero">
        <div class="img-fluid">
            <div class="text">
                <h1>Hello, {{ this.user.name.split(" ")[0] }}</h1>
                <h4>
                    total donations: 400
                    <sub>egp</sub>
                </h4>
                <h4 v-if="this.lastDonation=='no donations yet'">
                Start donating to view last case
                </h4>
                <h4 v-else>
                    last donation:
                    <router-link :to="'/casepage/' + lastCaseId">{{
                        this.lastDonation
                    }}</router-link>
                    - {{ this.lastAmount }}
                    <sub>egp</sub>
                </h4>
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
