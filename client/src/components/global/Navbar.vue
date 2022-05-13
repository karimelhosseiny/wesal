<script>
import { mapStores, mapActions, mapState } from 'pinia';
import { useUserStore } from "../../store/UserStore";
export default {
    data() {
        return {};
    },
    methods: {
         ...mapActions(useUserStore, ['logout']),
         logoutUser(){
             this.logout()
             if(this.userStore.token===null){
                 this.$router.push('/login')
             }
        },
    },
    computed:{
          ...mapStores(useUserStore),
        ...mapState(useUserStore,['user']),
    }
};
</script>

<template>
    <div class="navbars">
        <div class="logo">
            <router-link to="/home">
                <img src="../../assets/SVG/logo.svg" class="ms-3" />
            </router-link>
            <h4>wesal</h4>
        </div>
        <ul class="navLinks">
            <router-link to="/home" class>Home</router-link>
            <router-link to="/login">Organizations</router-link>
            <router-link to="/login">Cases</router-link>
            <router-link to="/admindashboard">Dashboard</router-link>
        </ul>
        <div class="controls">
            <i class="bi bi-calendar"></i>
            <i class="bi bi-bell-fill"></i>
            <button @click="logoutUser" class="btn btn-warning border-0 rounded-pill">sign out</button>
            <router-link to="/profile">
                <img src="../../assets/7maya.png" class="bg-light" alt="..." />
            </router-link>
        </div>
    </div>
</template>

<style lang="scss">
@use '../../sass/colors' as *;
$picSize: 40px;
$logoSize: 50px;
.navbars {
    background: $priColor;
    display: grid;
    grid-template-columns: repeat(12, 1fr);
    .logo {
        grid-column: 1/5;
        justify-self: start;
        align-self: center;
        display: grid;
        grid-template-columns: repeat(3, auto);
        gap: 0.5em;
        img {
            width: $logoSize;
            height: $logoSize;
            grid-column: 1;
            justify-self: center;
            align-self: center;
            padding: 5px;
        }
        h4 {
            color: $white;
            grid-column: 2/3;
            align-self: end;
        }
    }
    .navLinks {
        grid-column: 5/8;
        margin-top: 15px;
        padding-right: 0;
        a {
            text-decoration: none;
            color: $white;
            font-weight: 600;
            margin-right: 25px;
        }
    }
    .controls {
        grid-column: 12;
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        grid-gap: 1em;
        margin-right: 1em;
        align-items: center;
        .bi-calendar {
            font-size: 20px;
            justify-self: center;
            color: $white;
            cursor: pointer;
        }
        .bi-bell-fill {
            font-size: 20px;
            justify-self: center;
            color: $white;
            cursor: pointer;
        }
        button {
            justify-self: center;
            width: 90px;
            background-color: $white;
            color: $priColor;
            font-weight: 600;
        }
        img {
            width: $picSize;
            height: $picSize;
            grid-column: 4/6;
            border-radius: 50%;
            justify-self: center;
            border: 3px solid $white;
            cursor: pointer;
        }
    }
}
</style>
