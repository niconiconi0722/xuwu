<template>
    <div>
        <button @click="leave">退出房间</button>
        <p>房间内的用户：</p>
        <div v-for="user in users">
            <p>{{ user.ni_cheng }}</p>
        </div>
        <hr>
        <div v-for="chat in chats">
            <p>{{ chat.content }}</p>
        </div>
    </div>
</template>

<script>
    // import Echo from 'laravel-echo';
    // import io from 'socket.io-client';
    export default {
        props: {
            initialChats: Array,
            roomId: Number
        },
        data(){
            return{
                chats: this.initialChats,
                users: []
            }
        },
        mounted: function(){
            window.Echo.join('chatroom.' + this.roomId + '.channel')
            .here((users) => {
                axios.post('/chatroom/join/' + this.roomId);
                this.users = Object.values(users);
            })
            .joining((user) => {
                this.users.push(user);
            })
            .leaving((user) => {
                this.removeUser(user);
            })
            .listen('RoomHasNewChatEvent', (e) => {
                this.chats.unshift(e.chat);
            });
        },
        methods: {
            leave(){
                axios.post('/chatroom/leave/' + this.roomId);
                window.location.href = "/chatroom/lounge";
            },
            removeUser(shouldRemoveUser){
                for (var i in this.users) {
                    if (this.users[i].id === shouldRemoveUser.id) {
                        this.users.splice(i, 1);
                        break;
                    }
                }
            }
        }
    }
</script>

<style>

</style>
