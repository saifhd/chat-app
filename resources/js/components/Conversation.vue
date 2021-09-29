<template>
    <div class="conversation">
        <h1>{{ contact ? contact.name : 'Select a Contact' }}</h1>
        <MessagesFeed :contact="contact" :messages="messages" />
        <MessageComposer :contact="contact" @send="sendMessage"/>
    </div>
</template>

<script>
import MessagesFeed from './MessagesFeed.vue'
import MessageComposer from './MessageComposer.vue'
    export default {
        props:{
            messages:{
                type    :   Array,
                default :   []
            },
            contact :{
                type    :   Object,
                default :   null
            },


        },
        data(){
            return{

            }
        },
        methods:{
            sendMessage(message){
                if(!this.contact){
                    return;
                }
                axios.post('conversation/send',{
                    contact_id : this.contact.id,
                    message : message
                }).then(res=>{
                    this.$emit('new',res.data);
                });
            }
        },
        mounted() {
            console.log(this.contact);
        },
        components:{
            MessagesFeed,
            MessageComposer
        }
    }
</script>

<style lang="scss" scoped>
    .conversation{
        flex:5;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        h1{
            font-size: 20px;
            padding: 10px;
            margin: 0;
            border-bottom: 1px dashed lightgray;
        }
    }
</style>
