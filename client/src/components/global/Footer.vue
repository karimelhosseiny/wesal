<script>
export default {
    data() {
        return {};
    },
};
</script>

<template>
    <footer class="container-fluid">
        <div class="row py-3 align-items-center">
            <div class="col">
                <span class="fw-bold text-white">Wesal</span>
            </div>
            <div class="copyrights col text-center">
                <p class="text-white-50">
                    All rights reserved by Wesal
                    <span class="fw-bold text-white">2022©</span>
                </p>
            </div>
            <div class="col text-end">
                <a href="#"><h2 class="bi bi-facebook"></h2></a>
                <a href="#"> <h2 class="bi bi-twitter"></h2></a>
                <a href="#"><h2 class="bi bi-linkedin"></h2></a>
                <a href="#"> <h2 class="bi bi-instagram"></h2></a>
            </div>
        </div>
    </footer>
</template>

<style lang="scss">
$secColor: #91ffa2;
$priColor: #0f9172;
.container-fluid {
    background-color: $priColor;
}
h2 {
    color: white;
    display: inline;
    margin: 0 8px;
}
p {
    margin: auto;
}
</style>
