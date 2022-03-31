<script>
export default {
    data() {
        return {

        }
    }
}

</script>

<template>
    <div class="hero">
        <div class="img-fluid ">
            <div class="text">
                <h1>Hello, Youssef</h1>
                <h4>
                    total donations: 400
                    <sub>egp</sub>
                </h4>
                <h4>
                    last donation:
                    <a href="#">case</a> - 72
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
