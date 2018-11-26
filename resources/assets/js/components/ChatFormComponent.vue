<template>
    <div>
        <form :action="submitRoute" method="POST" @submit="addChat">
            <textarea name="content" v-model="content" @keyup.enter="addChat"></textarea>
            <button type="button" @click="addChat">发送</button>
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

</style>
