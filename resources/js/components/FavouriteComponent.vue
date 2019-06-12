<template>
    <div>
            <button v-if="show" @click.prevent="unsave()" class="btn btn-dark" style="width:100%;">Un Save</button>
            <button v-else @click.prevent="save()" class="btn btn-primary" style="width:100%;">Save</button>



    </div>
</template>

<script>
    export default {
        props:['jobid','favourited'],

        data(){
            return{
                'show':true//もしアプリケーションが正常にsentされたら application sent successfully
            }
        },

        mounted() {
           this.show = this.jobFavourited ? true:false;//もしtrueなら、上のボタンが返される
        },

        computed: {
            jobFavourited(){
                return this.favourited
            }
        },

        methods:{
            save(){
                //alert("ok") okって出たらok
                axios.post('/save/'+this.jobid).then(response=>this.show=true).catch(error=>alert('error'))//もしsaveしたらsaveボタンは消す
            },
            unsave(){
                axios.post('/unsave/'+this.jobid).then(response=>this.show=false).catch(error=>alert('error'))//unsave押したら、もう一回saveボタン見せる
            }
        }

    }
</script>
