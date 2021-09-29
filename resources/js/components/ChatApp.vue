<template>
    <div class="chat-app">

        <!-- <h3>Chat App</h3> -->
        <Conversation  :messages="messages" :contact="selectedContact" @new="saveNewMessage"/>
        <ContactList  :contacts="contacts" @selected="startConversationWith" />
    </div>
</template>

<script>
import ContactList from './ContactList.vue'
import Conversation from './Conversation.vue'
    export default {
        props:{
            user:{
                type     : Object,
                required : true,
                default  : ()=>{}
            }

        },

        data(){
            return{
                selectedContact:null,
                messages:[],
                contacts:[],
                loaded:false,
                name:''
            }
        },
        methods:{
            startConversationWith(contact){
                this.updateUnReadCount(contact,true)
                axios.get('conversation/'+contact.id).then(res=>{
                    this.messages = res.data;
                    this.selectedContact =contact;
                    // console.log(this.messages);
                });
                // axios.get('/contacts').then(res=>{
                //     this.contacts=res.data;
                // });

            },
            saveNewMessage(message){
                this.messages.push(message);
            },
            handleIncomming(message){
                if(this.selectedContact && message.from_id == this.selectedContact.id){
                    this.saveNewMessage(message);
                }
                this.updateUnReadCount(message.from_contact,false)
            },
            updateUnReadCount(contact,reset){
                this.contacts=this.contacts.map((single)=>{
                    if(single.id !== contact.id){
                        return single;
                    }
                    if(reset){
                        single.unread=0;
                    }
                    else{
                        single.unread +=1;
                    }
                    return single;
                });

            }

        },

        mounted() {


                Echo.private(`messages.${this.user.id}`)
                    .listen('NewMessage',(e)=>{
                        // console.log(e.message);
                        this.handleIncomming(e.message);

                });



            axios.get('/contacts').then(res=>{
                    this.contacts=res.data;
                });
        },
        components:{
            ContactList,
            Conversation
        }
    }
</script>

<style lang="scss" scoped>
    .chat-app{
        display:flex;
    }
</style>
