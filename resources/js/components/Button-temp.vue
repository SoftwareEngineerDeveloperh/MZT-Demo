<template>
    <div>
        <div v-if="flag == 0">
            <button class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow" @click="onContact(id)">{{contact}}</button>
            <button class="bg-white text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow disabled" @click="onHire(id)" disabled >{{hire}}</button>

        </div>
        <div v-else-if="flag == 1">
            <button class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow" @click="onContact(id)">{{contact}}</button>
            <button class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 hover:bg-teal-100 rounded shadow" @click="onHire(id)">{{hire}}</button>
        </div>
        <div v-else>
            <button class="bg-white text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow disabled" @click="onContact(id)" disabled>{{contact}}</button>
            <button class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 hover:bg-teal-100 rounded shadow" @click="onHire(id)">{{hire}}</button>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
export default {
    props: ['id'],
    data: function() {
      return {
          contact: "Contact",
          hire: "Hire",
          flag: 0 // 0:contact, 1:contacting, 2:hired
        };
    }, 
    methods: {
        onContact(id) {
            // window.location.href = 'candidates-contact/' + candidate_id;
            axios.get('/candidates-contact/'+id)
                .then(res => {
                if (res.status == 200) {
                    var data = res.data;
                    var ele = document.getElementById('coins');
                    ele.innerHTML = data.coins;
                    this.contact = "Contacting";
                    this.flag = 1;
                }
            })
        },
        onHire(id) {
            axios.get('/candidates-hire/'+id)
                .then(res => {
                if (res.status == 200) {
                    var data = res.data;
                    this.hire = "Hired";
                    this.contact = "Contact";
                    var ele = document.getElementById('coins');
                    ele.innerHTML = data.coins;
                    this.flag = 2;
                }
            })
        }
    }
}
</script>

<style>
.disabled {
    color: lightgray;
    cursor: no-drop;
}
</style>