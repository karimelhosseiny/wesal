<script>
export default {
    props: ['title', 'org'],
    data() {
        return {

        }
    }
}

</script>

<template>
    <div class="card p-2">
        <div class="top">
            <img src="../../assets/7maya.png" class="ms-3" alt="..." />
            <div class="title ms-2">
                <span class="title">{{ title }}</span>
                <a class="org h6 fw-normal">{{ org }}</a>
            </div>
            <div class="icons">
                <i class="bi bi-heart d-block"></i>
                <i class="bi bi-calendar"></i>
            </div>
        </div>
        <div class="mid">
            <p class="fw-bold">
                Lorem ipsum dolor sit, amet consectetur
                adipisicing elit. Quam, minima.
            </p>
            <span class="target">target:</span>
            <span>
                17700
                <sub>egp</sub>
            </span>
            <div class="progressBar">
                <div class="ammount mt-3 d-flex justify-content-between px-2">
                    <span>
                        15500
                        <sub>egp</sub>
                    </span>
                    <span>
                        2200
                        <sub>egp</sub>
                    </span>
                </div>
                <progress  class="bar text-primary" value="15500" max="17700"></progress>
            </div>
        </div>
        <div class="bottom">
            <button class="btn btn-block more rounded-pill">More</button>
        </div>
    </div>
</template>

<style lang="scss" scoped>
@use '../../sass/colors' as *;

$logoSize: 60px;
.card {
    width: 310px;
    height: 364px;
    outline: none;
    border: none;
    background: white;
    border-radius: 22px;
    box-shadow: 0px 0px 21px rgba($color: #000000, $alpha: 0.2);
    display: grid;
    grid-template-rows: 20% 60% 20%;
    grid-template-areas:
        "top"
        "mid"
        "bottom";
    .top {
        display: grid;
        grid-template-columns: 1fr 2fr 1fr;
        grid-area: "top";
        img {
            width: $logoSize;
            height: $logoSize;
            border-radius: 50%;
            justify-self: start;
            align-self: center;

            border: 2px solid $priColor;
        }
        .title {
            justify-self: start;
            align-self: start;
            display: flex;
            flex-direction: column;
            gap: 0;
            color: $priColor;
            .title {
                font-size: 27px;
                font-weight: 600;
            }
            .org {
                font-size: 15px;
                text-decoration: none;
                color: $priColor;
                cursor: pointer;
                &:hover {
                    text-decoration: underline;
                }
            }
        }
        .icons {
            color: $priColor;
            align-self: center;
            justify-self: center;
            font-size: 20px;
            cursor: pointer;
        }
    }
    .mid {
        grid-area: "mid";
        padding: 1.3em;
        color: $priColor;
        p {
            color: black;
        }

        .target {
            margin-bottom: 1em;
            font-weight: 600;
        }

        span {
            font-weight: 600;
        }
        .progressBar {
            .bar {
                height: 25px;
                width: 100%;
            }
            progress::-webkit-progress-bar {
                background: green;
            }
        }
    }
    .bottom {
        grid-area: "bottom";
        align-self: start;
        display: grid;
        max-width: 100%;
        overflow: hidden;
        margin-top: 0.5em;
        .more {
            background-color: $priColor;
            width: 60%;
            justify-self: center;
            font-weight: bold;
            font-size: 24px;
            color: $white;
            letter-spacing: 0.05em;
        }
    }
}
</style>