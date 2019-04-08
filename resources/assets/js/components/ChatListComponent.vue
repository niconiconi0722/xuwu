<template>
    <div>
        <button @click="leave" class="btn btn-danger">退出房间</button>

        <div @click="toggleUser">
            <div v-if="visitingUser">
                <i class="fa fa-caret-up" aria-hidden="true"></i>
            </div>
            <div v-else>
                <i class="fa fa-caret-down" aria-hidden="true"></i>
            </div>
        </div>

        <div id="user-list" v-show="visitingUser">
            <div>
                <p>房间内的用户：</p>
                <div class="row">
                    <div v-for="user in users" class="col-sm-6">
                        <p class="col-sm-3">{{ user.ni_cheng }}</p>
                        <button @click="kickUser(user)" v-if="user.id != currentUser.id" class="col-sm-3 btn btn-black pull-right">踢出房间</button>
                    </div>
                </div>
            </div>
        </div>

        <hr>

        <div v-for="chat in chats">
            <div class="row">
                <div class="col-sm-2 text-center" v-if="chat.user_id != null">
                    <img class="user-icon-xs" :src="chat.user.iconpath">
                    <span><small>{{ chat.user.ni_cheng }}</small></span>
                </div>
                <div class="col-sm-10">
                    <div v-if="chat.user_id != null">
                        <p class="userchat wrap">{{ chat.content }}</p>
                    </div>
                    <div v-else>
                        <p class="systemchat wrap">{{ chat.content }}</p>
                    </div>
                </div>
            </div>
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
                users: [],
                visitingUser: false
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
            },
            toggleUser() {
                this.visitingUser = !this.visitingUser;
            }
        }
    }
</script>

<style>
    .userchat {
        /* background: linear-gradient(to bottom, black 0, white 50%); */
        background-color: #ddd;
        border: white solid 1px;
        border-radius: 5px;
        font-size: large;
    }

    .systemchat {
        display: block;
        padding-left: 3em;
        font-size: small;
        font-color: #aaaaaa;
    }
</style>