<script>
export default {
    props: [
        "pic",
        "title",
        "org",
        "id",
        "caseDesc",
        "goal",
        "raised",
        "isFavorite",
        "reminder",
        "cat",
    ],
    emits: ["toggle-favorite", "toggle-reminder"],
    data() {
        return {};
    },
    methods: {
        ChangingHeartIcons() {
            this.$emit("toggle-favorite", this.id);
        },
        ChangingcalendertIcons() {
            this.$emit("toggle-reminder", this.id);
        },
    },
};
</script>

<template>
    <div class="card p-2 container">
        <div class="top">
            <img
                src="../../assets/7maya.png"
                class="mx-2 mt-2"
                alt="Organization image"
            />
            <a class="org mt-2">Resala</a>
        </div>
        <div class="mid container row justify-content-center">
            <div class="row">
                <span class="target col-5">Total cases:</span>
                <span class="col-6">
                    20
                    <sub>Case</sub>
                </span>
                <div class="row">
                    <span class="target col-7">Total donations:</span>
                    <span class="col-5">
                        20000
                        <sub>EGP</sub>
                    </span>
                </div>
                <div class="row">
                    <span class="target col-6">Total donors:</span>
                    <span class="col-6">
                        20000
                        <sub>Donor</sub>
                    </span>
                </div>
            </div>
        </div>
        <div class="bottom row justify-content-center">
            <router-link
                :to=" '/casepage/' + this.id"
                class="col-6 btn btn-block more rounded-pill text-decoration-none text-light"
                >Visit Profile</router-link
            >
        </div>
    </div>
</template>

<style lang="scss" scoped>
@use "../../sass/colors" as *;

$logoSize: 80px;
.card {
    width: 380px;
    height: 350px;
    margin: 20px;
    outline: none;
    border: none;
    background: white;
    border-radius: 22px;
    box-shadow: 0px 0px 21px rgba($color: #000000, $alpha: 0.2);

    .top {
        display: grid;
        gap: 40px;
        grid-template-columns: 20% 80%;
        justify-content: space-between;
        img {
            grid-column: 1;
            width: $logoSize;
            height: $logoSize;
            border-radius: 50%;
            border: 2px solid $priColor;
        }

        .org {
            grid-column: 2;
            width: fit-content;
            text-decoration: none;
            font-size: 30px;
            font-weight: 600;
            color: $priColor;
            cursor: pointer;
            &:hover {
                text-decoration: underline;
            }
        }
    }
    .mid {
        margin-top: 10px;
        padding: 1.3em;
        color: $priColor;
        p {
            width: 252.5px;
            height: 50px;
            color: black;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .target {
            margin-bottom: 1em;
            font-weight: 600;
        }

        span {
            font-weight: 800;
        }
    }
    .bottom {
        margin-left: 2px;
        max-width: 100%;
        overflow: hidden;
        margin-top: 0.5em;
        .more {
            background-color: $priColor;
            width: 60%;
            font-weight: bold;
            font-size: 24px;
            color: $white;
            letter-spacing: 0.05em;
        }
    }
}
</style>
