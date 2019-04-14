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
                    <div v-for="user in users" class="col-sm-6 user-list-row">
                        <p class="col-sm-3 user-list-item">{{ user.ni_cheng }}</p>
                        <p class="col-sm-2 user-list-item" v-if="user.id == room.host"><i class="fa fa-star" aria-hidden="true"></i></p>
                        <p @click="kickUser(user)" v-if="canKick(user)" class="col-sm-2 user-list-item pull-right"><i class="fa fa-ban" aria-hidden="true"></i></p>
                    </div>
                </div>
            </div>
        </div>

        <hr>

        <div v-for="chat in chats">
            <div class="row">
                <div class="col-sm-2 text-center user-data" v-if="chat.user_id != null">
                    <img class="user-icon-xs" :src="chat.user.iconpath">
                    <span><small>{{ chat.user.ni_cheng }}</small></span>
                </div>
                <div class="col-sm-10 narrow-xs">
                    <div v-if="chat.user_id != null">
                        <p class="user-chat wrap">{{ chat.content }}</p>
                    </div>
                    <div v-else>
                        <p class="system-chat wrap">{{ chat.content }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <audio class="system-audio hidden" id="new-chat-audio" src="/storage/music/new_chat.mp3"></audio>
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
            room: Object,
            currentUser: Object,
        },
        data(){
            return{
                chats: this.initialChats,
                users: [],
                visitingUser: false
            }
        },
        computed: {
            newChatAudio: function () {
                return document.getElementById('new-chat-audio');
            }
        },
        mounted: function(){
            window.Echo.join('chatroom.' + this.room.id + '.channel')
            .here((users) => {
                axios.post('/chatroom/' + this.room.id + '/syncuser', users);
                this.users = Object.values(users);
            })
            .listen('RoomHasNewChatEvent', (e) => {
                this.chats.unshift(e.chat);
                this.newChatAudio.play();
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
            // document.addEventListener('visibilitychange', function() {
            //     this.shouldAudio = (document.visibilityState == 'hidden');
            // })
        },
        methods: {
            leave(){
                axios.post('/chatroom/' + this.room.id + '/leave');
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
            canKick(user) {
                return ((this.currentUser.id == this.room.host) || (this.currentUser.id >= 1)) && (user.id != this.currentUser.id);
            },
            kickUser(user){
                axios.delete('/chatroom/' + this.room.id + '/kick/' + user.id);
            },
            toggleUser() {
                this.visitingUser = !this.visitingUser;
            }
        }
    }
</script>

<style>
    .user-chat {
        /* background: linear-gradient(to bottom, black 0, white 50%); */
        background-color: #ddd;
        border: white solid 1px;
        border-radius: 5px;
        font-size: large;
    }

    .system-chat {
        display: block;
        padding-left: 3em;
        font-size: small;
        font-color: #aaaaaa;
    }

    @media (max-width: 768px) {
        .user-list-row {
            display: block;
        }

        .user-list-item {
            display: inline-block;
            width: 30%;
        }

        .user-data {
            width: 20%;
        }

        .narrow-xs {
            display: inline-block;
            width: 75%;
        }
    }
</style>