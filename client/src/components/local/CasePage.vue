<script>
import SlideShow from "./SlideShow.vue";
export default {
    components: { SlideShow },
    data() {
        return {};
    },
};
</script>

<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="upper">
                    <h1>Case name</h1>
                    <a href="#">Organization</a>
                </div>
            </div>
        </div>
        <div class="slideShow row">
            <SlideShow />
        </div>
        <div class="row">
            <div class="col-6">
                <img
                    src="../../assets/SVG/GirlsClothesVector.svg"
                    alt="Charity"
                />
                <div class="progressBar">
                    <div
                        class="ammount mt-3 px-2 d-flex justify-content-between"
                    >
                        <span>
                            15500
                            <sub>egp</sub>
                        </span>
                        <span>
                            2200
                            <sub>egp</sub>
                        </span>
                    </div>
                    <progress
                        class="bar bg-transparent"
                        value="15"
                        max="20"
                    ></progress>
                </div>
            </div>
            <div class="caseDisc col-6">
                <div class="container align-items-end">
                    <div class="row align-self-end">
                        <p class="col">
                            Lorem ipsum dolor sit amet consectetur adipisicing
                            elit. Libero illo vel, aliquid corrupti dignissimos,
                            atque voluptatibus est facere eius rem adipisci
                            suscipit fuga, beatae cumque quidem quo officiis
                            ullam provident. Lorem ipsum dolor sit amet consectetur adipisicing
                            elit. Libero illo vel, aliquid corrupti dignissimos,
                            atque voluptatibus est facere eius rem adipisci
                            suscipit fuga, beatae cumque quidem quo officiis
                            ullam provident. Lorem ipsum dolor sit amet consectetur adipisicing
                            elit. Libero illo vel, aliquid corrupti dignissimos,
                            atque voluptatibus est facere eius rem adipisci
                            suscipit fuga, beatae cumque quidem quo officiis
                            ullam provident. Lorem ipsum dolor sit amet consectetur adipisicing
                            elit. Libero illo vel, aliquid corrupti dignissimos,
                            atque voluptatibus est facere eius rem adipisci
                            suscipit fuga, beatae cumque quidem quo officiis
                            ullam provident.
                        </p>
                    </div>
                    <div class="endSec row align-items-end">
                        <div class="col-9">
                            <p>Total donors: <span>400</span></p>

                        </div>
                        <div class="col-3">
                            <button class="btn btn-success">Donate now</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style lang="scss" scoped>
@use "../../sass/colors" as *;
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
.caseDisc {
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
    }
}
img{
    margin: 0 15% ;
    width:  427.5px;
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
