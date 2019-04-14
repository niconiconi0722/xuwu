<template>
    <div v-if="isHost">
        <div class="dropdown">
          <p><i class="fa fa-cog fa-lg" aria-hidden="true"></i></p>
          <div class="dropdown-content">
            <div>
                <button type="button" @click="destroyRoom" class="btn btn-danger">删除房间</button>
            </div>
            <div>
                <button type="button" class="btn btn-black" data-toggle="modal" data-target="#edit">修改房间</button>
            </div>
          </div>
        </div>

        <div class="modal" id="edit" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <form :action="submitRoute" method="POST" @submit="updateRoom" class="col-sm-12 form-horizontal center-vertical">
                            <div class="form-group">
                                <label for="name" class="col-sm-3 control-label text-center"><small>房间名称</small></label>
                                <div class="col-sm-9">
                                    <input type="text" name="name" class="form-control" v-model="room.name">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="description" class="col-sm-3 control-label text-center"><small>房间描述</small></label>
                                <div class="col-sm-9">
                                    <textarea v-model="room.description" class="form-control" name="description"  rows="5"></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="max_users" class="col-sm-3 control-label text-center"><small>最大人数</small></label>
                                <div class="col-sm-9">
                                    <input class="col-sm-2" type="number" name="max_users" :min="room.user_count" max="20" v-model="room.max_users">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-black" data-dismiss="modal">取消修改</button>
                        <button type="button" @click="updateRoom" class="btn btn-black" data-dismiss="modal">保存修改</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { Hub } from '../event-bus';

    export default {
        props: {
            currentUser: Object,
            submitRoute: String,
            initialRoom: Object
        },
        data () {
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
        methods: {
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

<style>
    .dropdown {
        position: relative;
        display: inline-block;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        top: 2em;
        background-color: rgba(255,255,255,0.8);
        z-index: 1;
    }

    .dropdown:hover .dropdown-content {
        display: block;
    }

    .dropdown-item {
        margin: 2em;
    }
</style>