<script>
import { useUserStore } from "../../store/UserStore";
import { mapWritableState, mapStores } from "pinia";
import axios from 'axios'
export default {
    props:['id'],
    data() {
        return {
            donationValue: 0,
            currency:'egp',
            
        }
    },
    methods: {
        quickDonate(e) {
            e.preventDefault();
            this.donationValue += eval(e.target.textContent)
        },
       async makeDonation(){
            await axios.post('http://localhost:8000/api/donationdone',{
                amount:this.donationValue,
                currency:this.currency,
                case_id:this.id,
            },{
                mode: "no-cors",
                        headers: {
                            "Access-Control-Allow-Origin": "*",
                            "Content-Type": "application/json",
                            "Authorization": "Bearer " + this.storeToken,
                        },
            }).then((res) => {
                console.log(res);
                this.$router.go(`/casepage/${this.id}`);
            }).catch((err) => {
                console.log(err);
            });
        }
    },
    computed:{
        ...mapStores(useUserStore),
        ...mapWritableState(useUserStore, {
            user: "currentUser",
            storeToken: "token",
        }),
    }
}

</script>

<template>
    <div>
        <h4 class="text-center">I want to help with</h4>
        <form>
            <di class="grid">
                <div class="inputs">
                    <input type="number" v-model="donationValue" />
                    <select v-model="currency">
                        <option value="egp" >egp</option>
                        <option value="usd">usd</option>
                        <option value="eur">eur</option>
                    </select>
                </div>
                <h4 class="text-center">quick donate</h4>
                <div class="quickValues">
                    <button @click="quickDonate" class="btn value">+10</button>
                    <button @click="quickDonate" class="btn value">+15</button>
                    <button @click="quickDonate" class="btn value">+20</button>
                </div>
                <hr>
                <div class="d-flex justify-content-center align-items-center">
                    <button @click.prevent="makeDonation" class="btn confirm rounded rounded-pill">confirm</button>
                </div>
            </di>
        </form>
    </div>
</template>

<style lang="scss" scoped>
@use '../../sass/colors' as *;

h4 {
    color: $priColor;
}
.grid {
    margin-top: 25px;
    display: grid;
    grid-template-rows: repeat(3, 1fr);
    gap: 1em;
    .inputs {
        display: grid;
        grid-template-columns: 70% 20%;
        gap: 1em;
        justify-self: center;
        input {
            border: none;
            border-bottom: 1px solid $priColor;
            outline: none;
            padding-left: 1em;
            color: $priColor !important;
        }
        select {
            border: none;
            border-bottom: 1px solid $priColor;
            outline: none;
            color: $priColor !important;
        }
    }
        .confirm {
                color: $white;
                background-color: $priColor;
                margin: 0 auto;
                width: fit-content;
                font-size: large;
                padding-inline: 1.5rem;
                font-weight: 400;
                letter-spacing: 0.05em;
                box-shadow: 0px 2px 2px 1px rgba(0, 0, 0, 0.2);
            }
    
    .quickValues {
        justify-self: center;
        display: flex;
        gap: 1em;
        // justify-content: space-between;
        .value {
            color: $white;
            background-color: $priColor;
            width: fit-content;
            letter-spacing: 0.05em;
            padding: 0;
            padding-inline: 15px !important;
            border-radius: 999px !important;
            font-size: 20px !important;
            font-weight: 500 !important;
            box-shadow: 0px 2px 2px 1px rgba(0, 0, 0, 0.2);
        }
        .value:focus{
                background-color: #064234;
                box-shadow: none
            }
    }
}
</style>