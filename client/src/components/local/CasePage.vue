<script>
import SlideShow from "./SlideShow.vue";
import Navbar from "../global/Navbar.vue"
import CaseDonation from "./CaseDonation.vue";
import axios from "axios";
export default {
    components: { SlideShow, Navbar, CaseDonation },
    data() {
        return {
            caseName: '',
            organization: '',
            category: '',
            desc: '',
            goal: 0,
            raised: 0,
            totalDonors: 0,
            imgUrl: 'https://api.unsplash.com/search/photos/?query="charity donations"&count=1&per_page=3&w=1440&h=400&dpr=2&orientation=landscape&client_id=ThnOH88dogJ-2LqnyjhKV79EAde8r-tna--nKq9mKAA',
            caseImgs: [],
            //case id acquired from page route, used to call api with
            caseId: this.$route.params.id
        };
    },
    mounted() {
        this.fetchData()

    },
    methods: {

        fetchData() {
            //fetching case data
            axios(`http://localhost:8000/api/casepage/${this.caseId}`, {
                mode: "no-cors",
                headers: {
                    "Access-Control-Allow-Origin": "*",
                    "Content-Type": "application/json",
                },
            })
                .then((res) => {
                    const caseData = res.data
                    this.caseName = caseData.case.title
                    this.organization = caseData.organizationtitle
                    this.category = caseData.categorytitle
                    this.desc = caseData.case.description
                    this.goal = caseData.case.goal_amount
                    this.raised = caseData.case.raised_amount
                    this.totalDonors = caseData.totaldonors
                })
                .catch(err => console.log(err))

            //fetching case imgs
            axios(this.imgUrl, {
                mode: 'no-cors',
                headers: {
                    "Access-Control-Allow-Origin": "*",
                    "content-type": "application/json",
                }
            })
                .then((res) => {
                    const results = res.data.results
                    results.forEach(result => {
                        this.caseImgs.push(result.urls.regular)
                    });
                })
                .catch((e) => console.log(e))
        }
    },

};
</script>

<template>
    <div>
        <Navbar />
        <div class="container">
            <div class="row justify-content-center">
                <div class="col">
                    <div class="upper">
                        <h1>{{ caseName }}</h1>
                        <a href="#" class="ms-5">{{ organization }}</a>
                    </div>
                </div>
            </div>
            <div class="slideShow row">
                <SlideShow :imgLinksList="caseImgs" />
            </div>
            <div class="row">
                <div class="col-6">
                    <img src="../../assets/SVG/GirlsClothesVector.svg" alt="Charity" />
                    <div class="progressBar">
                        <div class="ammount mt-3 px-2 d-flex justify-content-between">
                            <span>
                                {{ raised }}
                                <sub>egp</sub>
                            </span>
                            <span>
                                {{ goal }}
                                <sub>egp</sub>
                            </span>
                        </div>
                        <progress class="bar bg-transparent" :value="raised" :max="goal"></progress>
                    </div>
                </div>
                <div class="caseDesc col-6">
                    <div class="container align-items-end">
                        <div class="row align-self-end">
                            <p class="col">
                                {{ desc }}
                            </p>
                        </div>
                        <div class="endSec row align-items-end">
                            <div class="col-9">
                                <p>
                                    Total donors:
                                    <span>400</span>
                                </p>
                            </div>
                            <div class="col-3 donate">
                                <button class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#caseDonation">Donate
                                    now</button>
                                <div class="modal" id="caseDonation">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <div class="d-flex flex-column w-content">
                                                    <h1 class="modal-title">Case name</h1>
                                                    <h4>Resala . Feeding</h4>
                                                </div>
                                                <button class="btn-close mb-5" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <CaseDonation />
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn confirm">confirm</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style lang="scss" scoped>
@use "../../sass/colors"as *;

.upper {
    width: fit-content;
    margin: 0 auto;

    h1 {
        margin-top: 0.5em;
        color: $priColor;
    }

    a {
        text-decoration: none;
        color: $priColor;
        margin: 0 auto;
        padding: 0 25%;
    }
}

.slideShow {
    margin-bottom: 2em;
}

.caseDesc {
    margin-bottom: 1em;
    border-left: 0.2em solid $priColor;
    padding: 2em 0;

    .col-9 p {
        margin: 0.7em 0;
        margin-top: 80px;
        color: $priColor;

        span {
            border: 0.01em solid $priColor;
            border-radius: 0.5em;
            margin: 0.5em;
            padding: 0.2em;
        }
    }

    .endSec {
        button {
            width: 200px;
            background-color: $priColor;
            border-radius: 2em;
        }

        .donate {
            .btn-close {
                width: auto;
                background-color: transparent;
                color: red !important;
            }

            .confirm {
                color: $white;
                margin: 0 auto;
                width: fit-content;
                font-size: large;
                padding-inline: 1.5rem;
                font-weight: 400;
                letter-spacing: 0.05em;
                box-shadow: 0px 2px 2px 1px rgba(0, 0, 0, 0.2);
            }

            .confirm:focus {
                background-color: #064234;
                box-shadow: none
            }

            .modal-content {
                padding-inline: 1em;

                .modal-header {
                    color: $priColor;

                    h4 {
                        font-weight: 400;
                        font-size: 18px;
                    }
                }
            }
        }
    }
}

img {
    margin: 0 15%;
    width: 427.5px;
    height: 250px;
}

.progressBar {
    width: 550px;
    margin-bottom: 1em;

    .bar[value]::-webkit-progress-bar {
        height: 20px;
        width: 550px;
        border-radius: 10px;
        margin-top: 7px;
        background-color: #ccc;
    }

    .bar[value]::-webkit-progress-value {
        background-color: $priColor;
        border-radius: 10px;
    }

    span {
        color: $priColor;
    }
}
</style>
