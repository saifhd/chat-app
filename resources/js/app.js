
require('./bootstrap');

window.Vue = require('vue').default;

Vue.component('chat-app', require('./components/ChatApp.vue').default);
// Vue.component('Conversation', require('./components/Conversation.vue').default);
// Vue.component('ContactList', require('./components/ContactList.vue').default);


const app = new Vue({
    el: '#app',
});
