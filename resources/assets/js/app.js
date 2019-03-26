
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

const chat = new Vue({
    el: '#chatroom',
    components:{
        'room-option': require('./components/RoomOption.vue'),
        'chat-form': require('./components/ChatFormComponent.vue'),
        'chat-list': require('./components/ChatListComponent.vue')
    }
});

$(document).ready(function() {
    $('.notifications-blink').blink();
})