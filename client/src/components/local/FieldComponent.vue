<script>
import axios from "axios";

export default {
    
    props: ["id", "name", "email", "phone",],
    data() {
        return {
            editingId:false,
            editingName:false,
            editingEmail:false,
            editingPhone:false,

        };
    },
    methods:{
    }
};
</script>

<template>
    <div class="col-2 id">
        <p v-if="!editingId" @dblclick="editingId = true">{{id}}</p>
        <input type="text" :value="id" v-else @keyup.enter="editingId = false">
    </div>
    <div class="col-2">
        <p v-if="!editingName" @dblclick="editingName = true">{{name}}</p>
        <input type="text" :value="name" v-else @keyup.enter="editingName = false">
    </div>
    <div class="col-2">
        <p v-if="!editingEmail" @dblclick="editingEmail = true">{{email}}</p>
        <input type="text" :value="email" v-else @keyup.enter="editingEmail = false">
    </div>
    <div class="col-2">
        <p v-if="!editingPhone" @dblclick="editingPhone = true">{{phone}}</p>
        <input type="text" :value="phone" v-else @keyup.enter="editingPhone = false">
    </div>
    <div class="col-2 px-5">
        <p>50</p>
    </div>
    <div class="col-2 px-5 donated">
        <p contenteditable="true">1500eg</p>
    </div>
</template>

<style lang="scss" scoped>
@use "../../sass/colors" as *;
.col-2{
    margin-bottom: 5px;
    background-color: #eee;
    border-bottom: $priColor solid 2px;

}
</style>
