<template>
    <div class="feed" ref="feed">
        <ul v-if="contact">
            <li v-for="message in messages" :key="message.id"
                :class="`message${message.to_id == contact.id ? ' sent' :' recieved' }`">
                    <div class="text">
                        {{ message.message }}
                    </div>
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    props:{
        contact:{
            typeof  : Object,
        },
        messages:{
            typeof  : Object,
            required: true
        }
    },
    data(){
        return{

        }
    },
    methods:{
        scrollBottom(){
            setTimeout(()=>{
                this.$refs.feed.scrollTop=this.$refs.feed.scrollHeight-this.$refs.feed.clientHeight;
            },50);
        }
    },
    watch:{
        contact(contact){
            this.scrollBottom();
        },
        messages(messages){
            this.scrollBottom();
        }
    },
    mounted(){
        // this.scrollBottom();
        // console.log(this.messages)
    }
}
</script>

<style lang="scss" scoped>
    .feed{
        background: #f0f0f0;
        height: 100%;
        max-height: 478px;
        overflow-y: scroll;
        ul{
            list-style-type: none;
            padding:5px;

            // li{
            .message{
                margin: 10px 0;
                width: 100%;
                .text{
                    max-width: 200px;
                    border-radius: 5px;
                    padding: 12px;
                    display: inline-block;
                }
            }
            .recieved{
                text-align: right;

                .text{
                    background: #b2b2b2;
                }
            }
            .sent{
                text-align: left;
                .text{
                    background: #81c4f9;
                }
            }
            // }
        }
    }
</style>
