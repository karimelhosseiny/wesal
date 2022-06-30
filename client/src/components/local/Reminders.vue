<script>
import { mapStores, mapActions, mapWritableState } from "pinia";
import { useUserStore } from "../../store/UserStore";
import Navbar from "../global/Navbar.vue";
import ReminderCard from "../local/ReminderCard.vue"
export default {
    data() {
        return {
            isLoading: false,
        };
    },
    components: { Navbar, ReminderCard },
    methods: {},
    computed: {},
};
</script>

<template>
    <Navbar />
    <div
        v-if="isLoading"
        class="d-flex justify-content-center align-items-center"
        style="height: 100vh"
    >
        <div
            class="spinner-grow mx-5 text-success"
            style="width: 10rem; height: 10rem"
            role="status"
        >
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
    <div v-else class="remindersGrid">
        <ReminderCard />

    </div>
</template>

<style lang="scss">
@use "../../sass/colors" as *;
.remindersGrid {
    grid-template-columns: repeat(4, auto);
    padding-inline: 1em;
    padding: 1em 0;
    display: grid;
    justify-content: center;
    gap: 20px;
    overflow: auto;
}
</style>
