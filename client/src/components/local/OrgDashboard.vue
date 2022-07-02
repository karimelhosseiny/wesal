<script>
import Navbar from "../global/Navbar.vue";
import OrgHeroSection from "./OrgHeroSection.vue";
import DashboardCard from "./DashboardCard.vue";
import axios from "axios";
export default {
    data() {
        return {
            showModal: false,
            form: {
                title: "",
                goal: "",
                deadline: "",
                description: "",
                category: "",
                org: "",
            },
            orgDataPair: [],
        };
    },
    methods:{
        async addCase() {
            await axios
                .post("http://localhost:8000/api/caseadded", this.form, {
                })
                .then(
                    ({data}) => {
                        console.log(data)
                        this.$router.go("/organizationdashboard");
                    },
                    (err) => console.log(err)
                );
        },
         async fetchOrgData() {
            await axios("http://localhost:8000/api/orgdata").then(
                ({ data }) => {
                    data.organziationWithCases.forEach((org) => {
                        this.orgDataPair.push({
                            id: org.id,
                            title: org.title,
                        });
                    });
                    console.log('data pair: ',this.orgDatapair);
                },
                (err) => {
                    console.log(err);
                }
            );
        },
    },
    mounted(){
        axios.defaults.headers.common["Authorization"] =
            "Bearer " + this.storeToken;
        this.fetchOrgData();
    },
    components: { Navbar, OrgHeroSection, DashboardCard },
};
// line 80 in api.php
// // Organization Controller
// Route::get('organizations', [OrganizationController::class, 'organizations']); // show all organizations form database
// Route::resource('organization', OrganizationController::class)->middleware(['auth:sanctum', 'is_organization']); //to use function show() in organization controller type: http://127.0.0.1:8000/organization/{id}
// Route::post('postorg', [OrganizationController::class, 'store']); //store the  organization requests in database

// Route::post('newcaseadded', [OrganizationController::class, 'orgAddCase'])->middleware(['auth:sanctum', 'is_organization']); //store new case in database
// Route::post('newcaseupdated',[OrganizationController::class, 'orgUpdateCase'])->middleware(['auth:sanctum', 'is_organization']); //store new updatesfor the case in database
// Route::post('anycasedeleted',[OrganizationController::class, 'orgDeleteCase'])->middleware(['auth:sanctum', 'is_organization']); //delete case record from the database

// Route::post('orgprofileupdated',[OrganizationController::class, 'orgUpdateProfile'])->middleware(['auth:sanctum', 'is_organization']); //delete case record from the database
// Route::get('orgdata',[OrganizationController::class, 'orgData']); //show all organizations' data
</script>

<template>
    <Navbar />
    <OrgHeroSection />
    <div class="container">
        <div class="row justify-content-between">
            <i class="add col-3 my-3 fs-1 bi bi-plus-square-fill"
            @click="showModal = true"
            ></i>
            <div v-if="showModal" class="modalOpen">
                        <div
                            class="container editModal shadow-lg p-3 mb-5 bg-body"
                        >
                            <form>
                                <br />
                                <div class="mx-4 row">
                                    <label for="name" class="col-4"
                                        >Title:
                                    </label>
                                    <input
                                        type="text"
                                        name="name"
                                        class="col-8"
                                        v-model="this.form.title"
                                    />
                                </div>
                                <br />
                                <div class="mx-4 row">
                                    <label for="email" class="col-4"
                                        >Goal:
                                    </label>
                                    <input
                                        type="number"
                                        name="email"
                                        class="col-8"
                                        v-model="this.form.goal"
                                    />
                                </div>
                                <br />
                                <div class="mx-4 row">
                                    <label for="phone" class="col-4"
                                        >Deadline:
                                    </label>
                                    <input
                                        type="date"
                                        name="phone"
                                        class="col-8"
                                        v-model="this.form.deadline"
                                    />
                                </div>
                                <br />
                                <div class="mx-4 row">
                                    <label for="phone" class="col-4"
                                        >Description:
                                    </label>
                                    <textarea
                                        style="resize: none"
                                        rows="6"
                                        type="textarea"
                                        name="address"
                                        class="col-8"
                                        v-model="this.form.description"
                                    />
                                </div>
                                <br />
                                <div class="mx-4 row">
                                    <label for="type" class="col-4"
                                        >Category:
                                    </label>
                                    <select
                                        name="type"
                                        class="col-8"
                                        v-model="this.form.category"
                                    >
                                        <option disabled selected value="">
                                            select Category
                                        </option>
                                        <option value="1">Food</option>
                                        <option value="2">Clothes</option>
                                        <option value="3">Sick</option>
                                        <option value="4">Sadaka</option>
                                    </select>
                                </div>
                                <br />
                                <div class="mx-4 row">
                                    <label for="organization" class="col-4"
                                        >Organization:
                                    </label>
                                    <select
                                        name="organization"
                                        class="col-8"
                                        v-model="this.form.org"
                                    >
                                        <option disabled selected value="">
                                            select Organization
                                        </option>
                                        <option v-for="org in orgDataPair" :value="org.id">
                                            {{ org.title }}
                                        </option>
                                    </select>
                                </div>
                                <br />
                                <div class="m-4 row justify-content-around">
                                    <button
                                        @click="showModal = false"
                                        class="btn btn-danger col-3"
                                    >
                                        Close
                                    </button>
                                    <button
                                        class="btn btn-success col-3"
                                        @click.prevent="addCase"
                                    >
                                        Add
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
            <h2 class="col-3 text-center">Current cases</h2>
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
    <!-- <div class="caseGrid">
        <DashboardCard />
        <DashboardCard />
        <DashboardCard />
        <DashboardCard />
        <DashboardCard />
    </div> -->
</template>

<style lang="scss" scoped>
@use "../../sass/colors" as *;
.add {
    width: fit-content;
    color: $priColor;
    cursor: pointer;
}
h2 {
    border-bottom: 0.1em solid $priColor;
    font-family: "Poppins";
    font-style: normal;
    font-weight: 600;
    font-size: 36px;
    line-height: 80px;
    letter-spacing: -0.02em;
    color: $priColor;
}
.modalOpen {
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgb(0, 0, 0);
        background-color: rgba(0, 0, 0, 0.4);
    }
    .editModal {
        background-color: #fefefe;
        margin: 10% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 50%;
        border-radius: 25px;
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
