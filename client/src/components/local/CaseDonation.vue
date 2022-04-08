<script>
export default {
    data() {
        return {
            donationValue: 0,
        }
    },
    methods: {
        quickDonate(e) {
            e.preventDefault();
            this.donationValue += eval(e.target.textContent)
        }
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
                    <select>
                        <option value="egp">egp</option>
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
    // input{
    //     width: 50%;
    // }
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