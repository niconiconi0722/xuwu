<template>
    <div v-if="isHost">
        <button type="button" @click="destroyRoom">删除房间</button>

        <form :action="submitRoute" method="POST" @submit="updateRoom">
            <input type="text" name="name" v-model="room.name">
            <input type="text" name="description" v-model="room.description">
            <input type="number" name="max_users" :min="room.user_count" max="20" v-model="room.max_users">

            <button type="button" @click="updateRoom">保存修改</button>
        </form>
    </div>
</template>

<script>
    import { Hub } from '../event-bus';

    export default {
        props:{
            currentUser: Object,
            submitRoute: String,
            initialRoom: Object
        },
        data(){
            return {
                room: this.initialRoom
            }
        },
        computed: {
            isHost: function () {
                return this.room.host == this.currentUser.id;
            }
        },
        mounted: function () {
            Hub.$on('newHost', (user) => {
                this.room.host = user.id;
            });
        },
        methods:{
            updateRoom(){
                axios.patch(this.submitRoute + '/edit', this.room).then((res) => {
                    if (res.data.success == true) {
                        this.room = res.data.room;
                    }
                });
            },
            destroyRoom(){
                axios.delete(this.submitRoute).then((res) => {
                    if (res.data.success == true) {
                        window.location.href = "/chatroom/lounge";
                    }
                })
            }
        }
    }
</script>
