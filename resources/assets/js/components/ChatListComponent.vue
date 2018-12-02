<template>
    <div>
        <button @click="leave">退出房间</button>
        <p>房间内的用户：</p>
        <div v-for="user in users">
            <p>{{ user.ni_cheng }}</p>
            <button @click="kickUser(user)" v-if="user.id != currentUser.id">踢出房间</button>
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
    import { Hub } from '../event-bus';

    export default {
        props: {
            initialChats: Array,
            roomId: Number,
            currentUser: Object,
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
                axios.post('/chatroom/' + this.roomId + '/syncuser', users);
                this.users = Object.values(users);
            })
            .listen('RoomHasNewChatEvent', (e) => {
                this.chats.unshift(e.chat);
            })
            .listen('AttachedUserToRoomEvent', (e) => {
                this.users.push(e.user);
            })
            .listen('DetachedUserFromRoomEvent', (e) => {
                this.removeUser(e.user);
            })
            .listen('UserBeKickedEvent', (e) => {
                if (e.user.id == this.currentUser.id) {
                    window.location.href = "/chatroom/lounge";
                } else {
                    this.removeUser(e.user);
                }
            })
            .listen('HostChangedEvent', (e) => {
                Hub.$emit('newHost', e.user);
            });
        },
        methods: {
            leave(){
                axios.post('/chatroom/' + this.roomId + '/leave');
                window.location.href = "/chatroom/lounge";
            },
            removeUser(shouldRemoveUser){
                for (var i in this.users) {
                    if (this.users[i].id === shouldRemoveUser.id) {
                        this.users.splice(i, 1);
                        break;
                    }
                }
            },
            kickUser(user){
                axios.delete('/chatroom/' + this.roomId + '/kick/' + user.id);
            }
        }
    }
</script>

<style>

</style>
