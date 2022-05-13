<script>
import Navbar from "../global/Navbar.vue";
export default {
    data() {
        return {};
    },
    components: { Navbar },
};
</script>

<template>
    <div>
        <Navbar />
        <div class="my-5 cards">
            <div class="mx-3 first-card card" style="width: 18rem">
                <h1>2000</h1>
                <h2>user</h2>
            </div>
            <div class="mx-3 second-card card" style="width: 18rem">
                <h1>743</h1>
                <h2>ben. case</h2>
            </div>
            <div class="mx-3 third-card card" style="width: 18rem">
                <h1>40000</h1>
                <h1>raised</h1>
            </div>
        </div>
        <div class="shadow-lg card container dashboard">
            <div class="row justify-content-between">
                <h2 class="col-2">Users Data</h2>
                <div class="col-2 searchContainer">
                    <input
                        class="rounded-pill"
                        type="text"
                        placeholder="search"
                        v-model="search"
                    />
                    <i class="bi bi-search searchIcon"></i>
                </div>
            </div>
        </div>
    </div>
</template>

<style lang="scss">
@use "../../sass/colors" as *;
.cards {
    display: flex;
    justify-content: center;
    div {
        width: 200px;
        height: 150px;
        text-align: center;
        border-radius: 15px;
        box-shadow: 0px 0px 21px rgba($color: #000000, $alpha: 0.2);
        h1,
        h2 {
            color: white;
        }
    }
    .first-card {
        background-color: $priColor;
        color: white;
        padding: 15px;
    }
    .second-card {
        border: 2px solid $priColor;
        h1,
        h2 {
            color: $priColor;
        }
        padding: 15px;
    }
    .third-card {
        background-color: $specialColor;
        color: white;
        padding: 15px;
    }
}
.dashboard {
    h2{
        color:$priColor
    }
    .searchContainer {
        margin-top: 0.2em;
        position: relative;
        width: 280px;
        height: 44.83px;

        input {
            margin-left: 40px;
            margin-top: 10px;
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
            left: 235px;
            top: 13px;
            cursor: pointer;
            border: none;
            outline: none;
        }
    }
}

</style>
