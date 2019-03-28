<template>
    <div>
        <form :action="submitRoute" method="POST" @submit="addChat">

            <div class="form-group row">
                <textarea class="form-control col-sm-offset-2 col-sm-8 center-block chat-speaking" rows="3" name="content" v-model="content" @keyup.enter="addChat"></textarea>
            </div>

            <div class="form-group">
                <button type="button" @click="addChat" class="btn btn-black center-btn btn-xs">发送</button>
            </div>

        </form>
    </div>
</template>

<script>
    export default {
        props:{
            submitRoute: String
        },
        data(){
            return{
                content: ''
            }
        },
        methods:{
            addChat(){
                axios.post(this.submitRoute, {content: this.content});
                this.content = '';
            }
        }
    }
</script>

<style>
    .chat-speaking {
        margin-top: 0.6em;
        padding: 1em;
        border:1px solid white;
        border-radius: 1.5em;
    }
</style>