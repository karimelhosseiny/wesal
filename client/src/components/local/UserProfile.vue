<script>
import Navbar from '../global/Navbar.vue'
export default {
    data() {
        return {

        }
    },
    components: { Navbar }
}

</script>

<template>
    <Navbar />
    <div class="mainContainer">
        <div class="profPic text-center d-flex flex-column">
            <img src="../../assets/7maya.png" alt="profile picture" />
            <div class="d-flex justify-content-between px-5 mt-4">
                <a href="#" class>upload</a>
                <a href="#">remove</a>
            </div>
        </div>
        <div class="dataContainer py-5 px-4">
            <div class="personalInfo">
                <h1>Youssef Abdulaziz</h1>
                <div class="px-3">
                    <h4>
                        Youssefabdulaziz@gmail.com
                        <i class="bi bi-pencil-square ms-3"></i>
                    </h4>
                    <h4>
                        +201065292537
                        <i class="bi bi-pencil-square ms-3"></i>
                    </h4>
                </div>
            </div>
        </div>
    </div>
</template>

<style lang="scss" scoped>
@use '../../sass/colors' as *;
* {
    box-sizing: border-box;
}
.mainContainer {
    display: flex;
    justify-content: center;
    width: 100%;
    position: relative;
    scroll-behavior: smooth;

    .dataContainer {
        margin: 130px 0 40px 0;
        height: 76.9vh;
        // height: 638px;
        border: 4px solid $priColor;
        border-radius: 37px;
        width: 1250px;

        .personalInfo {
            color: $priColor;
            h1 {
                font-style: normal;
                font-weight: 500;
                font-size: 48px;
                line-height: 72px;
                /* identical to box height */

                letter-spacing: -0.02em;
            }
            h4 {
                font-style: normal;
                font-weight: 500;
                font-size: 24px;
                line-height: 36px;
                /* identical to box height */

                letter-spacing: -0.02em;
                i {
                    visibility: hidden;
                    cursor: pointer;
                }
            }
            h4:hover i {
                visibility: visible;
            }
        }
    }
    .profPic {
        width: 240px;
        height: 240px;
        margin-top: 20px;
        position: absolute;
        img {
            border-radius: 50%;
            box-shadow: 0px 4px 10px 2px rgba(0, 0, 0, 0.4);
        }
        a {
            font-weight: 400;
            font-size: 18px;
            line-height: 27px;
            letter-spacing: -0.02em;
            color:$priColor
        }
    } 
}
</style>