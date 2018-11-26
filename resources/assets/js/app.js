
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import Echo from 'laravel-echo';

window.io = require('socket.io-client');
window.Echo = new Echo({
    broadcaster: 'socket.io',
    host: window.location.hostname + ':6001'
});

window.Vue = require('vue');

const chat = new Vue({
    el: '#chatroom',
    components:{
        'chat-form': require('./components/ChatFormComponent.vue'),
        'chat-list': require('./components/ChatListComponent.vue')
    }
});
